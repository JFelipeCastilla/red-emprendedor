document.addEventListener('DOMContentLoaded', function () {
    const cookieNotification = document.querySelector('#cookie-notification');
    const acceptCookiesBtn = document.querySelector('#accept-cookies');
    const cookiesAccepted = localStorage.getItem('cookiesAccepted');
    const lastAcceptedDate = localStorage.getItem('lastAcceptedDate');
    const currentDate = new Date();

    if (cookiesAccepted === 'true') {
        cookieNotification.style.display = 'none';
        enableNotifications();
    } else {
        if (!lastAcceptedDate || (currentDate - new Date(lastAcceptedDate)) > 20 * 1000) {
            setTimeout(() => {
                cookieNotification.classList.add('visible');
            }, 200);
        } else {
            cookieNotification.style.display = 'none';
        }
    }

    acceptCookiesBtn.addEventListener('click', () => {
        localStorage.setItem('cookiesAccepted', 'true');
        localStorage.setItem('lastAcceptedDate', currentDate.toISOString());
        cookieNotification.classList.remove('visible');
        setTimeout(() => {
            cookieNotification.style.display = 'none';
        }, 300);
        enableNotifications();
    });

    function enableNotifications() {
        Notification.requestPermission().then(result => {
            if (result === 'granted') {
                const notification = new Notification('¡Bienvenido!', {
                    icon: '../img/logo-de-Sena-sin-fondo-Blanco-300x300.png',
                    body: 'Gracias por aceptar las cookies. ¡Ahora recibirás notificaciones!'
                });
                notification.onclick = function () {
                    window.open('http://localhost/red-emprendedor/interactive-map/front/views/#');
                };
            } else {
                console.log("Permiso de notificaciones denegado");
            }
        });
    }
});