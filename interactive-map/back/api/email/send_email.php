<?php
require_once '../../includes/mail_config.php';

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

$data = json_decode(file_get_contents("php://input"), true);

$subject = $data['subject'];
$body = $data['body'];
$recipients = [];

foreach ($data['recipients'] as $email) {
    $recipients[] = ['email' => $email, 'name' => 'Emprendedor'];
}

$response = sendMail($subject, $body, $recipients);

// Asegúrate de devolver una respuesta JSON
echo json_encode(['message' => $response]);
?>
