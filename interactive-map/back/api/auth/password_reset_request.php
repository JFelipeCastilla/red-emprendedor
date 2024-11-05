<?php
require_once('../../models/entrepreneur.class.php');
use PHPMailer\PHPMailer\PHPMailer;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';

$data = json_decode(file_get_contents("php://input"), true);
$idNumber = $data['idNumber'];

if ($idNumber) {
    $database = new Database();
    $conn = $database->getConnection();
    $stmt = $conn->prepare('SELECT entrepreneur_email FROM entrepreneur WHERE entrepreneur_id = :id');
    $stmt->bindParam(':id', $idNumber, PDO::PARAM_INT);

    if ($stmt->execute() && $stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $email = $user['entrepreneur_email'];

        // Configuración del correo electrónico
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'respaldopruebas99@gmail.com';
            $mail->Password = 'srsniknjjnqmspsd';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            $mail->setFrom('respaldopruebas99@gmail.com', 'Red de Emprendedores');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Restablecimiento de contraseña';
            $mail->Body = '
                <h3>Solicitud de Restablecimiento de Contraseña</h3>
                <p>Se ha solicitado un restablecimiento de contraseña para tu cuenta. Si no solicitaste esto, ignora este mensaje.</p>
                <a href="http://localhost/red-emprendedor/interactive-map/front/views/reset_password.html" 
                   style="display: inline-block; padding: 10px 20px; color: #fff; background-color: #00796b; text-decoration: none; border-radius: 5px; text-align: center;">
                   Restablecer Contraseña
                </a>
            ';

            $mail->send();
            echo json_encode(['message' => 'Correo de recuperación enviado. Revisa tu bandeja de entrada.']);
        } catch (Exception $e) {
            echo json_encode(['message' => 'No se pudo enviar el correo.']);
        }
    } else {
        echo json_encode(['message' => 'Número de identificación no encontrado.']);
    }
} else {
    echo json_encode(['message' => 'Número de identificación no proporcionado.']);
}
?>
