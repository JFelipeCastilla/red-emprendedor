<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

require('../../models/Department.class.php');

if ($_SERVER['REQUEST_METHOD'] == 'DELETE' && isset($_GET['department_id'])) {
    $department_id = $_GET['department_id'];
    
    if (Department::delete_department_by_id($department_id)) {
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