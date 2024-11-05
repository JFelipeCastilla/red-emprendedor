document.addEventListener("DOMContentLoaded", function() {
    // Cargar lista de usuarios desde la API
    fetch("http://localhost/red-emprendedor/interactive-map/back/api/entrepreneur/get_all_entrepreneurs.php")
        .then(response => response.json())
        .then(users => {
            const userList = document.getElementById("userList");
            users.forEach(user => {
                const userItem = document.createElement("div");
                userItem.classList.add("user-item");
                userItem.textContent = `${user.entrepreneur_name} ${user.entrepreneur_lastname}`;
                userItem.dataset.email = user.entrepreneur_email;

                userItem.addEventListener("click", function() {
                    toggleEmail(this.dataset.email, userItem);
                });

                userList.appendChild(userItem);
            });
        })
        .catch(error => console.error("Error al cargar usuarios:", error));

    const toField = document.getElementById("to");
    const selectedEmailsContainer = document.getElementById("selectedEmailsContainer");
    let selectedEmails = [];

    // Función para alternar correos en el campo de destinatarios
    function toggleEmail(email, userItem) {
        if (selectedEmails.includes(email)) {
            // Eliminar el correo
            selectedEmails = selectedEmails.filter(e => e !== email);
            userItem.classList.remove("selected");
        } else {
            // Agregar el correo
            selectedEmails.push(email);
            userItem.classList.add("selected");
        }
        updateSelectedEmails();
    }

    // Actualiza el contenedor visual de correos seleccionados
    function updateSelectedEmails() {
        selectedEmailsContainer.innerHTML = "";
        selectedEmails.forEach(email => {
            const emailDiv = document.createElement("div");
            emailDiv.classList.add("selected-email");
            emailDiv.textContent = email;

            const removeButton = document.createElement("span");
            removeButton.classList.add("remove");
            removeButton.textContent = "✕";
            removeButton.onclick = () => removeEmail(email);

            emailDiv.appendChild(removeButton);
            selectedEmailsContainer.appendChild(emailDiv);
        });

        // Actualizar el campo de texto "to" con correos manuales
        toField.value = selectedEmails.join(", ");
    }

    // Elimina un correo de la lista
    function removeEmail(email) {
        selectedEmails = selectedEmails.filter(e => e !== email);
        document.querySelector(`.user-item[data-email="${email}"]`).classList.remove("selected");
        updateSelectedEmails();
    }

    // Permite agregar un correo manualmente
    toField.addEventListener("blur", function() {
        const manualEmail = toField.value.trim();
        if (manualEmail && !selectedEmails.includes(manualEmail)) {
            selectedEmails.push(manualEmail);
            updateSelectedEmails();
        }
        toField.value = "";
    });

    // Enviar el formulario
    document.getElementById("emailForm").addEventListener("submit", function(event) {
        event.preventDefault();
        
        const subject = document.getElementById("subject").value;
        const message = document.getElementById("message").value;

        fetch("http://localhost/red-emprendedor/interactive-map/back/api/entrepreneur/send_email.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ to: selectedEmails.join(", "), subject, message })
        })
        .then(response => response.text())
        .then(data => {
            alert(data);
        })
        .catch(error => console.error("Error:", error));
    });
});
