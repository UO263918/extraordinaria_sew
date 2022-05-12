var miMapa = new Object();

function initMap(){  
    var centro = {lat: 43.3672702, lng: -5.8502461};
    var mapaGeoposicionado = new google.maps.Map(document.getElementById('mapa'),{
        zoom: 8,
        center:centro,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });		
	var posGijon = {lat: 43.5405370, lng: -5.6622220};
    var marcadorGijon = new google.maps.Marker({position:posGijon,map:mapaGeoposicionado});		
	var posOviedo = { lat: 43.3672702,lng: -5.8502461};
	var marcadorOviedo = new google.maps.Marker({position:posOviedo,map:mapaGeoposicionado});
	var posAviles = {lat: 43.5560820,lng: -5.9246390};	
	var marcadorAviles = new google.maps.Marker({position:posAviles,map:mapaGeoposicionado});
	
	infoWindow = new google.maps.InfoWindow;
	
    if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(posicion) {
            var pos = {
              lat: posicion.coords.latitude,
              lng: posicion.coords.longitude
            };
			
            infoWindow.setPosition(pos);
            infoWindow.setContent('Usted se encuentra aquí');
            infoWindow.open(mapaGeoposicionado);
			
            mapaGeoposicionado.setCenter(pos);
			
          }, function() {
            handleLocationError(true, infoWindow, mapaGeoposicionado.getCenter());
          });
        } else {
          handleLocationError(false, infoWindow, mapaGeoposicionado.getCenter());
        }
      }

function handleLocationError(browserHasGeolocation, infoWindow, pos) {
    infoWindow.setPosition(pos);
    infoWindow.setContent(browserHasGeolocation ?
                          'Error: Ha fallado la geolocalizacion' :
                          'Error: Su navegador no soporta geolocalizacion');
    infoWindow.open(mapaGeoposicionado);
}

miMapa.initMap = initMap;