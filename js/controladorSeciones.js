 $(document).ready(function () {
     window.onload = verificarSesion();
    $('#btnCancelarDC').click(function (e) {
        $('#modalDatosCliente').modal('close');
    });
  $('#btnCancelarClientesS').click(function (e) {
        $('#modalClientes').modal('close');
    });
    $('#btnCancelarClientesC').click(function (e) {
        $('#modalClientesCrear').modal('close');
    });
      $('#btnCerrarSC').click(function (e) {
        document.location.href='./vistas/cerrarSesionClientes.php';
    });

    $('#btnClientes').click(function (e) {
  
       var idcli=$('#idCliente').text();
        
        if(idcli==""){
             $('#modalClientes').modal('open');
        }else{
             $('#modalDatosCliente').modal('open');
        }
       
    });
    // Eventos de registro de clientes  
    $("#btnCrear").click(function (event) {
        $('#modalClientes').modal('close');
        $('#modalClientesCrear').modal('open');
    });     
  
$('#btnIniciarAdmin').click(function (event) { 
        event.preventDefault();
       var nombre=$('#userName').val();
        var contra=$('#contra').val();
        var parametros={
            'no':nombre,
            'co':contra
        };
       validarAdministrador(parametros);
    });
   
     $('#btnClientesS').click(function (event) { 
        event.preventDefault();
       var nombreC=$('#usuarioC1').val();
       var contraC=$('#contraC1').val();
        var parametros={
            'noc':nombreC,
            'coc':contraC
        };
       
       validarClientes(parametros);
    });
 
 });
//validar secion de administrador
function validarAdministrador(parametros){
        $.ajax({
        data: parametros,
		url: "./vistas/validarAdmin.php",
		type: 'post',
	success: function (response) {
        if(response=="valido"){
           // $.post('./home.php', {nombre: "gerardo"});
         document.form1.submit(); 
            //document.location.href='./home.php?n='+parametros.no;
        }else{
          $("#respuesta").text("Usuario u Contraseña incorrectos");
        }
		}
	}); 
};
//validar secion de clientes

function validarClientes(parametros){
        $.ajax({
        data: parametros,
		url: "./vistas/validarClientes.php",
		type: 'post',
	success: function (response) {
        if(response=="valido"){
     
        Materialize.toast('Sesion Iniciada Correctamente', 5000, "rounded");
        document.form2.submit(); 
        
      
        }else{
         $("#respuestaCliente").text("Nombre o Contraseña incorrectos");
        }
		}
	}); 
};
function verificarSesion(){
     var idcli=$('#idCliente').text();
       
     if(idcli==""){
         
     }else{
         
         $('#btnClientes').text("Sesión");
         $('#btnCarrito').removeClass('ocultar');
     }
}