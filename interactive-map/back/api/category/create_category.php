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
        $upload_path = 'uploads/' . $category_image;

        // Mover el archivo a la carpeta de uploads
        if (move_uploaded_file($_FILES['category_image']['tmp_name'], $upload_path)) {
            // Solo pasa el nombre del archivo a la función create_category
            $category_image = $category_image; // Puedes cambiar esto si necesitas la ruta completa
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['message' => 'Error al subir la imagen']);
            exit;
        }
    }

    // Obtener datos JSON del cuerpo de la solicitud
    $input = file_get_contents('php://input');
    $data = json_decode($input, true);

    // Verificar que los parámetros necesarios están presentes
    if ($data && isset($data['category_name']) && isset($data['category_entrepreneur'])) {
        // Llama al método para crear la categoría
        Category::create_category($data['category_name'], $data['category_entrepreneur'], $category_image);
    } else {
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(['message' => 'Faltan parámetros']);
    }
} else {
    header('HTTP/1.1 405 Method Not Allowed');
}
?>