<?php
    require('../../models/Category.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'DELETE' && isset($_GET['category_id'])){
        Category::delete_category_by_id($_GET['category_id']);   
    }

?>