<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

require('../../models/Township.class.php');

if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && isset($_GET['township_id'])) {
    $township_id = $_GET['township_id'];
    
    if (Township::delete_township_by_id($township_id)) {
        http_response_code(200);
        echo json_encode(['status' => 'success', 'message' => 'Department deleted successfully']);
    } else {
        http_response_code(404);
        echo json_encode(['status' => 'error', 'message' => 'Department not found']);
    }
} else {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Invalid request']);
}
?>