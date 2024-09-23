<?php
    require('../../controllers/Category.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'DELETE' && isset($_GET['id'])){
        Category::delete_category_by_id($_GET['id']);   
    }

?>