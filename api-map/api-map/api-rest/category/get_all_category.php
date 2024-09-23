<?php
    require('../../controllers/Category.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'GET'){
        Category::get_all_categories();
    }

?>