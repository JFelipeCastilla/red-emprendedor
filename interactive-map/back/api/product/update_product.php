<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: PUT, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require('../../models/Product.class.php');

if ($_SERVER['REQUEST_METHOD'] == 'PUT') {

    $data = json_decode(file_get_contents("php://input"), true);

    if (isset($data['product_id'], $data['product_name'], $data['product_image'], $data['product_description'], $data['product_innovation'], $data['entrepreneurship_fk'])) {
        Product::update_product($data['product_id'], $data['product_name'], $data['product_image'], $data['product_description'], $data['product_innovation'], $data['entrepreneurship_fk']);
        http_response_code(200);
        echo json_encode(['message' => 'Producto actualizado correctamente']);
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Faltan parámetros']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
}
?>
