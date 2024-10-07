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
        $upload_path = __DIR__ . '/../uploads/' . basename($category_image); // Ajustado para que apunte a 'uploads'

        // Mover el archivo a la carpeta de uploads
        if (!move_uploaded_file($_FILES['category_image']['tmp_name'], $upload_path)) {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['message' => 'Error al subir la imagen']);
            exit;
        }
    } else {
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(['message' => 'Error en la subida de archivos: ' . $_FILES['category_image']['error']]);
        exit;
    }

    // Obtener datos del formulario
    $data = $_POST;

    // Verificar que los parámetros necesarios están presentes
    if (isset($data['category_name']) && isset($data['category_entrepreneur'])) {
        try {
            // Llama al método para crear la categoría
            Category::create_category($data['category_name'], $data['category_entrepreneur'], $category_image);
            echo json_encode(['message' => 'Categoría creada exitosamente']);
        } catch (Exception $e) {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['message' => 'Error al crear la categoría: ' . $e->getMessage()]);
            exit;
        }
    } else {
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(['message' => 'Faltan parámetros']);
        exit;
    }
} else {
    header('HTTP/1.1 405 Method Not Allowed');
}
?>
