<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");

    if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
        http_response_code(200);
        exit();
    }

    require('../../models/Township.class.php');

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {
        Township::get_all_townships();
    }
?>