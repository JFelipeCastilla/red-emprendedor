<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once('../../models/Entrepreneur.class.php');

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if ($data && isset($data['entrepreneur_id']) && isset($data['entrepreneur_name']) && isset($data['entrepreneur_lastname']) && isset($data['entrepreneur_email'])) {
        Entrepreneur::update_entrepreneur($data['entrepreneur_id'], $data['entrepreneur_name'], $data['entrepreneur_lastname'], $data['entrepreneur_email']);
    } else {
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(['message' => 'Missing or invalid parameters']);
    }
}
?>