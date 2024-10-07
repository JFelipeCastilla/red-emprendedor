<?php
require_once('../../includes/Database.class.php');

class Category {
    public static function create_category($category_name, $category_entrepreneur, $category_image) {
        $database = new Database();
        $conn = $database->getConnection();
    
        $stmt = $conn->prepare('INSERT INTO category(category_name, category_entrepreneur, category_image) VALUES(:category_name, :category_entrepreneur, :category_image)');
        $stmt->bindParam(':category_name', $category_name);
        $stmt->bindParam(':category_entrepreneur', $category_entrepreneur);
        $stmt->bindParam(':category_image', $category_image);
    
        if ($stmt->execute()) {  
            return [
                'message' => 'Categoría creada correctamente',
                'category_name' => $category_name,
                'category_entrepreneur' => $category_entrepreneur,
                'category_image' => $category_image
            ];
        } else {
            throw new Exception('No se pudo crear la categoría');
        }
    }
    
    

    public static function delete_category_by_id($category_id) {
        $database = new Database();
        $conn = $database->getConnection();

        $stmt = $conn->prepare('DELETE FROM category WHERE category_id=:category_id');
        $stmt->bindParam(':category_id', $category_id);
        
        if ($stmt->execute()) {
            header('HTTP/1.1 204 No Content'); 
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['message' => 'No se pudo borrar la categoría']);
        }
    }

    public static function get_all_categories() {
        $database = new Database();
        $conn = $database->getConnection();
        $stmt = $conn->prepare('SELECT * FROM category');
        
        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            header('Content-Type: application/json');
            echo json_encode($result);
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['message' => 'Error al obtener las categorías']);
        }
    }

    public static function update_category($category_id, $category_name, $category_entrepreneur, $category_image) {
        $database = new Database();
        $conn = $database->getConnection();

        $stmt = $conn->prepare('UPDATE category SET category_name=:category_name, category_entrepreneur=:category_entrepreneur, category_image=:category_image WHERE category_id=:category_id');
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':category_name', $category_name);
        $stmt->bindParam(':category_entrepreneur', $category_entrepreneur);
        $stmt->bindParam(':category_image', $category_image);

        if ($stmt->execute()) {
            header('HTTP/1.1 200 OK'); 
            echo json_encode(['message' => 'Categoría actualizada correctamente']); 
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['message' => 'No se pudo actualizar la categoría']);
        }
    }
}
?>