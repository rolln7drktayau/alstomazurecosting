$( "#dialog-confirm" ).dialog({
    autoOpen: false,
    resizable: true,
    height: "auto",
    width: 1000,
    modal: true,
    buttons: {
      "Continue": function() {
        $( this ).dialog( "close" );
        // window.open('scripts/php/import.php');
        ExportToExcel('xlsx');
      },
      Cancel: function() {
        $( this ).dialog( "close" );
      }
    }
  });

$("#Done-Zone").on("click", function () {
    $("#dialog-confirm").dialog("open");
});


function roundDecimal(nombre, precision){
  var precision = precision || 2;
  var tmp = Math.pow(10, precision);
  return Math.round( nombre*tmp )/tmp;
}