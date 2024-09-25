<?php
    require('../../controllers/Department.class.php');

    if($_SERVER['REQUEST_METHOD'] == 'DELETE' && isset($_GET['id'])){
        Department::delete_department_by_id($_GET['id']);   
    }

?>