"use strict";

class LinkedSelect {

    /**
     * @param {HTMLSelectElement} $select
     */
    constructor($select) {
        this.$select = $select;
        this.onChange = this.onChange.bind(this);
        this.$parent = this.$select.parentElement.parentElement;
        // this.$target = document.querySelector(this.$select.dataset.target);
        // this.$select.dataset.target = "#"+$(this.$select.dataset.target).closest('select').attr('id');
        
        this.$target = document.querySelector(this.$select.dataset.target);
        // console.log($(this.$select).first().next().css("border", "5px dashed green"));
        // console.log(document.querySelector(this.$select));

        try {
            this.$placeholder = this.$target.firstElementChild;
            // this.$target = $(this.$select).parents(".main")[0].querySelector('#'+this.$target.id);
            // console.log(this.$target);
            // console.log($(this.$select).parents(".main")[0].querySelector('#'+this.$target.id));
            // this.$target = $(this.$select).parents(".main")[0].querySelector('#' + this.$target.id);
            // console.log(this.$select.parentElement.parentElement.querySelector('#'+this.$target.id));
            // this.$placeholder = this.$target[0].innerHTML;
            // this.$placeholder = "-- DEFAULT --"
            // console.log(this.$target[0].innerHTML);
            // this.onChange = debounce(this.onChange.bind(this), 500)
            this.$loader = null
            this.cache = {}
            this.$select.addEventListener('change', this.onChange)
        } catch (error) {
            console.log("Not Initialized");
        }
    }

    /**
  * Se déclenche au changement de valeur d'un select
  * @param {Event} e
  */
    onChange(e) {
        if (e.target.value === '0') {
            return
        }
        this.loadOptions(e.target.value, (options) => {
            this.$target.innerHTML = options
            this.$target.insertBefore(this.$placeholder, this.$target.firstChild)
            // this.$target.insertBefore(this.$placeholder, this.$target[0].innerHTML);
            // this.$target.selectedIndex = 0
            // this.$target.style.display = hide
        })
    }

    /**
     * Charge les options à partir du serveur (ou du cache)
     * @param {string} id
     * @param callback
     */
    loadOptions(id, callback) {
        // if (this.cache[id]) {
        //     callback(this.cache[id])
        //     return
        // }
        this.showLoader()
        let request = new XMLHttpRequest()
        request.open('GET', this.$select.dataset.source.replace('$id', id), true)
        request.onload = () => {
            if (request.status >= 200 && request.status < 400) {
                let data = JSON.parse(request.responseText);
                let options = data.reduce(function (acc, option) {
                    return acc + '<option value="' + option.value + '">' + option.label + '</option>'
                }, '')
                this.cache[id] = options
                this.hideLoader()
                callback(options)
            } else {
                alert('Impossible de charger la liste')
            }
        }
        request.onerror = function () {
            alert('Impossible de charger la liste')
        }
        request.send()
    }



    showLoader() {
        // this.$loader = document.createTextNode('Chargement...')
        // this.$target.parentNode.appendChild(this.$loader)
    }

    hideLoader() {
        if (this.$loader !== null) {
            this.$loader.parentNode.removeChild(this.$loader)
            this.$loader = null
        }
    }

}

let $selects = document.querySelectorAll('.linked-select');
$selects.forEach(function ($select) {
    new LinkedSelect($select);
})