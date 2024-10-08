<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type");

require('../../models/Category.class.php');

if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    if (isset($_GET['category_id'])) {
        $result = Category::delete_category_by_id($_GET['category_id']);
        
        if ($result) {
            http_response_code(200); 
            echo json_encode(['message' => 'Categoría eliminada con éxito']);
        } else {
            http_response_code(404); 
            echo json_encode(['error' => 'Categoría no encontrada']);
        }
    } else {
        http_response_code(400);
        echo json_encode(['error' => 'Falta el parámetro category_id']);
    }
} else {
    http_response_code(405);
    echo json_encode(['error' => 'Método no permitido']);
}
?>