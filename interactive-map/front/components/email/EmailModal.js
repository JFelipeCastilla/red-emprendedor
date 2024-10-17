document.getElementById("openEmailModal").onclick = function() {
    document.getElementById("emailModal").style.display = "block";
  };
  
  // Cerrar el modal
  document.querySelector(".close").onclick = function() {
    document.getElementById("emailModal").style.display = "none";
  };
  
  // Cargar lista de emprendedores
  fetch('http://localhost/red-emprendedor/interactive-map/back/api/entrepreneur/get_all_entrepreneurs.php')
    .then(response => response.json())
    .then(data => {
      const entrepreneurList = document.getElementById('entrepreneurList');
      entrepreneurList.innerHTML = data.map(entrepreneur => `
        <label>
          <input type="checkbox" name="emails" value="${entrepreneur.entrepreneur_email}">
          ${entrepreneur.entrepreneur_name} ${entrepreneur.entrepreneur_lastname} (${entrepreneur.entrepreneur_email})
        </label><br>
      `).join('');
    });
  
  // Manejar el envío del formulario
 document.getElementById("emailForm").onsubmit = function(event) {
  event.preventDefault();

  const selectedEmails = Array.from(document.querySelectorAll('input[name="emails"]:checked'))
    .map(checkbox => checkbox.value);
  const subject = document.getElementById('subject').value;
  const body = document.getElementById('body').value;

  fetch('http://localhost/red-emprendedor/interactive-map/back/api/email/send_email.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify({
      subject: subject,
      body: body,
      recipients: selectedEmails
    }),
  })
  .then(response => response.json())  // Asegúrate de obtener la respuesta como JSON
  .then(result => {
    alert(result.message);  // Muestra el mensaje de respuesta
  })
  .catch(error => {
    console.error('Error:', error);
    alert('Error al enviar el correo');
  });
};
  