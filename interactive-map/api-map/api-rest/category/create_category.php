<?php
require('../../controllers/Category.class.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if ($data && isset($data['name']) && isset($data['amount_users'])) {
        Category::create_category($data['name'], $data['amount_users']);
    } else {
        header('HTTP/1.1 400 Bad Request');
        echo 'Missing or invalid parameters';
    }
}
?>