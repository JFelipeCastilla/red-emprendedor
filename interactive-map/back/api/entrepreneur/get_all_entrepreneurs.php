<?php
require_once('../../models/entrepreneur.class.php');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['entrepreneur_id'])) {
        $entrepreneur_id = intval($_GET['entrepreneur_id']);
        Entrepreneur::get_entrepreneur_by_id($entrepreneur_id);
    } else {
        Entrepreneur::get_all_entrepreneurs();
    }
}
?>