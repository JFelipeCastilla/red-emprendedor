<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    http_response_code(204);
    exit;
}

require('../../models/Product.class.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_image = null;

    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == UPLOAD_ERR_OK) {
        $product_image = $_FILES['product_image']['name'];
        $upload_path = __DIR__ . '/../uploads/' . basename($product_image);

        if (!move_uploaded_file($_FILES['product_image']['tmp_name'], $upload_path)) {
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Error uploading the image']);
            exit;
        }
    } else {
        header('HTTP/1.1 400 Bad Request');
        header('Content-Type: application/json');
        echo json_encode(['message' => 'File upload error: ' . $_FILES['product_image']['error']]);
        exit;
    }

    $data = $_POST;

    if (isset($data['product_name'], $data['product_description'], $data['product_innovation'], $data['entrepreneur_fk'])) {
        try {
            $result = Product::create_product($data['product_name'], $product_image, $data['product_description'], $data['product_innovation'], $data['entrepreneur_fk']);
            header('Content-Type: application/json');
            http_response_code(201);
            echo json_encode($result);
        } catch (Exception $e) {
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Error creating the product: ' . $e->getMessage()]);
        }
    } else {
        header('HTTP/1.1 400 Bad Request');
        header('Content-Type: application/json');
        echo json_encode(['message' => 'Missing parameters']);
    }
} else {
    header('HTTP/1.1 405 Method Not Allowed');
    header('Content-Type: application/json');
    echo json_encode(['message' => 'Method not allowed']);
}
?>
