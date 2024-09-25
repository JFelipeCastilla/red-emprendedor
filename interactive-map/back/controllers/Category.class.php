<?php
require_once('../../includes/Database.class.php');

class Category {
    public static function create_category($name, $amount_users) {
        $database = new Database();
        $conn = $database->getConnection();

        $stmt = $conn->prepare('INSERT INTO category(name, amount_users) VALUES(:name, :amount_users)');
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':amount_users', $amount_users);

        if ($stmt->execute()) {  
            header('HTTP/1.1 201 Created'); 
            echo json_encode(['message' => 'Categoría creada correctamente']);
        } else {
            header('HTTP/1.1 500 Internal Server Error');  
            echo json_encode(['message' => 'No se pudo crear la categoría']);
        }
    }

    public static function delete_category_by_id($id) {
        $database = new Database();
        $conn = $database->getConnection();

        $stmt = $conn->prepare('DELETE FROM category WHERE id=:id');
        $stmt->bindParam(':id', $id);
        
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

    public static function update_category($id, $name, $amount_users) {
        $database = new Database();
        $conn = $database->getConnection();

        $stmt = $conn->prepare('UPDATE category SET name=:name, amount_users=:amount_users WHERE id=:id');
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':amount_users', $amount_users);

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