var boton = document.getElementById('boton');
boton.addEventListener('click', function(){
    findMe();
});


var arregloPines=[];
function findMe() {
	var divConte = document.getElementById('map');
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
        $('#enviarMub').val(latLng);
        var sigsa = {
			lat: 17.597344,
			lng: -99.176565
		};
        var directionsService = new google.maps.DirectionsService;
        var directionsDisplay = new google.maps.DirectionsRenderer({
            suppressMarkers: true
        });
        var map = new google.maps.Map(document.getElementById('map'), {
          zoom: 19,
          gestureHandling: 'cooperative',
          center: {lat: 17.597344,lng: -99.176565}
        });
        directionsDisplay.setMap(map);
        sigsaInfo(map, sigsa);
        clienteInfo(map, latLng);
        calculateAndDisplayRoute(sigsa,latLng,directionsService, directionsDisplay);
         map.addListener('click', function(e) {
   var nuevaUbi=e.latLng;
      for(var i in arregloPines){
  arregloPines[i].setMap(null);
    }
    // map.setDirections(null);
     sigsaInfo(map, sigsa);
     clienteInfo(map, nuevaUbi);
     $('#enviarMub').val(nuevaUbi);
 calculateAndDisplayRoute(sigsa,nuevaUbi,directionsService, directionsDisplay);
});
};

      function calculateAndDisplayRoute(sigsa,latLng,directionsService, directionsDisplay) {
        directionsService.route({
          origin: latLng,
          destination: sigsa,
          travelMode: 'DRIVING'
        }, function(response, status) {
          if (status === 'OK') {
            directionsDisplay.setDirections(response);
          } else {
            window.alert('Directions request failed due to ' + status);
          }
        });
      }
    
	function error() {
		alert("No se pudo obtener tu ubicación");
	}
}

function ubicacionSigsa() {
	var sigsa = {
		lat: 17.597344,
		lng: -99.176565
	};
	var map = new google.maps.Map(document.getElementById('map'), {
		center: sigsa,
		zoom: 19,
		gestureHandling: 'cooperative'
	});
    sigsaInfo(map, sigsa);
}


function sigsaInfo(map, sigsa) {
	var contentString = '<div id="contenedor-infoMarker">' +
		'<div id="cont-img"><img src="imgpg/comidaoriental.jpg" alt="" id="infoMarker">' +
		'</div>' +
		'<div id="info">' +
		'<h1>Comida Oriental Sigsa</h1>' +
		'<p>Somos un Restaurante de Comida Oriental, contamos con buffet libre por sólo $80.00 MX, ven y conócenos en: Av. Revolución #825, Barrio del Dulce Nombre, frente a Elektra segunda planta, Chilapa de Álvarez, Gro. Horarios: 10:00am a 6:00pm.</p>' +
		'<p>Visítanos en nuestro Facebook:<a href="https://www.facebook.com/ComedorOriental/">' +
		'@ComedorOriental</a></p>' +
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
		'<div id="cont-imgcli"><img src="imgpg/clienteubicacion.png" alt="" id="cliente">' +
		'</div>' +
		'</div>';
	var infowindow = new google.maps.InfoWindow({
		content: contentStringCli
	});
	var marker = new google.maps.Marker({
		map: map,
		position: latLng,
		title: 'YO'
	});
 arregloPines.push(marker);
	marker.addListener('click', function () {
		infowindow.open(map, marker);
	});
};