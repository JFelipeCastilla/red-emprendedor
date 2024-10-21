import entrepreneurshipService from '../services/entrepreneurshipService.js';

// Esta función necesita estar definida globalmente para que Google Maps la encuentre
window.initMap = async function() {
    try {
        // Obtener los emprendedores y guardarlos en una variable
        const emprendimientos = await entrepreneurshipService.getAllEntrepreneurs();

        console.log(emprendimientos); // Muestra los emprendedores en la consola para verificar que se obtuvieron correctamente

        let mapa = new google.maps.Map(document.getElementById("map"), {
            center: { lat: 4.611, lng: -74.083 },
            zoom: 12,
        });

        let geocoder = new google.maps.Geocoder();

        // Usar la variable `emprendimientos` que contiene los datos obtenidos de la API
        emprendimientos.forEach(emprendimiento => {
            geocodeAddress(emprendimiento.entrepreneurship_address, emprendimiento.entrepreneurship_name, geocoder, mapa);
        });

        document.getElementById("ubicacion-actual").addEventListener("click", function() {
            mostrarUbicacion(mapa);
        });
    } catch (error) {
        console.error("Error al cargar los emprendimientos: " + error);
    }
};

function geocodeAddress(direccion, nombre, geocoder, mapa) {
    console.log(`Geocodificando la dirección: ${direccion}`);
    geocoder.geocode({ address: direccion }, function(results, status) {
        if (status === 'OK') {
            console.log(`Resultado de geocodificación para ${direccion}:`, results);
            let marker = new google.maps.Marker({
                map: mapa,
                position: results[0].geometry.location,
                title: nombre,
            });

            let infoWindow = new google.maps.InfoWindow({
                content: `<h3>${nombre}</h3><p>${direccion}</p>`,
            });

            marker.addListener('click', function() {
                infoWindow.open(mapa, marker);
            });
        } else {
            console.error(`Error de geocodificación para ${direccion}: ${status}`);
        }
    });
}


function mostrarUbicacion(mapa) {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function(position) {
            let pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };

            let marker = new google.maps.Marker({
                position: pos,
                map: mapa,
                title: "Tu ubicación",
            });

            mapa.setCenter(pos);
        }, function() {
            handleLocationError(true);
        });
    } else {
        handleLocationError(false);
    }
}

function handleLocationError(browserHasGeolocation) {
    alert(browserHasGeolocation ? 
        'Error: El servicio de geolocalización ha fallado.' : 
        'Error: Tu navegador no soporta la geolocalización.');
}

// Cargar la API de Google Maps
const script = document.createElement('script');
script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyArfYseiQvrVzwJhow0p2dgNFb4R78fCfA&callback=initMap&libraries=places';
script.async = true;
script.defer = true;
document.head.appendChild(script);

