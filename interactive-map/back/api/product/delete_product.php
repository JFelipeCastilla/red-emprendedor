<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require('../../models/Product.class.php');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($_GET['product_id'])) {
        $result = Product::delete_product_by_id($_GET['product_id']);
        
        if ($result) {
            http_response_code(200); 
            echo json_encode(['message' => 'Producto eliminado con éxito']);
        } else {
            http_response_code(404); 
            echo json_encode(['error' => 'Producto no encontrado']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Falta el parámetro product_id']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
}
?>
