$(document).ready(function () {
	$("#contenedor").load('vistas/principal.php');
	//-----Remplazar el contenido de la etiqueta div con #contenedor------------//
	$("#principal").click(function (event) {
		$("#contenedor").load('vistas/principal.php');
	});

});

    