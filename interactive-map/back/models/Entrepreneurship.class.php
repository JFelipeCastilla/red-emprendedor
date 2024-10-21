<?php
require_once('../../includes/Database.class.php');

class Entrepreneurship {
    public static function create_entrepreneurship($entrepreneurship_name, $entrepreneurship_address, $locality, $social_media, $category_fk, $department_fk, $entrepreneur_fk) {
        $database = new Database();
        $conn = $database->getConnection();

        $stmt = $conn->prepare('INSERT INTO entrepreneurship (entrepreneurship_name, entrepreneurship_address, locality, social_media, category_fk, department_fk, entrepreneur_fk) 
        VALUES (:entrepreneurship_name, :entrepreneurship_address, :social_media, :category_fk, :department_fk)');

        $stmt->bindParam(':entrepreneurship_name', $entrepreneurship_name);
        $stmt->bindParam(':entrepreneurship_address', $entrepreneurship_address);
        $stmt->bindParam(':locality', $locality);
        $stmt->bindParam(':social_media', $social_media);
        $stmt->bindParam(':category_fk', $category_fk);
        $stmt->bindParam(':department_fk', $department_fk);
        $stmt->bindParam(':entrepreneur_fk', $entrepreneur_fk);

        if ($stmt->execute()) {
            header('HTTP/1.1 201 Created');
            echo json_encode(['message' => 'Emprendedor creado correctamente']);
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['message' => 'No se pudo crear el emprendedor']);
        }
    }

    public static function get_all_entrepreneurships() {
        $database = new Database();
        $conn = $database->getConnection();
        $stmt = $conn->prepare('SELECT * FROM entrepreneurship');
        
        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            header('Content-Type: application/json');
            echo json_encode($result);
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['message' => 'Error al obtener los emprendedores']);
        }
    }

    public static function get_entrepreneurship_by_id($entrepreneurship_id) {
        $database = new Database();
        $conn = $database->getConnection();

        $stmt = $conn->prepare('SELECT * FROM entrepreneurship WHERE entrepreneurship_id = :entrepreneurship_id');
        $stmt->bindParam(':entrepreneurship_id', $entrepreneurship_id);
    
        if ($stmt->execute()) {
            $entrepreneurship = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($entrepreneurship) {
                header('Content-Type: application/json');
                echo json_encode($entrepreneurship);
            } else {
                header('HTTP/1.1 404 Not Found');
                echo json_encode(['message' => 'Emprendedor no encontrado']);
            }
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['message' => 'Error al obtener el emprendedor']);
        }
    }
    
    public static function update_entrepreneurship($entrepreneurship_id, $entrepreneurship_name, $entrepreneurship_address, $locality, $social_media, $category_fk, $department_fk, $entrepreneur_fk) {
        $database = new Database();
        $conn = $database->getConnection();
    
        $stmt = $conn->prepare('UPDATE entrepreneurship 
        SET entrepreneurship_name=:entrepreneurship_name, 
            entrepreneurship_address=:entrepreneurship_address, 
            locality=:locality, 
            social_media=:social_media, 
            category_fk=:category_fk,
            department_fk=:department_fk,
            entrepreneur_fk=:entrepreneur_fk
        WHERE entrepreneurship_id=:entrepreneurship_id');
        
        $stmt->bindParam(':entrepreneurship_id', $entrepreneurship_id);
        $stmt->bindParam(':entrepreneurship_name', $entrepreneurship_name);
        $stmt->bindParam(':entrepreneurship_address', $entrepreneurship_address);
        $stmt->bindParam(':locality', $locality);
        $stmt->bindParam(':social_media', $social_media);
        $stmt->bindParam(':category_fk', $category_fk);
        $stmt->bindParam(':department_fk', $department_fk);
        $stmt->bindParam(':entrepreneur_fk', $entrepreneur_fk);
    
        if ($stmt->execute()) {
            header('HTTP/1.1 200 OK');
            echo json_encode(['message' => 'Emprendedor actualizado correctamente']);
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['message' => 'No se pudo actualizar el emprendedor']);
        }
    }

    public static function delete_entrepreneurship_by_id($entrepreneurship_id) {
        $database = new Database();
        $conn = $database->getConnection();

        $stmt = $conn->prepare('DELETE FROM entrepreneurship WHERE entrepreneurship_id=:entrepreneurship_id');
        $stmt->bindParam(':entrepreneurship_id', $entrepreneurship_id);
        
        if ($stmt->execute()) {
            header('HTTP/1.1 204 No Content'); 
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['message' => 'No se pudo borrar el emprendedor']);
        }
    }
}
?>
