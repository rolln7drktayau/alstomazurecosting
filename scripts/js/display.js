// ------------------------------------------------

// window.history.forward(1);

"use strict";

// Check or not
var reservationElmt = document.querySelector('.for-selection');
var hb = document.querySelectorAll('.hb');
var reserved = document.querySelectorAll('.reserved');

reservationElmt.addEventListener('change', checkRadio);

function checkRadio(e) {
    if (e.target.value == "Windows") {
        for (_hb of hb) {
            _hb.style.display = null;
            _hb.checked = true;
        }
        for (_res of reserved) {
            _res.style.display = "none";
            _res.checked = false;
            _res.disable = true;
        }
    }
    else {
        for (_res of reserved) {
            _res.style.display = null;
            _res.checked = true;
        }
        for (_hb of hb) {
            _hb.style.display = "none";
            _hb.checked = false;
            _hb.disable = true;
        }
    }
}




function saver() {
    $.GET("../php/storage.php").success(function (response) {
        sessionStorage.setItem("data", response);
    });
}

var azcp = 0;
var dcp = 0;
var ctp = 0;

var azmdp = 0;
var dxmdp = 0;
var mdtp = 0;

var lp = 0;
var azctp = 0;
var dxcctp = 0;
var olp = 0;

var tp = 0;

var toAdd = false;

function dataInitializer() {
    azcp = 0;
    dcp = 0;
    ctp = 0;
    azmdp = 0;
    dxmdp = 0;
    mdtp = 0;
    lp = 0;
    azctp = 0;
    dxcctp = 0;
    olp = 0;
    tp = 0;
    toAdd = false;
}

function dataReloader() {
    dataInitializer();
    azCp.textContent = ` = ${azcp} €`;
    dxCp.textContent = ` = ${dcp} €`;
    cTp.textContent = ` = ${ctp} €`;
    licensePrice.textContent = ` = ${lp} €`;
    azMp.textContent = ` = ${azmdp} €`
    dxMp.textContent = ` = ${dxmdp} €`;
    mdTp.textContent = ` = ${mdtp} €`;
    azCharges.textContent = ` = ${azctp} €`;
    dxcCharges.textContent = ` = ${dxcctp} €`;
    totalPrice.textContent = ` = ${tp} € / Month`;
}

// function setAcc() {

// }

window.onload = function initializeIt(params) {
    console.log("---> Initialization");
    dataInitializer();
}

var commands = [];


var region = document.querySelector('.Region-Select');
var opSys = document.querySelector('.Operating-System-Select');
var subs = document.querySelector('.Subscription-Select');
var serie = document.querySelector('.Serie-Select');
var instance = document.querySelector('.Virtual-Machine-Select');
var upTime = document.querySelector('.Uptime-Select');
var env = document.querySelector('.Environment-Select');
var type = document.querySelector('.Type-Select');
var red = document.querySelector('.Redundancy-Select');
var dd = document.querySelector('.Data-Disks-Select');
var total = document.querySelector('.Total-Elmt');



var azCp = document.querySelector('.Azure-Compute-Price');
var dxCp = document.querySelector('.DXC-Compute-Price');
var cTp = document.querySelector('.Compute-Total-Price');

var azMp = document.querySelector('.Azure-Managed-Disks-Price');
var dxMp = document.querySelector('.DXC-Managed-Disks-Price');
var mdTp = document.querySelector('.Managed-Disks-Total-Price');

var licensePrice = document.querySelector('.Licenses-Price');

var azCharges = document.querySelector('.Azure-Charges-Price');
var dxcCharges = document.querySelector('.DXC-Charges-Price');

var mdPush = document.querySelector('.Managed-Disks-PushButton');
var mdPop = document.querySelector('.Managed-Disks-PopButton');
var newP = document.querySelector('.New-Project-Zone');
var doneWP = document.querySelector('.Done-Zone');

var totalPrice = document.querySelector('.Total-Price');

var summaryArea = document.querySelector('.Summary')
var Summ = document.querySelector('.Summ')
var osSelect = document.querySelector('.Operating-System-Select')

var loc = "";
var operator;
// var toBind = "";

var subscriptionValue = 0;
var instanceValue = 0;
var uptimeValue = 0;
var environmentValue = 0;
var diskValue = 0;


var cart = new Cart();
var ans = "";

var pack_cpt = 0;
var disk_cpt = 0;
var tb_cpt = 0;


// document.addEventListener('change', function(event) {
//     $("#Logs-Area").accordion({
//         active: false,
//         collapsible: true,
//         heightStyle: "content",
//         alwaysOpen: true
//     });
//     if (stop) {
//         event.stopImmediatePropagation();
//         event.preventDefault();
//         stop = false;
//     }    
// });

$("#Logs-Area").accordion({
    active: false,
    collapsible: true,
    heightStyle: "content",
    alwaysOpen: true
});

function initMachineSlot(ans) {
    document.getElementById("Logs-Area").innerHTML = ans;
}

function setMachinesSlots(cpt) {
    let n = cpt + 1;
    var accTitle = "<h3>PACK " + n + "</h3>";
    var headElmt = '<div class="Logs" id="Logs-' + cpt + '">';
    var bottomElmt = '</div>';
    document.getElementById("Logs-Area").innerHTML += accTitle + headElmt + bottomElmt;
}

function display(params, cpt) {
    document.getElementById("Logs-" + cpt).innerHTML = params.split("__________<br>")[pack_cpt];
    $("#Logs-Area").accordion("refresh");
    // console.log(params);
}


region.addEventListener('change', setOs);
function setOs() {
    initMachineSlot(ans);
    setMachinesSlots(pack_cpt);
    
    globalThis.pack = new Machine();


    loc = loc + "&location=" + $('.Region-Select').val();
    // console.log(loc);
    var test = opSys.getAttribute("data-source");
    test = test + loc;
    opSys.setAttribute("data-source", test);

    pack.compute.region = $('.Region-Select').val();

    cart.machines[pack_cpt] = pack;
    // console.clear();
    // console.log(cart.displayIt());
    display(cart.showIt(), pack_cpt);
    // cart.show();
    // console.log(cart);
    // console.log(cart.showIt().split("__________<br>")[pack_cpt]);
}

opSys.addEventListener('change', setSubs);
function setSubs() {
    // loc = loc + "&location=" + $('.Region-Select').val();
    loc = loc + "&os=" + $('.Operating-System-Select').val();
    // toBind = loc;
    // console.log(loc);
    var test = subs.getAttribute("data-source");
    test = test + loc;
    subs.setAttribute("data-source", test);

    pack.compute.operatingSystem = $('.Operating-System-Select').val();
    cart.machines[pack_cpt] = pack;
    // console.clear();
    // console.log(cart.displayIt());
    display(cart.showIt(), pack_cpt);
    // cart.show();
    // console.log(cart);

}

subs.addEventListener('change', setSerie);
function setSerie() {
    // loc = loc + "&os=" + $('.Operating-System-Select').val();
    loc = loc + "&subs=" + $('.Subscription-Select').val();

    // if (!$('.Subscription-Select').val().includes("Pay")) {
    //     operator = $('.Subscription-Select').val().split(' | ')[0];
    // }
    operator = $('.Subscription-Select').val().split(' | ')[0];
    subscriptionValue = operator;

    // console.log(loc);
    var test = serie.getAttribute("data-source");
    test = test + loc;
    serie.setAttribute("data-source", test);

    pack.compute.subscription = $('.Subscription-Select').val().split(' | ')[1];
    cart.machines[pack_cpt] = pack;
    // console.clear();
    // console.log(cart.displayIt());
    display(cart.showIt(), pack_cpt);
    // cart.show();
    // console.log(cart);

}

serie.addEventListener('change', setVM);
function setVM() {
    // loc = loc + "&subs=" + $('.Subscription-Select').val();
    loc = loc + "&serie=" + $('.Serie-Select').val();
    // console.log(loc);
    var test = instance.getAttribute("data-source");
    test = test + loc;
    instance.setAttribute("data-source", test);

    pack.compute.serie = $('.Serie-Select').val();
    cart.machines[pack_cpt] = pack;
    // console.clear();
    // console.log(cart.displayIt());
    display(cart.showIt(), pack_cpt);
    // cart.show();
    // console.log(cart);
}

instance.addEventListener('change', setUptime);
function setUptime() {
    loc = loc + "&instance=" + $('.Virtual-Machine-Select').val();

    // loc = loc + "&serie=" + $('.Serie-Select').val();
    // console.log(loc);
    var test = upTime.getAttribute("data-source");
    test = test + loc;
    upTime.setAttribute("data-source", test);
    var instancePrice = 0;
 
    // instanceValue = $('.Virtual-Machine-Select').val().split(' | ')[1] / subscriptionValue;

    if ($('.Subscription-Select').val().includes("Pay")) {
        // let a = $('.Virtual-Machine-Select').val().split(' | ')[4].split(' ')[0];
        let a = $('.Virtual-Machine-Select').val().split(' | ')[4].split(' ')[0];

        let b = $('.Virtual-Machine-Select').val().split(' | ')[1];

        instancePrice = (+b) / (+a);
        instancePrice = (instancePrice * 100) / 100
        instanceValue = (+b) / ((+subscriptionValue) * (+a));
        instanceValue = (+instanceValue * 100) / 100
        
    } else {
        let b = $('.Virtual-Machine-Select').val().split(' | ')[1];
        instancePrice = (+b);
        instanceValue = (+b) / (+subscriptionValue);
        instanceValue = (+instanceValue * 100) / 100;
    }
    
    pack.compute.instance.name = $('.Virtual-Machine-Select').val().split(' | ')[3].split(" ").join("");
    pack.compute.instance.price = $('.Virtual-Machine-Select').val().split(' | ')[1];
    pack.compute.instance.core = $('.Virtual-Machine-Select').val().split(' | ')[2];


    azcp = 0;
    dcp = 0;
    ctp = 0;

    azmdp = 0;
    dxmdp = 0;
    mdtp = 0;

    lp = 0;
    olp = 0;
    azctp = 0;
    dxcctp = 0;

    tp = 0;
    // var select = document.querySelector('.Operating-System-Select');
    // var osSelect = select.options[select.selectedIndex].value; 
    // console.log();
    var osSelect = $('.Operating-System-Select').val();
    // displaySession();
    var vmSelect = $('.Virtual-Machine-Select').val();


    if (osSelect == 'Windows') {
        olp = parseFloat(1.25);
    } else {
        olp = parseFloat(2);
    }

    // if ($('.Subscription-Select').val().includes("Pay")) {

    // }
    // let lines = vmSelect.split(' | ');
    var cn = $('.Virtual-Machine-Select').val().split(' | ')[2];
    lp = (+cn) * olp;
    azcp = +instanceValue;
    ctp = +azcp;
    tp = +azcp + lp;

    azctp = +azctp + azcp;

    // console.log(cn, lp, azcp, ctp, tp);

    pack.compute.price.azurePrice = + instanceValue;
    pack.compute.price.totalPrice = + pack.compute.price.azurePrice + pack.compute.price.dxcPrice;
    pack.charges.licenses = + lp;

    pack.charges.azureCharges = + pack.compute.price.azurePrice;
    // pack.charges.azureCharges = + pack.compute.price.azurePrice + pack.managedDisks[disk_cpt].price.azurePrice;
    // pack.charges.dxcCharges = pack.compute.price.dxcPrice + pack.managedDisks.price.dxcPrice;
    pack.charges.totalCharges = + pack.charges.licenses + pack.charges.azureCharges + pack.charges.dxcCharges;


    azCp.textContent = ` = ${pack.compute.price.azurePrice} €`;
    dxCp.textContent = ` = ${pack.compute.price.dxcPrice} €`;
    cTp.textContent = ` = ${pack.compute.price.totalPrice} €`;

    azCharges.textContent = ` = ${pack.charges.azureCharges} €`;
    dxcCharges.textContent = ` = ${pack.charges.dxcCharges} €`;
    licensePrice.textContent = ` = ${pack.charges.licenses} €`;
    totalPrice.textContent = ` = ${pack.charges.totalCharges} €`;
    
    cart.machines[pack_cpt] = pack;
    // console.clear();
    // console.log(cart.displayIt());
    display(cart.showIt(), pack_cpt);
    // cart.show();
    // console.log(cart);
}

upTime.addEventListener('change', setEnv);
function setEnv() {
    loc = loc + "&uptime=" + $('.Uptime-Select').val();
    // console.log(loc);
    var test = env.getAttribute("data-source");
    test = test + loc;
    env.setAttribute("data-source", test);
    uptimeValue = $('.Uptime-Select').val();

    pack.compute.uptime = $('.Uptime-Select option:selected').text();

    // totalPrice.textContent = ` = ${tp} €`;

    pack.compute.price.azurePrice = + instanceValue * (+uptimeValue);
    pack.compute.price.totalPrice = + pack.compute.price.azurePrice + pack.compute.price.dxcPrice;
    pack.charges.licenses = + lp;
    pack.charges.azureCharges = + pack.compute.price.azurePrice;
    // pack.charges.dxcCharges = pack.compute.price.dxcPrice + pack.managedDisks.price.dxcPrice;
    pack.charges.totalCharges = + pack.charges.licenses + pack.charges.azureCharges + pack.charges.dxcCharges;


    pack.compute.price.azurePrice = roundDecimal(pack.compute.price.azurePrice, 3);
    pack.compute.price.totalPrice = roundDecimal(pack.compute.price.totalPrice, 3);
    pack.charges.licenses = roundDecimal(pack.charges.licenses, 3);
    pack.charges.azureCharges = roundDecimal(pack.charges.azureCharges, 3);
    // pack.charges.dxcCharges = roundDecimal(pack.charges.dxcCharges, 3);
    pack.charges.totalCharges = roundDecimal(pack.charges.totalCharges, 3);



    azCp.textContent = ` = ${pack.compute.price.azurePrice} €`;
    dxCp.textContent = ` = ${pack.compute.price.dxcPrice} €`;
    cTp.textContent = ` = ${pack.compute.price.totalPrice} €`;

    azCharges.textContent = ` = ${pack.charges.azureCharges} €`;
    dxcCharges.textContent = ` = ${pack.charges.dxcCharges} €`;
    licensePrice.textContent = ` = ${pack.charges.licenses} €`;
    totalPrice.textContent = ` = ${pack.charges.totalCharges} €`;

    cart.machines[pack_cpt] = pack;
    // console.clear();
    // console.log(cart.displayIt());
    display(cart.showIt(), pack_cpt);
    // cart.show();
    // console.log(cart);
}

env.addEventListener('change', setType);
function setType() {
    loc = loc + "&env=" + $('.Environment-Select').val();
    // console.log(loc);
    var test = type.getAttribute("data-source");
    test = test + loc;
    type.setAttribute("data-source", test);


    environmentValue = $('.Environment-Select').val();
    pack.compute.environment.name = $('.Environment-Select option:selected').text();
    pack.compute.environment.charges = $('.Environment-Select').val();

    // displaySession();

    // displayWithUptime();
    // dataSetter(dataSaver);
    let udcp = 0;
    let lines = $('.Environment-Select').val();
    dcp = +lines;
    ctp = +ctp + dcp;
    tp = +ctp + lp;

    pack.compute.price.dxcPrice = + environmentValue;
    pack.compute.price.totalPrice = + pack.compute.price.azurePrice + pack.compute.price.dxcPrice;
    // pack.charges.licenses = lp;
    pack.charges.azureCharges = pack.compute.price.azurePrice;
    // pack.charges.dxcCharges = pack.compute.price.dxcPrice + pack.managedDisks.price.dxcPrice;
    pack.charges.dxcCharges = pack.compute.price.dxcPrice;
    pack.charges.totalCharges = pack.charges.licenses + pack.charges.azureCharges + pack.charges.dxcCharges;


    // azCp.textContent = ` = ${pack.compute.price.azurePrice} €`;
    dxCp.textContent = ` = ${pack.compute.price.dxcPrice} €`;
    cTp.textContent = ` = ${pack.compute.price.totalPrice} €`;

    // azCharges.textContent = ` = ${pack.charges.azureCharges} €`;
    dxcCharges.textContent = ` = ${pack.charges.dxcCharges} €`;
    licensePrice.textContent = ` = ${pack.charges.licenses} €`;
    totalPrice.textContent = ` = ${pack.charges.totalCharges} €`;

    cart.machines[pack_cpt] = pack;
    // console.clear();
    // console.log(cart.displayIt());
    display(cart.showIt(), pack_cpt);
    // cart.show();
    // console.log(cart);
}

type.addEventListener('change', setRed);
function setRed() {
    loc = loc + "&type=" + $('.Type-Select').val();
    // console.log(loc);
    var test = red.getAttribute("data-source");
    test = test + loc;
    red.setAttribute("data-source", test);

    globalThis.newMd = new ManagedDisks();

    newMd.type = $('.Type-Select').val();
    pack.managedDisks[disk_cpt] = newMd;

    cart.machines[pack_cpt] = pack;
    // console.clear();
    // console.log(cart.displayIt());
    display(cart.showIt(), pack_cpt);
    // cart.show();
    // console.log(cart);
}

red.addEventListener('change', setDD);
function setDD() {
    loc = loc + "&redundancy=" + $('.Redundancy-Select').val();
    // console.log(loc);
    var test = dd.getAttribute("data-source");
    test = test + loc;
    dd.setAttribute("data-source", test);

    newMd.redundancy = $('.Redundancy-Select').val();
    pack.managedDisks[disk_cpt] = newMd;

    cart.machines[pack_cpt] = pack;
    // console.clear();
    // console.log(cart.displayIt());
    display(cart.showIt(), pack_cpt);
    // cart.show();
    // console.log(cart);
}

dd.addEventListener('change', setEnd);
function setEnd() {
    loc = loc + "&datadisk=" + $('.Data-Disks-Select').val();
    // console.log(loc);
    var test = total.getAttribute("data-source");
    test = test + loc;
    total.setAttribute("data-source", test);

    let lines = $('.Data-Disks-Select').val().split(' | ');
    azmdp = +lines[1] / (+lines[2]);

    dxmdp = +0.2051 * azmdp;
    mdtp = +azmdp + dxmdp;
    tp = + 0 + tp + mdtp;

    console.log(azmdp);
    console.log(dxmdp);
    console.log(mdtp);


    newMd.disk.name = $('.Data-Disks-Select').val().split(' | ')[3];
    newMd.disk.price = + lines[1] / (+lines[2]);
    console.log(newMd.disk.price);

    newMd.price.azurePrice = + lines[1] / (+lines[2]);
    newMd.price.dxcPrice = +0.2051 *  newMd.price.azurePrice;
    newMd.price.totalPrice = +  newMd.price.azurePrice + newMd.price.dxcPrice;
    pack.managedDisks[disk_cpt] = newMd;
    // pack.charges.licenses = lp;
    pack.charges.azureCharges = pack.compute.price.azurePrice + newMd.price.azurePrice;
    pack.charges.dxcCharges = pack.compute.price.dxcPrice +  newMd.price.dxcPrice;
    pack.charges.totalCharges = pack.charges.licenses + pack.charges.azureCharges + pack.charges.dxcCharges;


    azMp.textContent = ` = ${ newMd.price.azurePrice} €`
    dxMp.textContent = ` = ${ newMd.price.dxcPrice} €`;
    mdTp.textContent = ` = ${ newMd.price.totalPrice} €`;

    azCharges.textContent = ` = ${pack.charges.azureCharges} €`;
    dxcCharges.textContent = ` = ${pack.charges.dxcCharges} €`;
    licensePrice.textContent = ` = ${pack.charges.licenses} €`;
    totalPrice.textContent = ` = ${pack.charges.totalCharges} € / Month`;

    cart.machines[pack_cpt] = pack;
    // console.clear();
    // console.log(cart.displayIt());
    display(cart.showIt(), pack_cpt);
    // cart.show();
    // console.log(cart);

    mdPush.disabled = false;
    mdPop.disabled = false
    newP.disabled = false;
    doneWP.disabled = false;
}



mdPush.addEventListener('click', pushIn);
function pushIn() {

    console.log("Add a new disk");

    // To UnDisable
    doneWP.disabled = false;

    // To increase
    disk_cpt++;

    // To Disable
    let computeSelects = document.querySelectorAll('.Compute-Area .linked-select')
    computeSelects.forEach(function (elmt) {
        elmt.disabled = true;
    });

    let managedDiskSelects = document.querySelectorAll('.Managed-Disks-Area .linked-select')
    managedDiskSelects.forEach(function (elmt) {
        elmt.selectedIndex = "0";
    })

    azMp.textContent = ` = ${ 0 } €`
    dxMp.textContent = ` = ${ 0 } €`;
    mdTp.textContent = ` = ${ 0 } €`;

    mdPush.disabled = true;
}


// A refaire !!!!
mdPop.addEventListener('click', popOut);
function popOut() {

    // To Disable
    let managedDiskSelects = document.querySelectorAll('.Managed-Disks-Area .linked-select')
    managedDiskSelects.forEach(function (elmt) {
        elmt.selectedIndex = "0";
    })
    
    if (pack.managedDisks.length < 2) {
        mdPop.disabled = true;
    } else {
        console.log("Popped");

        // pack.managedDisks
        pack.managedDisks.pop();
        disk_cpt--;
        mdPush.disabled = true;

        pack.setCharges();
    
        azMp.textContent = ` = ${ 0 } €`
        dxMp.textContent = ` = ${ 0 } €`;
        mdTp.textContent = ` = ${ 0 } €`;

        azCharges.textContent = ` = ${pack.charges.azureCharges} €`;
        dxcCharges.textContent = ` = ${pack.charges.dxcCharges} €`;
        licensePrice.textContent = ` = ${pack.charges.licenses} €`;
        totalPrice.textContent = ` = ${pack.charges.totalCharges} € / Month`;
    }

    // console.clear();
    console.log(pack.displayIt());
    display(cart.showIt());
}





function initTable() {
    // document.getElementById("output").innerHTML = '<thead> <tr> <th colspan="13">ALSTOM COSTING CALCULATOR</th> </tr> </thead>';
    document.getElementById("output").innerHTML = '';
}

function createEmptyTable(cpt) {
    // let out = "";
    let empT = '<tbody> <tr id="tb' +
               cpt+'l0"> <td rowspan="10">COMPUTE</td> <td>REGION</td> <td id="region"></td> <td rowspan="6">NON COMPUTE</td> <td>TYPE</td> </tr> <tr id="tb'+
               cpt+'l1"> <td>OPERATING SYSTEM</td> <td id="os"></td> <td>REDUNDANCY</td> </tr> <tr id="tb'+
               cpt+'l2"> <td>SUBSCRIPTION</td> <td id="subs"></td> <td>DISKS</td> </tr> <tr id="tb'+
               cpt+'l3"> <td>SERIE</td> <td id="serie"></td> <td>AZURE</td> </tr> <tr id="tb'+
               cpt+'l4"> <td>VM</td> <td id="vm"></td> <td>DXC</td> </tr> <tr id="tb'+
               cpt+'l5"> <td>UPTIME</td> <td id="uptime"></td> <td>TOTAL</td> </tr> <tr id="tb'+
               cpt+'l6"> <td>ENVIRONMENT</td> <td id="environment"></td> <td rowspan="4">CHARGES</td> <td>LICENSES</td> </tr> <tr id="tb'+
               cpt+'l7"> <td>AZURE</td> <td id="azcp"></td> <td>AZURE CHARGES</td> </tr> <tr id="tb'+
               cpt+'l8"> <td>DXC</td> <td id="dxccp"></td> <td>DXC CHARGES</td> </tr> <tr id="tb'+
               cpt+'l9"> <td>TOTAL</td> <td id="ctp"></td> <td>TOTAL CHARGES</td> </tr> </tbody>';
    document.getElementById("output").innerHTML += empT;
}


function outputBuild() {
    // toSet = [];
    // j = 0;
    for (let i = 0; i < cart.machines.length; i++) {
        createEmptyTable(i);
        document.getElementById("tb" + i + "l0").querySelector("#region").innerHTML = cart.machines[i].compute.region;
        document.getElementById("tb" + i + "l1").querySelector("#os").innerHTML = cart.machines[i].compute.operatingSystem;
        document.getElementById("tb" + i + "l2").querySelector("#subs").innerHTML = cart.machines[i].compute.subscription;
        document.getElementById("tb" + i + "l3").querySelector("#serie").innerHTML = cart.machines[i].compute.serie;
        document.getElementById("tb" + i + "l4").querySelector("#vm").innerHTML = cart.machines[i].compute.instance.name;
        document.getElementById("tb" + i + "l5").querySelector("#uptime").innerHTML = cart.machines[i].compute.uptime;
        document.getElementById("tb" + i + "l6").querySelector("#environment").innerHTML = cart.machines[i].compute.environment.name;
        document.getElementById("tb" + i + "l7").querySelector("#azcp").innerHTML = cart.machines[i].compute.price.azurePrice + " €";
        document.getElementById("tb" + i + "l8").querySelector("#dxccp").innerHTML = cart.machines[i].compute.price.dxcPrice + " €";
        document.getElementById("tb" + i + "l9").querySelector("#ctp").innerHTML = cart.machines[i].compute.price.totalPrice + " €";

        for (let j = 0; j < cart.machines[i].managedDisks.length; j++) {
            document.getElementById("tb" + i + "l0").innerHTML += "<td>" + cart.machines[i].managedDisks[j].type + "</td>";
            document.getElementById("tb" + i + "l1").innerHTML += "<td>" + cart.machines[i].managedDisks[j].redundancy + "</td>";
            document.getElementById("tb" + i + "l2").innerHTML += "<td>" + cart.machines[i].managedDisks[j].disk.name + "</td>";
            document.getElementById("tb" + i + "l3").innerHTML += "<td>" + cart.machines[i].managedDisks[j].price.azurePrice + " €</td>";
            document.getElementById("tb" + i + "l4").innerHTML += "<td>" + cart.machines[i].managedDisks[j].price.dxcPrice + " €</td>";
            document.getElementById("tb" + i + "l5").innerHTML += "<td>" + cart.machines[i].managedDisks[j].price.totalPrice + " €</td>";
        }

        document.getElementById("tb" + i + "l6").innerHTML += "<td>" + cart.machines[i].charges.licenses + " €</td>";
        document.getElementById("tb" + i + "l7").innerHTML += "<td>" + cart.machines[i].charges.azureCharges + " €</td>";
        document.getElementById("tb" + i + "l8").innerHTML += "<td>" + cart.machines[i].charges.dxcCharges + " €</td>";
        document.getElementById("tb" + i + "l9").innerHTML += "<td>" + cart.machines[i].charges.totalCharges + " €</td>";

    }


}



doneWP.addEventListener('click', printPDF);
function printPDF() {

    console.log("Print PDF");
    // location.href = '../php/import.php';

    // document.location.href = 'scripts/php/import.php';
    // document.location.assign('scripts/php/import.php');

    // window.open('scripts/php/import.php');

    // $( "#Done-Zone" ).on( "click", function() {
    //   $( "#dialog" ).dialog( "open" );
    // });
    // pack.

    initTable();
    outputBuild();
    // createEmptyTable(pack_cpt);
    // document.getElementById("tb-0").querySelector(".tb-region").innerHTML = "yo";
}





newP.addEventListener('click', clearAll);
function clearAll() {
    ans = document.getElementById("Logs-Area").innerHTML;
    // To increase
    pack_cpt++;
    console.log("Reload");

    let allSelects = document.querySelectorAll('.linked-select')
    allSelects.forEach(function (elmt) {
        elmt.selectedIndex = "0";
        elmt.disabled = false;
    })

    dataReloader();
}



function dataMaster(dataFromCache) {

}


function ExportToExcel(type, fn, dl) {
    var elt = document.getElementById('output');
    var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
    return dl ?
        XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }) :
        XLSX.writeFile(wb, fn || ('MySheetName.' + (type || 'xlsx')), {cellStyles:true});
}




// $(function () {
//     $(".Logs-Area .Logs").draggable(
//     {
//         // snap : true,
//         // appendTo: "body",
//         revert : "invalid",
//         stop : handleDragStop
//     });

//     function handleDragStop(event, ui) {
        
//     }

//     $("body").droppable({
//         drop: function (event, ui) {
//             ui.draggable.remove();
//             // $(ui).hasClass("");
//             console.log(ui);
//             console.log(ui.draggable[0]);
//         }
//     })
// });