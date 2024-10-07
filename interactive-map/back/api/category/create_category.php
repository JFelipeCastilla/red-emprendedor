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

    // Manejar la subida de archivos
    if (isset($_FILES['category_image']) && $_FILES['category_image']['error'] == UPLOAD_ERR_OK) {
        $category_image = $_FILES['category_image']['name'];
        $upload_path = __DIR__ . '/../uploads/' . basename($category_image);

        // Mover el archivo a la carpeta de uploads
        if (!move_uploaded_file($_FILES['category_image']['tmp_name'], $upload_path)) {
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Error al subir la imagen']);
            exit;
        }
    } else {
        header('HTTP/1.1 400 Bad Request');
        header('Content-Type: application/json');
        echo json_encode(['message' => 'Error en la subida de archivos: ' . $_FILES['category_image']['error']]);
        exit;
    }

    // Obtener datos del formulario
    $data = $_POST;

    // Verificar que los parámetros necesarios están presentes
    if (isset($data['category_name']) && isset($data['category_entrepreneur'])) {
        try {
            $result = Category::create_category($data['category_name'], $data['category_entrepreneur'], $category_image);
            header('Content-Type: application/json');
            http_response_code(201); // Código 201 para creación exitosa
            echo json_encode($result);
        } catch (Exception $e) {
            header('HTTP/1.1 500 Internal Server Error');
            header('Content-Type: application/json');
            echo json_encode(['message' => 'Error al crear la categoría: ' . $e->getMessage()]);
        }
    } else {
        header('HTTP/1.1 400 Bad Request');
        header('Content-Type: application/json');
        echo json_encode(['message' => 'Faltan parámetros']);
    }
} else {
    header('HTTP/1.1 405 Method Not Allowed');
    header('Content-Type: application/json');
    echo json_encode(['message' => 'Método no permitido']);
}
?>