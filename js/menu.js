$(document).ready(function () {
    window.onload = cantidadpedidos();
    var suma = 0;
    var arregloTabla = [];
    $('select').material_select();
    $('.modal').modal();
    $('.collapsible').collapsible();
    $('#btnCancelar').click(function (event) {
        $('#modalAG').modal('close');
    });
    $('a[id=btnAgregar]').on('click', function (e) {
        var idcli=$('#idCliente').text();
        
        if(idcli==""){
            Materialize.toast('Para poder ordenar debes de iniciar sesión. En el apartado "Clientes"', 8000);
        }else{
        var id = $(this).data("id");
        var img = $(this).data("img");
        var pre = $(this).data("pre");
        var nombre = $(this).data("np");
        var btn = $('#btnAgregarLista');
        btn.attr('data-opera', 'agregar');
        btn.attr('data-id', id);
        btn.attr('data-img', img);
        btn.attr('data-precio', pre);
        btn.attr('data-nombre', nombre);
        $('#cantidad').html("Precio del platillo: $ " + pre + ".00 MX");
        $('#nombre').html("Nombre del platillo: " + nombre);
        $('#modalimg').html('<img src="assets/img/' + img + '" alt="" style="max-width:100%">');
        $('#modalAG').modal('open');
        }
    });
    $('#rango').change(function () {
        $('#valor').val($(this).val());
    });
    $('#menos').click(function () {
        if ($('#arroz').val() != 0)

            $('#arroz').val(parseInt($('#arroz').val()) - 1);
    });
    $('#mas').click(function () {
        //Aumentamos el valor del campo
        if ($('#arroz').val() != 10)
            $('#arroz').val(parseInt($('#arroz').val()) + 1);
    });
    $('#menos1').click(function () {
        //Solo si el valor del campo es diferente de 0
        if ($('#pasta').val() != 0)
            //Decrementamos su valor
            $('#pasta').val(parseInt($('#pasta').val()) - 1);
    });
    $('#mas1').click(function () {
        if ($('#pasta').val() != 10)
            $('#pasta').val(parseInt($('#pasta').val()) + 1);
    });
    $('#menos2').click(function () {
        //Solo si el valor del campo es diferente de 0
        if ($('#salsa').val() != 0)
            //Decrementamos su valor
            $('#salsa').val(parseInt($('#salsa').val()) - 1);
    });
    $('#mas2').click(function () {
        if ($('#salsa').val() != 10)
            $('#salsa').val(parseInt($('#salsa').val()) + 1);
    });
    $('#btnAgregarLista').click(function (e) {
     
    
        $('#remover').removeClass('ocultar');
        var tabla = document.getElementById('tablaP');
        var pos = $(this).data("pos");
        var opera = $(this).data("opera");
        var id = $(this).data("id");
        var img = $(this).data("img");
        var precio = $(this).data("precio");
        var nombreN = $(this).data("nombre");
        var cantidad = $('#valor').val();
        var arroz = $('#arroz').val();
        var pasta = $('#pasta').val();
        var salsa = $('#salsa').val();
        
        var total = ((parseInt(precio) * parseInt(cantidad)) + (parseInt(arroz) * 15) + (parseInt(pasta) * 15) + (parseInt(salsa) * 5));
        
        $('#modalAG').modal('close');
        if (opera == 'agregar') {
            var noFilas = (tabla.rows.length) - 1;
            var row = tabla.insertRow(noFilas).outerHTML =
                '<tr id="fila' + noFilas + '">\
   \n<td class="clavep" id="id' + noFilas + '" style="display: none;">' + id + '</td>\
    \n<td id="img' + noFilas + '" style="display: none;">' + img + '</td>\
    \n<td id="tdN1' + noFilas + '"><img src="./assets/img/' + img + '" alt="" style="max-width: 30%;max-height: 30%;"></td>\
    \n<td id="tdN2' + noFilas + '">' + nombreN + '</td>\
    \n<td class="preciounitario" id="tdN3' + noFilas + '">' + precio + '</td>\
    \n<td class="cantidad" id="tdN4' + noFilas + '">' + cantidad + '</td>\
    \n<td class="arroz" id="tdN5' + noFilas + '">' + arroz + '</td>\
    \n<td class="pasta" id="tdN6' + noFilas + '">' + pasta + '</td>\
    \n<td class="salsa" id="tdN7' + noFilas + '">' + salsa + '</td>\
    \n<td class="subtotal" id="tdN9' + noFilas + '">' + total + '</td>\
    \n<td><button class="waves-effect waves-light btn icon-editar" id="btnEditar' + noFilas + '" onclick="editar(' + noFilas + ')"></button>\
    \n<button  class="waves-effect waves-light red btn icon-trash-o" id="btnEliminar' + noFilas + '" onclick="eliminar(' + noFilas + ')"></button>\
    \n</td>\ \n</tr>';
            var $toastContent = $('<span>Tu platillo se agrego a la lista </span>').add($('<a href="#listaTabla">--IR--></a><span> En la lista: ' + (parseInt(noFilas) - 1) + '</span>'));
            Materialize.toast($toastContent, 5000, "rounded");
        }
        if (opera == 'editar') {
            var noFilas = pos;
            document.getElementById('fila' + pos).outerHTML =
                '<tr id="fila' + noFilas + '">\
   \n<td class="clavep" id="id' + noFilas + '" style="display: none;">' + id + '</td>\
    \n<td id="img' + noFilas + '" style="display: none;">' + img + '</td>\
    \n<td id="tdN1' + noFilas + '"><img src="./assets/img/' + img + '" alt="" style="max-width: 30%;max-height: 30%;"></td>\
    \n<td id="tdN2' + noFilas + '">' + nombreN + '</td>\
    \n<td class="preciounitario" id="tdN3' + noFilas + '">' + precio + '</td>\
    \n<td class="cantidad" id="tdN4' + noFilas + '">' + cantidad + '</td>\
    \n<td class="arroz" id="tdN5' + noFilas + '">' + arroz + '</td>\
    \n<td class="pasta" id="tdN6' + noFilas + '">' + pasta + '</td>\
    \n<td class="salsa" id="tdN7' + noFilas + '">' + salsa + '</td>\
    \n<td class="subtotal" id="tdN9' + noFilas + '">' + total + '</td>\
    \n<td><button class="waves-effect waves-light btn icon-editar" id="btnEditar' + noFilas + '" onclick="editar(' + noFilas + ')"></button>\
    \n<button  class="waves-effect waves-light red btn icon-trash-o" id="btnEliminar' + noFilas + '" onclick="eliminar(' + noFilas + ')"></button>\
    \n</td>\ \n</tr>';
        }
        $(this).removeData("id");
        $(this).removeData("img");
        $(this).removeData("precio");
        $(this).removeData("nombre");
        $(this).removeData("opera");
        $(this).removeData("pos");
        calcularTotal();
        
    });

    $('#enviarMub').click(function (e) {
        var ubi = $(this).val();
        $('#ubicacion').val(ubi);
        // $('#ubicacion').attr("readonly","readonly");
        $('#modalUB').modal('open');
    });
    $('#btnCancelarUB').click(function (e) {
        $('#enviarMub').val("");
        $('#ubicacion').val("");
        $('#colonia').val("");
        $('#calles').val("");
        $('#numcasa').val("");
        $('#referencias').val("");
        $('#modalUB').modal('close');

    });

    $('#clienteUB').click(function (e) {
        $('#modalUB').modal('close');
        findMe();
        Materialize.toast('Puedes hacer la ubicacin manualmente', 8000, "rounded");
    });
    $('#btnEnviarDatos').click(function (e) {
        var ubi = $('#ubicacion').val();
        var col = $('#colonia').val();
        var call = $('#calles').val();
        var num = $('#numcasa').val();
        var refe = $('#referencias').val();
        var total = parseFloat($('#total').text());
        var idcli=$('#idCliente').text();
        var datosUbicacion = {
            ubicacion: ubi,
            colonia: col,
            calles: call,
            numcasa: num,
            referencia: refe,
            pretotal: total,
            tabla: "UBICACION",
            cliente: idcli
        };
        if (ubi.length > 0 || (col.length > 0 && call.length > 0 && num.length > 0)) {
            grabaTodoTabla(datosUbicacion);
            ubicacionSigsa();
            $('#enviarMub').val("");
            $('#ubicacion').val("");
            $('#colonia').val("");
            $('#calles').val("");
            $('#numcasa').val("");
            $('#referencias').val("");
            $('#modalUB').modal('close');
        } else {
            Materialize.toast('Activa tu ubicación o ingresa tu dirección porfavor', 5000, "rounded");
        }
    });
    $('.modalEspera').click(function (e) {
        var pedidos = $('#pedidosR').text();
        if (pedidos == "0") {
            Materialize.toast('No tienes ningun pedido por confirmar', 5000, "rounded");
        } else {
            $('#estadoL').text("Tienes " + pedidos + " pedidos");
            $('#modalLista').modal('open');
            estado();
        }

    });
    $('#btnCancelarLista').click(function (e) {
        $('#modalLista').modal('close');
    });
  

    //verificar camvios del estado del pedido
    setInterval("estado()", 5000);

});
///////////--------Cargar---Lista--Estado----------------/////////
function estado() {
    var pedidos = $('#pedidosR').text();
    if (pedidos != "0") {
        cargarListaEspera();
        cantidadpedidos();

    }

};

function cargarListaEspera() {
    var idcli=$('#idCliente').text();
    var parametros = {
        'cliente': idcli //Camviar el ide del cliente cuando este lo de seciones
    };
    $.ajax({
        data: parametros,
        url: "./vistas/listaEspera.php",
        type: 'post',

        success: function (response) {

            $('#listaPendientes').html(response);
        }
    });
};

function cantidadpedidos() {
    var idcli=$('#idCliente').text();
    var parametros = {
        'cliente': idcli //Camviar el ide del cliente cuando este lo de seciones
    };
    $.ajax({
        data: parametros,
        url: "./vistas/numeroPedidos.php",
        type: 'post',

        success: function (response) {
            $('#pedidosR').text(response);
        }
    });

};

function calcularTotal() {
    var SUMA = $("#tablaP tbody > tr");
    var TOTAL = 0;
    SUMA.each(function () {
        var SUBTOTAL = $(this).find("td[class='subtotal']").text();
        if (SUBTOTAL !== '') {
            TOTAL = ((TOTAL) + (parseInt(SUBTOTAL)));
        }
    });
    document.getElementById('total').innerHTML = TOTAL;
};
//-----FUNCION GUARDAR DATOS DE LA TABLA DINAMICA-------
function grabaTodoTabla(datosUbicacion) {

    var DATA = [],
        TABLA = $("#tablaP tbody > tr");
    var cont = 0;
    TABLA.each(function () {

        var CLAVEP = $(this).find("td[class='clavep']").text(),
            ARROZ = $(this).find("td[class='arroz']").text(),
            PASTA = $(this).find("td[class='pasta']").text(),
            SALSA = $(this).find("td[class='salsa']").text(),
            PRECIOUNI = $(this).find("td[class='preciounitario']").text(),
            CANTIDAD = $(this).find("td[class='cantidad']").text(),
            SUBTOTAL = $(this).find("td[class='subtotal']").text();

        item = {};

        if (CLAVEP !== '') {
            cont = cont + 1;
            item["idp"] = CLAVEP;
            item["arroz"] = ARROZ;
            item["pasta"] = PASTA;
            item["salsa"] = SALSA;
            item["preuni"] = PRECIOUNI;
            item["cantidad"] = CANTIDAD;
            item["subtotal"] = SUBTOTAL;

            DATA.push(item);
        }
    });

    /*
 var dados = [datosUbicacion];
var dados1 = [datosPedido];
var datos2=dados.concat(dados1);
DATA = datos2.concat(DATA);
*/
    var total = [{
        ntotal: cont
    }];

    DATA = total.concat(DATA);
    var dados = [datosUbicacion];

    DATA = dados.concat(DATA);

    console.log(DATA);

    INFO = new FormData();
    aInfo = JSON.stringify(DATA);

    INFO.append('data', aInfo);

    $.ajax({
        data: INFO,
        type: 'POST',
        url: './vistas/guardarTabla.php',
        processData: false,
        contentType: false,
        success: function (r) {
            $("#respuesta").html(r);
            eliminarDatos(cont);
        }
    });
};

function eliminarDatos(cont) {
    cont = cont + 2;
    for (var i = 2; i < cont; i++) {

        document.getElementById('fila' + i).outerHTML = '';
    }
    $('#remover').addClass('ocultar');

};

function eliminar(pos) {
    var tabla = document.getElementById('tablaP');
    var cont = (tabla.rows.length) - 1;
    if (cont == 3) {
        $('#remover').addClass('ocultar');
    }
    var res = document.getElementById('tdN9' + pos);
    document.getElementById('fila' + pos).outerHTML = '';
    calcularTotal();
};

function editar(pos) {
    var img = document.getElementById('img' + pos);
    var id = document.getElementById('id' + pos);
    var nombre = document.getElementById('tdN2' + pos);
    var precio = document.getElementById('tdN3' + pos);
    var cantidad = document.getElementById('tdN4' + pos);
    var arroz = document.getElementById('tdN5' + pos);
    var pasta = document.getElementById('tdN6' + pos);
    var salsa = document.getElementById('tdN7' + pos);
    var btn = $('#btnAgregarLista');
    btn.attr('data-pos', pos);
    btn.attr('data-opera', 'editar');
    btn.attr('data-id', id.innerHTML);
    btn.attr('data-img', img.innerHTML);
    btn.attr('data-precio', precio.innerHTML);
    btn.attr('data-nombre', nombre.innerHTML);
    $('#valor').val(cantidad.innerHTML);
    $('#rango').val(cantidad.innerHTML);
    $('#arroz').val(arroz.innerHTML);
    $('#pasta').val(pasta.innerHTML);
    $('#salsa').val(salsa.innerHTML);
    $('#cantidad').html("$ " + precio.innerHTML + ".00 MX");
    $('#nombre').html("Nombre: " + nombre.innerHTML);
    // alert("res: " + id);
    $('#modalimg').html('<img src="./assets/img/' + img.innerHTML + '" alt="" style="max-width:100%">');
    $('#modalAG').modal('open');
}
//-----------Javascript Puro---------------
var btnMenu = document.getElementById('btn-menu');
var nav = document.getElementById('nav');
btnMenu.addEventListener('click', function () {

    nav.classList.toggle('mostrar');
});
var casa = document.getElementsByClassName('menu__link')[0];
var platillos = document.getElementsByClassName('menu__link')[1];
var conocenos = document.getElementsByClassName('menu__link')[2];
casa.addEventListener('click', function () {
    nav.classList.remove('mostrar');
});
platillos.addEventListener('click', function () {
    nav.classList.remove('mostrar');
});
conocenos.addEventListener('click', function () {
    nav.classList.remove('mostrar');
});

var tiempo = setTimeout(trasladar, 1000);


function trasladar() {
    var banner = document.getElementById('banner');
    banner.style.transition = 'all 1.2s';
    banner.style.transform = 'translateX(-50%) translateY(-50%)';
}

var menu = document.getElementById('menu');
var sigsa = document.getElementById('sigsa');
var altura = menu.offsetTop;
window.addEventListener('scroll', function () {
    if (window.pageYOffset > altura) {

        menu.classList.add('fixed');
        sigsa.classList.add('sigsa-fixed');
    } else {
        menu.classList.remove('fixed');
        sigsa.classList.remove('sigsa-fixed');
    }
});