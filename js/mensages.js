 
$('button[id=btnAceptar]').click(function (event) { 
  var estado="aceptado";
   leer(estado);
   
    });
function leer(estado){
    $('ul.tabs').tabs(); 
       if(estado=="aceptado"){
        var $toastContent = $('<span>Desea eliminar este dato</span>').add($('<button class="btn-flat toast-action">Si</button><button onclick="no()" class="btn-flat toast-action">No</button>'));
		Materialize.toast($toastContent, 5000);   
       };
};