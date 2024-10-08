<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once('../../models/Entrepreneur.class.php');

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $entrepreneur_id = $_GET['entrepreneur_id'] ?? null;

    if ($entrepreneur_id) {
        Entrepreneur::delete_entrepreneur_by_id($entrepreneur_id);
    } else {
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(['message' => 'Missing entrepreneur_id parameter']);
    }
}
?>