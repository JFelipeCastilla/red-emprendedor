<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Incluir autoload de Composer
require '../../vendor/autoload.php';

// Verificar si la solicitud es POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capturar los datos enviados por el formulario
    $emailTo = isset($_POST['email']) ? $_POST['email'] : null;
    $subject = isset($_POST['subject']) ? $_POST['subject'] : null;
    $message = isset($_POST['message']) ? $_POST['message'] : null;

    // Verificar que todos los campos estén presentes
    if ($emailTo && $subject && $message) {
        $mail = new PHPMailer(true);

        try {
            // Configuración del servidor SMTP de Gmail
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'tu-correo@gmail.com'; // Tu dirección de correo
            $mail->Password   = 'tu-contraseña'; // Tu contraseña de Gmail o contraseña de aplicaciones
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Configuración del correo
            $mail->setFrom('tu-correo@gmail.com', 'Tu Nombre');
            $mail->addAddress($emailTo); // Añadir el destinatario

            // Contenido del correo
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $message;

            // Enviar el correo
            $mail->send();
            echo json_encode(['message' => 'Correo enviado correctamente']);
        } catch (Exception $e) {
            echo json_encode(['message' => "El correo no pudo ser enviado. Mailer Error: {$mail->ErrorInfo}"]);
        }
    } else {
        echo json_encode(['message' => 'Faltan datos en el formulario']);
    }
} else {
    echo json_encode(['message' => 'Método no permitido']);
}
?>