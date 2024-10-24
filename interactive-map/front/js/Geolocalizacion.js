import entrepreneurshipService from '../services/entrepreneurshipService.js';


window.initMap = async function() {
    try {
        // Obtener los emprendedores y guardarlos en una variable
        const emprendimientos = await entrepreneurshipService.getAllEntrepreneurs();

        console.log(emprendimientos); 

        let mapa = new google.maps.Map(document.getElementById("map"), {
            center: { lat: 4.611, lng: -74.083 },
            zoom: 12,
        });

        let geocoder = new google.maps.Geocoder();

        // Usar la variable `emprendimientos` que contiene los datos obtenidos de la API
        emprendimientos.forEach(emprendimiento => {
            const direccion = emprendimiento.entrepreneurship_address;
            const localidad = emprendimiento.locality; 

            console.log(`Geocodificando la dirección: ${direccion}, ${localidad}`);
            geocodeAddress(direccion, localidad, emprendimiento.entrepreneurship_name, geocoder, mapa);
        });

        document.getElementById("ubicacion-actual").addEventListener("click", function() {
            mostrarUbicacion(mapa);
        });
    } catch (error) {
        console.error("Error al cargar los emprendimientos: " + error);
    }
};

function geocodeAddress(direccion, localidad, nombre, geocoder, mapa) {
    // Construir la dirección completa con la localidad
    const fullAddress = `${direccion}, ${localidad}, Colombia`;
    
    console.log(`Geocodificando la dirección completa: ${fullAddress}`);

    geocoder.geocode({ address: fullAddress }, function(results, status) {
        if (status === 'OK') {
            if (results && results.length > 0) {
                let marker = new google.maps.Marker({
                    map: mapa,
                    position: results[0].geometry.location,
                    title: nombre,
                });

                let infoWindow = new google.maps.InfoWindow({
                    content: `<h3>${nombre}</h3><p>${direccion}<br>${localidad}</p>`,
                });

                marker.addListener('click', function() {
                    infoWindow.open(mapa, marker);
                });
            } else {
                console.error(`No se encontraron resultados para ${fullAddress}`);
            }
        } else {
            console.error(`Error de geocodificación para ${fullAddress}: ${status}`);
        }
    });
}

function mostrarUbicacion(mapa) {
    // Verificar si el navegador soporta la geolocalización
    if (navigator.geolocation) {
        // Solicitar la ubicación del usuario
        navigator.geolocation.getCurrentPosition(
            function(position) {
                let pos = {
                    lat: position.coords.latitude,
                    lng: position.coords.longitude
                };

                // Crear un marcador en la ubicación del usuario
                let marker = new google.maps.Marker({
                    position: pos,
                    map: mapa,
                    title: "Tu ubicación",
                });

                // Centrar el mapa en la ubicación del usuario
                mapa.setCenter(pos);
            },
            function(error) {
                handleLocationError(true, error);
            }
        );
    } else {
        handleLocationError(false);
    }
}

function handleLocationError(browserHasGeolocation, error) {
    let errorMessage;
    switch(error.code) {
        case error.PERMISSION_DENIED:
            errorMessage = "Error: Usuario denegó la solicitud de Geolocalización.";
            break;
        case error.POSITION_UNAVAILABLE:
            errorMessage = "Error: La información de ubicación no está disponible.";
            break;
        case error.TIMEOUT:
            errorMessage = "Error: La solicitud para obtener la ubicación ha caducado.";
            break;
        case error.UNKNOWN_ERROR:
            errorMessage = "Error: Ha ocurrido un error desconocido.";
            break;
    }

    // Alertar al usuario sobre el error
    alert(browserHasGeolocation ? errorMessage : 
        'Error: Tu navegador no soporta la geolocalización.');
}
// Cargar la API de Google Maps
const script = document.createElement('script');
script.src = 'https://maps.googleapis.com/maps/api/js?key=AIzaSyArfYseiQvrVzwJhow0p2dgNFb4R78fCfA&callback=initMap&libraries=places';
script.async = true;
script.defer = true;
document.head.appendChild(script);

