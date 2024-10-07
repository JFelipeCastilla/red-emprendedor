<?php
    require('../../models/Category.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'PUT' && isset($_GET['category_id'], $_GET['category_name']) && isset($_GET['category_entrepreneur'] && isset($_GET['category_image']))){
        Category::update_category($_GET['category_id'], $_GET['category_name'], $_GET['category_entrepreneur'], $_GET['category_image']);
    }
?>