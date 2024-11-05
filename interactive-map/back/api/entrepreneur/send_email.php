<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

header("Content-Type: application/json");

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['to']) && isset($data['subject']) && isset($data['message'])) {
    $to = $data['to'];
    $subject = $data['subject'];
    $message = $data['message'];

    $mail = new PHPMailer(true);

    try {
        // Configuración del servidor
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'respaldopruebas99@gmail.com';
        $mail->Password   = 'srsniknjjnqmspsd';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Remitente
        $mail->setFrom('respaldopruebas99@gmail.com', 'Red de Emprendedores');
        
        // Destinatarios
        $emails = explode(", ", $to);
        foreach ($emails as $email) {
            $mail->addAddress($email);
        }

        // Contenido del correo
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        echo json_encode(["status" => "Exito"]);
    } catch (Exception $e) {
        echo json_encode(["status" => "Error", "message" => $mail->ErrorInfo]);
    }
} else {
    echo json_encode(["status" => "Error", "message" => "Faltan datos necesarios"]);
}



