<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        http_response_code(200);
        exit();
    }

    require('../../controllers/Department.class.php');

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        Department::get_all_departments();
    }
?>