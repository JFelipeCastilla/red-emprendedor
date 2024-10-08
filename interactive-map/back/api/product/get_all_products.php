<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Methods: GET, OPTIONS");
    header("Access-Control-Allow-Headers: Content-Type");

    require('../../models/Product.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        Product::get_all_products();
    }
?>