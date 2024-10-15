document.addEventListener("DOMContentLoaded", function() {
    const cookieNotification = document.getElementById('cookie-notification');
    const acceptButton = document.getElementById('accept-cookies');
    const rejectButton = document.getElementById('reject-cookies');

    // Verificar si ya se ha dado una respuesta
    if (!localStorage.getItem('cookiesAccepted')) {
        cookieNotification.style.display = 'block';
    }

    acceptButton.addEventListener('click', function() {
        localStorage.setItem('cookiesAccepted', 'true');
        cookieNotification.style.display = 'none';
    });

    rejectButton.addEventListener('click', function() {
        localStorage.setItem('cookiesAccepted', 'false');
        cookieNotification.style.display = 'none';
    });
});
