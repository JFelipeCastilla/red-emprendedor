<?php 
// Incluye el autoload de Composer
require 'C:/xampp/htdocs/red-emprendedor/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendMail($subject, $body, $recipients) {
    $mail = new PHPMailer(true);

        // Activa la depuración detallada de PHPMailer
        $mail->SMTPDebug = 2;  // Cambia este valor a 3 para una depuración aún más detallada
        $mail->Debugoutput = 'html';  // Muestra el resultado de la depuración en formato HTML
    
    
    try {
        // Configuración del servidor SMTP de Outlook
        $mail->isSMTP();
        $mail->Host       = 'smtp.office365.com';   // Servidor SMTP de Outlook
        $mail->SMTPAuth   = true;
        $mail->Username   = 'pruebasredemp@outlook.com';  // Tu correo de Outlook
        $mail->Password   = 'redemppruebas!12345';        // Tu contraseña de Outlook
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        
        // Configuración del remitente
        $mail->setFrom('pruebasredemp@outlook.com', 'Red de Emprendedores');

        // Añadir destinatarios
        foreach ($recipients as $recipient) {
            $mail->addAddress($recipient['email'], $recipient['name']);
        }

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        // Enviar correo
        $mail->send();
        return 'Correo enviado correctamente';
    } catch (Exception $e) {
        return "No se pudo enviar el correo. Error: {$mail->ErrorInfo}";
    }
}
?>