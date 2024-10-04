<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(204);
    exit;
}

require('../../models/Category.class.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $category_image = null;

    if (isset($_FILES['category_image']) && $_FILES['category_image']['error'] == UPLOAD_ERR_OK) {
        $category_image = $_FILES['category_image']['name'];
        move_uploaded_file($_FILES['category_image']['tmp_name'], 'uploads/' . $category_image);
    }

    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    if ($data && isset($data['category_name']) && isset($data['category_entrepreneur'])) {
        Category::create_category($data['category_name'], $data['category_entrepreneur'], $category_image);
    } else {
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(['message' => 'Faltan parámetros']);
    }
} else {
    header('HTTP/1.1 405 Method Not Allowed');
}
?>
