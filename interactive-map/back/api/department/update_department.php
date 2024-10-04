<?php
    require('../../models/Department.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'PUT' && isset($_GET['id'], $_GET['name']) && isset($_GET['description']) && isset($_GET['entrepreneurs'])){
        Department::update_department($_GET['id'], $_GET['name'], $_GET['description'], $_GET['entrepreneurs']);
    }
?>