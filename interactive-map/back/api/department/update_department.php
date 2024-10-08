<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS, PUT");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

require('../../models/Department.class.php');

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);
    
    $department_id = $_GET['department_id'];

    if ($data && isset($data['department_name']) && isset($data['description']) && isset($data['amount_entrepreneur'])) {
        Department::update_department($department_id, $data['department_name'], $data['description'], $data['amount_entrepreneur']);
    } else {
        header('HTTP/1.1 400 Bad Request');
        echo 'Missing or invalid parameters';
    }
}
?>