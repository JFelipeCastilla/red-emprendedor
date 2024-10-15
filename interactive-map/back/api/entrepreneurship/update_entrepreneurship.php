<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once('../../models/Entrepreneurship.class.php');

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if ($data && isset($data['entrepreneurship_id']) && isset($data['entrepreneur_name']) && isset($data['entrepreneurship_address']) && isset($data['social_media']) && isset($data['category_fk']) && isset($data['department_id']) && isset($data['entrepreneur_fk'])) {
        Entrepreneurship::update_entrepreneurship($data['entrepreneurship_id'], $data['entrepreneurship_name'], $data['entrepreneurship_address'], $data['social_media'], $data['category_fk'], $data['department_id'], $data['entrepreneur_fk']);
    } else {
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(['message' => 'Missing or invalid parameters']);
    }
}
?>