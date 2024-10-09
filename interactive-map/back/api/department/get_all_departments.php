<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

require('../../models/Department.class.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['department_id'])) {
        $department_id = intval($_GET['department_id']);
        Department::get_department_by_id($department_id);
    } elseif (isset($_GET['get_all_data'])) {
        Department::get_entrepreneurs_with_departments_and_products();
    } else {
        Department::get_all_departments();
    }
}
?>