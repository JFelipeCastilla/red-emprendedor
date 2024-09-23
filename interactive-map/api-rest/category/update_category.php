<?php
    require('../../controllers/Category.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'PUT' && isset($_GET['id'], $_GET['name']) && isset($_GET['amount_users'])){
        Category::update_category($_GET['id'], $_GET['name'], $_GET['amount_users']);
    }
?>