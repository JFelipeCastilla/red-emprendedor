<?php
require_once('../../includes/Database.class.php');

class Entrepreneur {
    public static function create_entrepreneur($entrepreneur_name, $social_media, $category_fk, $department_fk, $entrepreneur_fk) {
        $database = new Database();
        $conn = $database->getConnection();

        $stmt = $conn->prepare('INSERT INTO entrepreneur (entrepreneur_name, entrepreneur_lastname, entrepreneur_email) 
        VALUES (:entrepreneur_name, :entrepreneur_lastname, :entrepreneur_email)');

        $stmt->bindParam(':entrepreneur_name', $entrepreneur_name);
        $stmt->bindParam(':entrepreneur_lastname', $entrepreneur_lastname);
        $stmt->bindParam(':entrepreneur_email', $entrepreneur_email);

        if ($stmt->execute()) {
            header('HTTP/1.1 201 Created');
            echo json_encode(['message' => 'Emprendedor creado correctamente']);
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['message' => 'No se pudo crear el emprendedor']);
        }
    }

    public static function get_all_entrepreneurs() {
        $database = new Database();
        $conn = $database->getConnection();
        $stmt = $conn->prepare('SELECT * FROM entrepreneur');
        
        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            header('Content-Type: application/json');
            echo json_encode($result);
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['message' => 'Error al obtener los emprendedores']);
        }
    }

    public static function get_entrepreneur_by_id($entrepreneur_id) {
        $database = new Database();
        $conn = $database->getConnection();

        $stmt = $conn->prepare('SELECT * FROM entrepreneur WHERE entrepreneur_id = :entrepreneur_id');
        $stmt->bindParam(':entrepreneur_id', $entrepreneur_id);
    
        if ($stmt->execute()) {
            $entrepreneur = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($entrepreneur) {
                header('Content-Type: application/json');
                echo json_encode($entrepreneur);
            } else {
                header('HTTP/1.1 404 Not Found');
                echo json_encode(['message' => 'Emprendedor no encontrado']);
            }
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['message' => 'Error al obtener el emprendedor']);
        }
    }
    
    public static function update_entrepreneur($entrepreneur_id, $entrepreneur_name, $entrepreneur_lastname, $entrepreneur_email) {
        $database = new Database();
        $conn = $database->getConnection();

        $stmt = $conn->prepare('UPDATE entrepreneur 
        SET entrepreneur_name=:entrepreneur_name, entrepreneur_lastname=:entrepreneur_lastname, entrepreneur_email=:entrepreneur_email 
        WHERE entrepreneur_id=:entrepreneur_id');
        
        $stmt->bindParam(':entrepreneur_id', $entrepreneur_id);
        $stmt->bindParam(':entrepreneur_name', $entrepreneur_name);
        $stmt->bindParam(':entrepreneur_lastname', $entrepreneur_lastname);
        $stmt->bindParam(':entrepreneur_email', $entrepreneur_email);

        if ($stmt->execute()) {
            header('HTTP/1.1 200 OK');
            echo json_encode(['message' => 'Emprendedor actualizado correctamente']);
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['message' => 'No se pudo actualizar el emprendedor']);
        }
    }

    public static function delete_entrepreneur_by_id($entrepreneur_id) {
        $database = new Database();
        $conn = $database->getConnection();

        $stmt = $conn->prepare('DELETE FROM entrepreneur WHERE entrepreneur_id=:entrepreneur_id');
        $stmt->bindParam(':entrepreneur_id', $entrepreneur_id);
        
        if ($stmt->execute()) {
            header('HTTP/1.1 204 No Content'); 
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['message' => 'No se pudo borrar el emprendedor']);
        }
    }
}
?>
