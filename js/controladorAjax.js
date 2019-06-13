$(document).ready(function () {
    window.onload = cantidadVentas();
    window.onload = cantidadVendidos();
	//---------EVENTOS------------
    //inicializacion de relog
    $('.timepicker').pickatime({
    default: 'now', // Set default time: 'now', '1:30AM', '16:30'
    fromnow: 0,       // set default time to * milliseconds from now (using with default = 'now')
    twelvehour: false, // Use AM/PM or 24-hour format
    donetext: 'LISTO', // text for done-button
    cleartext: 'BORRAR', // text for clear-button
    canceltext: 'CANCELAR', // Text for cancel-button
    autoclose: false, // automatic close timepicker
    ampmclickable: false, // make AM PM clickable
    aftershow: function(){} //Function for after opening timepicker
  });
    //inicializacion de los comoponentes
	$('select').material_select();
	$('.modal').modal();
	$('.collapsible').collapsible();
     $('ul.tabs').tabs();

	//evento de cargar datos de lista de pedidos detalles
	$("#listapedidos").click(function (event) {
        $('#actualizar').text(0); 
        $('#notificacion').text(0);
		cargarListaPedidos();
	});
    //listar pedidos vendidos
    $("#pedidosVendidos").click(function (event) {
		cargarListaPedidosVendidos();
	});
    //listar ventas
        $("#ventas").click(function (event) {
             var parametros={
            'fechain':"",
            'fechafi':"",
            'validar':"nofiltrar"
        };
		cargarVentas(parametros);
	});
	//evento de cargar datos de Imagenes
	$("#imagenes").click(function (event) {
		cargarTabla("IMAGENES");
	});

	//evento de cargar datos de Platillos
	$("#platillos").click(function (event) {
		cargarTabla("PLATILLOS");
	});
	//evento de cargar datos del Menu
	$("#menuP").click(function (event) {
		cargarTabla("MENU");
	});
	//evento de cargar datos de Administradores
	$("#admin").click(function (event) {
		cargarTabla("ADMINISTRADORES");
	});
     
  	//evento de formatear fecha
	$("#formatofecha").click(function (event) {
       
      var fechainicio=$('#fechainicio').val();
      var fechafin=$('#fechafin').val();
    
        var parametros={
            'fechain':fechainicio,
            'fechafi':fechafin,
            'validar':"filtrar"
        };
    filtrarVentas(parametros);
	});
	//evento del boton editar Imagenes
	$('button[id=btnEditarImg]').click(function (event) {
		var datos = $(this).data("id");
		var nombre = $(this).val();
		$('#nombre-imga').val(nombre);
		$('#id').val(datos);
		$('#eliminar').val(nombre);
		$('#tabla').val("IMAGENES");
        //$('#list1').html('<img src="./assets/img/'+nombre+'" alt="">');
		$('#modalAI').modal('open');
       
	});
	//evento del boton editar Platillos
	$('button[id=btnEditarP]').click(function (event) {
		var datos = $(this).data("id");
        var dia=$(this).data("dia");
        var idimg=$(this).data("img");
		var id = $(this).val();
		var p = $(this).parent();
		var clave = p.siblings('td')[0].innerHTML;
		var nombre = p.siblings('td')[1].innerHTML;
		var cantidad = p.siblings('td')[2].innerHTML;
		var precio = p.siblings('td')[3].innerHTML;
		var nombreimg = p.siblings('td')[5].innerHTML;
        var nombredia = p.siblings('td')[6].innerHTML;
		$('#clavePlatilloA').val(clave);
		$('#nombrePlatilloA').val(nombre);
		$('#cantidadPlatilloA').val(cantidad);
		$('#precioPlatilloA').val(precio);
		$('#idA').val(id);
		$('#btnActulizarP').val(datos);
		$('#nombreimgA').val(nombreimg);
        $('#idMenuA').val(dia);
        $('#menuDiaPA').val(nombredia);
        $('#idA').val(idimg);
		$('#modalAI').modal('open');
	});
    //evento del boton editar administradores
	$('button[id=btnEditarAdmin]').click(function (event) {
		var contar=$(this).data("contra");
        var nombre=$(this).data("nombre");
        var clave=$(this).data("id");
		$('#nombreAdminA').val(nombre);
        $('#contraAdminA').val(contar);
		$('#btnActualizarAdmin').val(clave);
		$('#modalAAdmin').modal('open');
       
	});
   
    $('button[id=btnSeleccionDia]').click(function (event) {
        event.preventDefault();
        var valor=$(this).val();
        $('#diaMenuActualizar').val(valor);
       $('ul[class=collapsible]').collapsible('close', 0);
    });
    //evento de selecionar dia en Guardar Menu
	$('button[id=btnSeleccionDiaG]').click(function (event) {
        event.preventDefault();
		var valor = $(this).val();
		$('#diaMenuG').val(valor);
		$('ul[class=collapsible]').collapsible('close', 0);
	});
    //selecionar dia en platillos guardar
    	$('button[id=btnSelectMenu]').click(function (event) {
        event.preventDefault();
        var idM=$(this).data("idm");
        var dia=$(this).data("dia");  
		
        $('#idMenu').val(idM);
		$('#menuDiaP').val(dia);
            
		$('ul[class=collapsible]').collapsible('close', 0);
	});
    //selecionar dia en platillos actualizar 
   	$('button[id=btnSelectMenuA]').click(function (event) {
        event.preventDefault();
        var idM=$(this).data("idm");
        var dia=$(this).data("dia");  
		
        $('#idMenuA').val(idM);
		$('#menuDiaPA').val(dia);
            
		$('ul[class=collapsible]').collapsible('close', 0);
	});
  

    $("#btnCalcular").click(function (event) {

        calcularPrecioTotalVentas();
    });
    // calcular precio total de la venta
    
   function calcularPrecioTotalVentas(){
    var SUMA = $("#tablaV tbody > tr");
    var TOTAL = 0;
    SUMA.each(function () {
        var SUBTOTAL = $(this).find("td[class='sumar']").text();
        if (SUBTOTAL !== '') {
         
            TOTAL = ((TOTAL) + (parseInt(SUBTOTAL)));
        }
    });
    document.getElementById('IngresoTotal').innerHTML = TOTAL;
};
	//evento del boton editar Platillos
	$('button[id=btnEditarM]').click(function (event) {
        
		var datos = $(this).data("id");
		var id = $(this).val();
		var p = $(this).parent();
		var clave = p.siblings('td')[0].innerHTML;
		var dia = p.siblings('td')[1].innerHTML;
		var promociones = p.siblings('td')[2].innerHTML;
        var horaapeA=p.siblings('td')[3].innerHTML;
       var horacierreA=p.siblings('td')[4].innerHTML;
       
        $('#diaMenuActualizar').val(dia);
        $('#promocionMA').val(promociones);
		$('#horaapeMA').val(horaapeA);
		$('#horacierMA').val(horacierreA);
        $('#btnActulizarM').val(datos);
		$('#modalAI').modal('open');
	});
	//evento de suvir imagen al servidor y guardar
	$('#form-subir').submit(function (event) {
        event.preventDefault();
        var datos = this;
        var validar=$('#btnValidar').val()
        if(validar=="true"){
		$('#nombre-img').val("");
		$('#modalGI').modal('close');
		Subirimg(datos);
        };
	});
	//evento del boton actualizar imagen en el servidor y bd
	$('#form-actualizar').submit(function (event) {
		event.preventDefault();
		var formData = new FormData(document.getElementById("form-actualizar"));
		formData.append("dato", "valor");
		$('#nombre-imga').val("");
		$('#id').val("");
		$('#eliminar').val("");
		$('#modalAI').modal('close');
		actualizarimg(formData);
	});
	//evento del boton guardar Platillos
	$('#btnGuardarPlatillos').click(function (event) {
		var validar = $('#clavePlatillo').val();
		var nombre = $('#nombrePlatillo').val();
		var img = $('#id').val();
        var idMenu = $('#idMenu').val();
		if (validar.length > 0 && nombre.length > 0 && img.length > 0&& idMenu.length > 0) {
			var parametros = {
				'clave': validar,
				'nombre': nombre,
				'cantidad': $('#cantidadPlatillo').val(),
				'precio': $('#precioPlatillo').val(),
				'idimg': img,
                'idmenu': idMenu,
				'tabla': "PLATILLOS"
			};
			limpiarFormPlatillos();
			$('#modalGI').modal('close');
			guardarDatos(parametros);

		} else {
			Materialize.toast('Ingresa una clave,nombre, día y imagen', 6000);
		}

	});
  
	//evento del boton guardar Menu
	$('#btnGuardarMenu').click(function (event) {
        
        var dia = $('#diaMenuG').val();
        var promo = $('#promocionM').val();
		var hoape = $('#horaapeM').val();
		var hocierre = $('#horacierM').val();
		if (dia.length > 0 && hoape.length > 0 && hocierre.length > 0) {
			var parametros = {
				'dia': dia,
                'pro': promo,
				'ha': hoape,
				'hc': hocierre,
				'tabla': "MENU"
			};
			limpiarFormMenu();
			$('#modalGI').modal('close');
			guardarDatos(parametros);

		} else {
			Materialize.toast('Ingresa el día, hora de apertura y hora de cierre', 5000);
		}

	});
    //evento del boton guardar Administradores
	$('#btnGuardarAdmin').click(function (event) {
   
        var nombread=$('#nombreAdmin').val();
        
        var contraad=$('#contraAdmin').val();
      
		
		if(nombread.length > 0 && contraad.length > 0) {
			var parametros = {
				'nombreadmin': nombread,
                'contraadmin': contraad,
				'tabla': "ADMINISTRADORES"
			};
			limpiarFormAdmin();
            
			$('#modalGAdmin').modal('close');
			guardarDatos(parametros);

		}else {
			Materialize.toast('Ingresa un nombre y contraseña', 6000);
		}

	});
    //evento del boton actualizar Administradores
	$('#btnActualizarAdmin').click(function (event) {
        var id=$(this).val();
        var nombread=$('#nombreAdminA').val();
        var contraad=$('#contraAdminA').val();
        		
		if(nombread.length > 0 && contraad.length > 0) {
			var parametros = {
                'idadmin':id,
				'nombreadmin': nombread,
                'contraadmin': contraad,
				'tabla': "ADMINISTRADORES"
			};
			limpiarFormAdminA();
            
			$('#modalAAdmin').modal('close');
			actualizarDatos(parametros);

		}else {
			Materialize.toast('Ingresa un nombre y contraseña', 6000);
		}

	});
	//evento del boton actualizar Platillos
	$('#btnActulizarP').click(function (event) {
		var id = $(this).val();
            var validarA=$('#clavePlatilloA').val();
			var nombreA=$('#nombrePlatilloA').val();
			var cantidadA=$('#cantidadPlatilloA').val();
			var precioA=$('#precioPlatilloA').val();
            var idMenuA=$('#idMenuA').val();
            var imgA=$('#idA').val();
            if (validarA.length > 0 && nombreA.length > 0 && imgA.length > 0 && idMenuA.length > 0) {
		var parametros = {
			"tabla": "PLATILLOS",
			"id": id,
			"clave": validarA,
			"nombre": nombreA,
			"cantidad": cantidadA,
			"precio": precioA,
			"idimg": imgA,
            "idmenu": idMenuA
		};

		$('#modalAI').modal('close');
		actualizarDatos(parametros)
            }else{
               Materialize.toast('Ingresa una clave,nombre, día y imagen', 6000); 
            }
	});
	//evento del boton actualizar Menu
	$('#btnActulizarM').click(function (event) {
		var id = $(this).val();
        var dia = $('#diaMenuActualizar').val();
        var promo = $('#promocionMA').val();
		var hoape = $('#horaapeMA').val();
		var hocierre = $('#horacierMA').val();
        if (dia.length > 0 && hoape.length > 0 && hocierre.length > 0) {
           var parametros = {
			"id": id,
			"dia": dia,
			"pro": promo,
			"ha": hoape,
            "hc": hocierre,
            "tabla": "MENU"
		};

		$('#modalAI').modal('close');
		actualizarDatos(parametros) 
            
        }else{
            Materialize.toast('Ingresa el día, hora de apertura y hora de cierre', 5000);
        }
		
	});

	//evento de selecionar imagen en Guardar Platillos
	$('button[id=btnSeleccionGurdarP]').click(function (event) {
       event.preventDefault();
		var idimg = $(this).data("idimg");
		var nombre = $(this).data("nom");
		$('#nombreimg').val(nombre);
		$('#id').val(idimg);
		$('ul[class=collapsible]').collapsible('close', 0);
	});
	
	//evento de selecionar imagen en Actualizar Platillos
	$('button[id=btnSeleccionActualizarP]').click(function (event) {
        event.preventDefault();
		var datos = $(this).data("id");
		var id = $(this).val();
		$('#nombreimgA').val(datos);
		$('#idA').val(id);
		$('ul[class=collapsible]').collapsible('close', 0);
	});
	
	//evento de cerrar modal Imagenes
	$('#btnCancelar').click(function (event) {
		$('#nombre-img').val("");
		$('#modalGI').modal('close');
	});
    //evento de cerrar modal administradores
	$('#btnCancelarAdmin').click(function (event) {
		//$('#nombre-img').val("");
		$('#modalGAdmin').modal('close');
	});
    $('#btnCancelarAdminA').click(function (event) {
		//$('#nombre-img').val("");
		$('#modalAAdmin').modal('close');
	});
	//evento de eliminar Imagenes--------------
	$('button[id=btnEliminarImg]').click(function (e) {
		var datos = $(this).data("id");
		var $toastContent = $('<span>Desea eliminar este dato</span>').add($('<button onclick="siEliminarImg(' + datos + ')" class="btn-flat toast-action">Si</button><button onclick="no()" class="btn-flat toast-action">No</button>'));
		Materialize.toast($toastContent, 5000);
	});
	//evento de eliminar Platillos--------------
	$('button[id=btnEliminarP]').click(function (e) {
		var datos = $(this).data("id");
		var $toastContent = $('<span>Desea eliminar este dato</span>').add($('<button onclick="siEliminarP(' + datos + ')" class="btn-flat toast-action">Si</button><button onclick="no()" class="btn-flat toast-action">No</button>'));
		Materialize.toast($toastContent, 5000);
	});
	//evento de eliminar Menu--------------
	$('button[id=btnEliminarMenu]').click(function (e) {
		var datos = $(this).data("id");
		var $toastContent = $('<span>Desea eliminar este dato</span>').add($('<button onclick="siEliminarM(' + datos + ')" class="btn-flat toast-action">Si</button><button onclick="no()" class="btn-flat toast-action">No</button>'));
		Materialize.toast($toastContent, 5000);
	});
    //evento de eliminar Administradores--------------
	$('button[id= btnEliminarAdmin]').click(function (e) {
		var datos = $(this).data("id");
		var $toastContent = $('<span>Desea eliminar este Administrador</span>').add($('<button onclick="siEliminarAdmin(' + datos + ')" class="btn-flat toast-action">Si</button><button onclick="no()" class="btn-flat toast-action">No</button>'));
		Materialize.toast($toastContent, 5000);
	});
   
	//evento del boton nuevo registro abre un modal limpio
	$('#btn-modal').click(function (event) {
		$('#modalGI').modal('open');
		//$('#modalGI').modal('open');
	});
    //evento del boton nuevo registro abre un modal limpio Adminstrador
	$('#btn-modalAdmin').click(function (event) {
		$('#modalGAdmin').modal('open');
		//$('#modalGI').modal('open');
	});
 //////////evento ventas   
    //venta
    $('.btn-vender').click(function(e){
        var total=$(this).data("total");
        var id=$(this).data("id");
        e.preventDefault();
        swal({   
            title: "REALIZAR VENTA",   
            text: "Total del Pedido: $ "+total+".00 MX",   
            type: "input",   
            showCancelButton: true,   
            closeOnConfirm: false,   
            animation: "slide-from-top",   
            inputPlaceholder: "Ingresa La Cantidad Recivida",
            confirmButtonText: "Realizar Venta",
            cancelButtonText: "Cancelar" 
        }, function(inputValue){   
            if (inputValue === false) return false;      
            if (inputValue === "" || inputValue<total || (isNaN(inputValue))) 
            { 
            swal.showInputError("Ingresa Una Cantidad Mayor al Total");     
            return false   
            }      
            swal("","El cambio es: $" + (inputValue-total)+".00 MX", "success"); 
            realizarVenta(total,id);
        });    
    }); 
    $('button[id=botonMapa]').click(function (event) {
        var ubiadmin=$(this).data("ubi");

      $('#modalMapa').modal('open');
        //ubicacionSigsa(ubiadmin);
        findMe(ubiadmin);
        
        var btn = $('#administradorUbi');
        btn.attr('data-ubi',ubiadmin);
    });

    $('#administradorUbi').click(function (event) {
      var ubiadmin=$(this).data("ubi");
         findMe(ubiadmin);
         $(this).removeData("ubi");
    });
    $('a[id=btnCancelarUbicacion]').click(function (event) { 
      $('#modalMapa').modal('close');
    });
     $('.btn-vender').click(function(e){
        var total=$(this).data("total");
        var id=$(this).data("id");
        e.preventDefault();
        swal({   
            title: "REALIZAR VENTA",   
            text: "Total del Pedido: $ "+total+".00 MX",   
            type: "input",   
            showCancelButton: true,   
            closeOnConfirm: false,   
            animation: "slide-from-top",   
            inputPlaceholder: "Ingresa La Cantidad Recivida",
            confirmButtonText: "Realizar Venta",
            cancelButtonText: "Cancelar" 
        }, function(inputValue){   
            if (inputValue === false) return false;      
            if (inputValue === "" || inputValue<total || (isNaN(inputValue))) 
            { 
            swal.showInputError("Ingresa Una Cantidad Mayor al Total");     
            return false   
            }      
            swal("","El cambio es: $" + (inputValue-total)+".00 MX", "success"); 
            realizarVenta(total,id);
        });    
    }); 
    
    $('button[id=btnAceptar]').click(function (event) { 
      
     
        var id=$(this).data("id");
        var parametros={
            'id':id,
            'estado':"aceptado"
         
        };
        actualizarEstadoPedidos(parametros);   
      

    });
    $('button[id=btnRechazar]').click(function (event) { 
        var id=$(this).data("id");
        var parametros={
            'id':id,
            'estado':"rechazado"
        };
        actualizarEstadoPedidos(parametros);
    });
    
   /////////////-------NOTIFICACIONES-------/////////////////// 
    
    setInterval("calcularAutomatico()", 2000);
    setInterval("actualizar()", 9000);
});
function calcularAutomatico(){
    var valor=$('#IngresoTotal').text();
    if(valor=="0"){
         $("#btnCalcular").click();
    }
}
////////////-------LISTADO PEDIDOS---------/////////////////
function actualizarEstadoPedidos(parametros){
    $.ajax({
		data: parametros,
		url: "./vistas/modificarEstadoPedido.php",
		type: 'post',
	
	success: function (response) {
         $('#conten-detalles').html(response);
     cargarListaPedidos();
		}
	});
};
function actualizar(){
    var parametros={
        'tabla':"PENDIENTE"
    };
    $.ajax({
		data: parametros,
		url: "./vistas/actualizar.php",
		type: 'post',
	
	success: function (response) {
        if(response!="0"){
         Materialize.toast('Tienes: '+response+' Pedidos Nuevos',8000,"rounded");
         document.getElementById('alerta').play();
         Materialize.toast('Actualiza tu lista de pedidos',8000,"rounded");
         $('#actualizar').text(response); 
        $('#notificacion').text(response);
        }
		}
	});
    
};
    function realizarVenta(total,id){
        var idAdmin=$('#idAdmin').text();
        var parametros={
            'total':total,
            'id':id,
            'admin':idAdmin
        }
            $.ajax({
		data: parametros,
		url: "./vistas/realizarVentas.php",
		type: 'post',
	
	success: function (response) {
        $('#conten-detalles').html(response);
       cargarListaPedidos();
  
		}
	}); 
    };
//cantidad de ventas
 function cantidadVentas(){
        $.ajax({
		url: "./vistas/cantidadVentas.php",
		type: 'post',
	success: function (response) {
        $("#totalVentas").text(response);
		}
	}); 
};
//cantidad de pedidos vendidos
 function cantidadVendidos(){
        $.ajax({
		url: "./vistas/cantidadVendidos.php",
		type: 'post',
	success: function (response) {
        $("#totalVendidos").text(response);
		}
	}); 
};

//Mostrar mapa
var arregloPines=[];
function findMe(ubi) {
	var divConte = document.getElementById('mapa');
	if (navigator.geolocation) {
		divConte.innerHTML = "<p> Tu navegador soporta geolocalizacion</p>";
	} else {
		divConte.innerHTML = "<p> No lo soporta</p>";
	}
navigator.geolocation.getCurrentPosition(localizacion, error);
	function localizacion(posicion) {
		var latitude = posicion.coords.latitude;
		var longitude = posicion.coords.longitude;
        var latLng = new google.maps.LatLng(latitude, longitude);
      
    var nuevo=ubi.substr(1,(ubi.length)-2);
     var corte1=nuevo.indexOf(",");
     var lati=nuevo.substr(0,corte1);
     var long=nuevo.substr(corte1+1,nuevo.length);
    var ubicacionCliente = new google.maps.LatLng(lati,long);
        
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer({
            suppressMarkers: true
        });
        var map = new google.maps.Map(document.getElementById('mapa'), {
          zoom: 19,
          gestureHandling: 'cooperative',
          center: latLng
        });
        directionsDisplay.setMap(map);
        sigsaInfo(map, latLng);
        clienteInfo(map, ubicacionCliente);
        calculateAndDisplayRoute(latLng,ubicacionCliente,directionsService, directionsDisplay);
         map.addListener('click', function(e) {
   var nuevaUbi=e.latLng;
      for(var i in arregloPines){
  arregloPines[i].setMap(null);
    }
    // map.setDirections(null);
     sigsaInfo(map, nuevaUbi);
     clienteInfo(map, ubicacionCliente);
 calculateAndDisplayRoute(nuevaUbi,ubicacionCliente,directionsService, directionsDisplay);
});
};
      function calculateAndDisplayRoute(latLng,ubicacionCliente,directionsService, directionsDisplay) {
        directionsService.route({
          origin: latLng,
          destination: ubicacionCliente,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
          } else {
                Materialize.toast('No se pudo trazar la ruta', 5000);
          }
        });
      }
	function error() {
		 Materialize.toast('No se pudo obtener tu ubicación', 5000);
	}
}
function ubicacionSigsa(ubi) {
    var nuevo=ubi.substr(1,(ubi.length)-2);
     var corte1=nuevo.indexOf(",");
     var lati=nuevo.substr(0,corte1);
     var long=nuevo.substr(corte1+1,nuevo.length);
    var ubicacionCliente = new google.maps.LatLng(lati,long);
	var map = new google.maps.Map(document.getElementById('mapa'), {
		center: ubicacionCliente,
		zoom: 19,
		gestureHandling: 'cooperative'
	});
    sigsaInfo(map, ubicacionCliente);
}
function sigsaInfo(map, sigsa) {
	var contentString = '<div id="conte-cliente">' +
		'<div id="cont-imgcli"><img src="./imgpg/Sigsa-v6.png" alt="" id="cliente">' +
		'</div>' +
		'</div>';
	var infowindow = new google.maps.InfoWindow({
		content: contentString
	});
	var marker = new google.maps.Marker({
		map: map,
		position: sigsa,
		title: 'Comida Oriental Sigsa'
	});
    arregloPines.push(marker);
	marker.addListener('click', function () {
		infowindow.open(map, marker);
	});
}
function clienteInfo(map, latLng) {
var contentStringCli = '<div id="conte-cliente">' +
		'<div id="cont-imgcli"><img src="./imgpg/clienteubicacion.png" alt="" id="cliente">' +
		'</div>' +
		'</div>';
	var infowindow = new google.maps.InfoWindow({
		content: contentStringCli
	});
	var marker = new google.maps.Marker({
		map: map,
		position: latLng,
		title: 'EL CLIENTE'
	});
 arregloPines.push(marker);
	marker.addListener('click', function () {
		infowindow.open(map, marker);
	});
};
///////////------FIN-----LISTADO PEDIDOS---------/////////////////
//Visualizar Y validar Imagen
function archivo(evt) {
            var ext = document.getElementById("files").value;
            ext = ext.substring(ext.length - 3, ext.length);
            ext = ext.toLowerCase();
            if (ext == 'png' || ext == 'jpg' || ext == 'PNG' || ext == 'JPG') {
                $('#btnValidar').val("true");
                var files = evt.target.files; // FileList object
                // Obtenemos la imagen del campo "file".
                for (var i = 0, f; f = files[i]; i++) {
                    //Solo admitimos imágenes.
                    if (!f.type.match('image.*')) {
                        continue;
                    }
                    var reader = new FileReader();
                    reader.onload = (function(theFile) {
                        return function(e) {
                            // Insertamos la imagen
                            document.getElementById("list").innerHTML = ['<img style="max-width: 100%;" src="', e.target.result, '" title="', escape(theFile.name), '"/>'].join('');
                        };
                    })(f);
                    reader.readAsDataURL(f);
                }
            } else {
                  $('#btnValidar').val("false");
                Materialize.toast('Tu archivo es: ' + ext +
                    ' Solo se admiten archivos JPG Y PNG',5000,"rounded"); 
                document.getElementById("list").innerHTML = '<h3>Solo se admiten archivos JPG Y PNG</h3>';
            }   
};
 document.getElementById('files').addEventListener('change', archivo, false);





//---------FUNCIONES--------
//funcion eliminar datos Imagenes
function siEliminarImg(datos) { 
	var parametros = {
		"datos": datos,
		"tabla": "IMAGENES",
		"campo": "ClaveImg"
	};
	eliminar(parametros);
}
//funcion eliminar datos Platillos
function siEliminarP(datos) {
	var parametros = {
		"datos": datos,
		"tabla": "PLATILLOS",
		"campo": "IdPlatillo"
	};
	eliminar(parametros);
}
//funcion eliminar datos Menu
function siEliminarM(datos) {
	var parametros = {
		"datos": datos,
		"tabla": "MENU",
		"campo": "IdMenu"
	};
	eliminar(parametros);
}
//funcion eliminar datos administradores
function siEliminarAdmin(datos) {
	var parametros = {
		"datos": datos,
		"tabla": "ADMINISTRADORES",
		"campo": "IdAdmin"
	};
	eliminar(parametros);
}
//funcion de rechaso Eliminar------
function no() {
	Materialize.Toast.removeAll();
}
//----------funciones ajax-----------
//funcion cargar tablas
function cargarTabla(tabla) {
	var parametros = {
		'tabla': tabla
	};
	$.ajax({
		data: parametros,
		url: "./vistas/Cargardatos.php",
		type: 'post',
		beforeSend: function () {
			$("#contenedor").load('/vistas/loader.php');
		},
		success: function (response) {
			$("#contenedor").html(response);
		}
	});
};
//funcion eliminar datos
function eliminar(parametros) {
	$.ajax({
		data: parametros,
		url: "./vistas/eliminardatos.php",
		type: 'post',
		beforeSend: function () {
			$("#contenedor").load('vistas/loader.php');
		},
		success: function (response) {
			$("#contenedor").html(response);
			cargarTabla(parametros.tabla);
		}
	});
};
//funcion guardar datos
function guardarDatos(parametros) {
	$.ajax({
		data: parametros,
		url: "./vistas/guardardatos.php",
		type: 'post',
		beforeSend: function () {
			$("#contenedor").load('vistas/loader.php');
		},
		success: function (response) {
			$("#contenedor").html(response);
			cargarTabla(parametros.tabla);

		}
	});

};
//funcion de actualizar Imagen en el servidor y bd
function actualizarimg(formData) {
	$.ajax({
		url: './vistas/actualizardatos.php',
		type: 'post',
		contentType: false,
		dataType: 'html',
		data: formData,
		processData: false,
		cache: false,
		beforeSend: function () {
			$("#contenedor").load('vistas/loader.php');
		},
		success: function (response) {
			$("#contenedor").html(response);
			cargarTabla("IMAGENES");
		}
	});
};
//funcion de subir al servidor y guardar Imagenes
function Subirimg(form) {
	var archivo = new FormData(form);

	$.ajax({
		url: './vistas/subir.php',
		type: 'post',
		contentType: false,
		dataType: 'html',
		data: archivo,
		processData: false,
		cache: false,
		beforeSend: function () {
			$("#contenedor").load('vistas/loader.php');
		},
		success: function (response) {
			$("#contenedor").html(response);
			cargarTabla("IMAGENES");

		}
	});

};
//funcion actualizar datos
function actualizarDatos(parametros) {
	$.ajax({
		data: parametros,
		url: "./vistas/actualizardatos.php",
		type: 'post',
		beforeSend: function () {
			$("#contenedor").load('vistas/loader.php');
		},
		success: function (response) {
			$("#contenedor").html(response);
			cargarTabla(parametros.tabla);
		}
	});
};
//funcion cargar listado de los Pedidos pendientes
function cargarListaPedidos(parametros) {
	$.ajax({
		data: parametros,
		url: "./vistas/listapedidos.php",
		type: 'post',
		beforeSend: function () {
			$("#conten-detalles").load('/vistas/loader.php');
		},
		success: function (response) {
			$("#conten-detalles").html(response);
			//cargarTabla(parametros.tabla);
		}
	});
};
//funcion cargar listado de los Pedidos vendidos
function cargarListaPedidosVendidos(parametros) {
	$.ajax({
		data: parametros,
		url: "./vistas/listaVendidos.php",
		type: 'post',
		beforeSend: function () {
			$("#conten-detalles").load('/vistas/loader.php');
		},
		success: function (response) {
			$("#conten-detalles").html(response);
			//cargarTabla(parametros.tabla);
		}
	});
};
//funcion filtrar ventas por fecha
function filtrarVentas(parametros) {
	$.ajax({
		data: parametros,
		url: "./vistas/listarVentas.php",
		type: 'post',
		beforeSend: function () {
			$("#conten-detalles").load('/vistas/loader.php');
		},
		success: function (response) {
			$("#conten-detalles").html(response);
  
		}
	});
};
//funcion cargar listado de las ventas
function cargarVentas(parametros) {
	$.ajax({
		data: parametros,
		url: "./vistas/listarVentas.php",
		type: 'post',
		beforeSend: function () {
			$("#conten-detalles").load('/vistas/loader.php');
		},
		success: function (response) {
			$("#conten-detalles").html(response);
          
		}  
	});

};
//funcion limpiar datos del formulario platillos
function limpiarFormPlatillos() {
	$('#clavePlatillo').val("");
	$('#nombrePlatillo').val("");
	$('#cantidadPlatillo').val("");
	$('#precioPlatillo').val("")
	$('#id').val("");
    $('#idMenu').val("");
    $('#menuDiaP').val("");
	$('#nombreImg').val("");
};
//funcion limpiar datos del formulario Menu
function limpiarFormMenu() {
    $('#diaM').val("");
    $('#promocionM').val("");
    $('#horaapeM').val("");
    $('#horacierM').val("");
};
function limpiarFormAdmin(){
     $('#nombreAdmin').val("");
    $('#contraAdmin').val("");
};
function limpiarFormAdminA(){
     $('#nombreAdminA').val("");
    $('#contraAdminA').val("");
}