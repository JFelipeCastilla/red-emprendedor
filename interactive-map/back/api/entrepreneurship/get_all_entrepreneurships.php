<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(200);
    exit();
}

require_once('../../models/entrepreneurship.class.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['entrepreneurship_id'])) {
        $entrepreneurship_id = intval($_GET['entrepreneurship_id']);
        Entrepreneurship::get_entrepreneurship_by_id($entrepreneurship_id);
    } else {
        Entrepreneurship::get_all_entrepreneurships();
    }
}
?>