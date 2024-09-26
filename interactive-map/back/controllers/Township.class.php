<?php
require_once('../../includes/Database.class.php');

class Township {
    public static function create_township($township_name, $township_entrepreneur, $department_id) {
        $database = new Database();
        $conn = $database->getConnection();

        $stmt = $conn->prepare('INSERT INTO township (township_name, township_entrepreneur, department_id) VALUES(:township_name, :township_entrepreneur, :department_id)');
        $stmt->bindParam(':township_name', $township_name);
        $stmt->bindParam(':township_entrepreneur', $township_entrepreneur);
        $stmt->bindParam(':department_id', $department_id);

        if ($stmt->execute()) {  
            header('HTTP/1.1 201 Created'); 
            echo json_encode(['message' => 'Municipio creado correctamente']);
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['message' => 'No se pudo crear el municipio']);
        }
    }

    public static function get_all_townships() {
        $database = new Database();
        $conn = $database->getConnection();
        
        $stmt = $conn->prepare('
            SELECT t.township_id, t.township_name, t.township_entrepreneur, t.department_id, d.department_name 
            FROM township t
            JOIN department d ON t.department_id = d.department_id
        ');
        
        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            header('Content-Type: application/json');
            echo json_encode($result);
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['message' => 'Error al obtener los municipios']);
        }
    }

    public static function get_townships_by_department($department_id) {
        $database = new Database();
        $conn = $database->getConnection();
        
        $stmt = $conn->prepare('
            SELECT t.township_id, t.township_name, t.township_entrepreneur, t.department_id, d.department_name 
            FROM township t
            JOIN department d ON t.department_id = d.department_id
            WHERE t.department_id = :department_id
        ');
    
        $stmt->bindParam(':department_id', $department_id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            header('Content-Type: application/json');
            echo json_encode($result);
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['message' => 'Error al obtener los municipios']);
        }
    }    

    public static function update_township($township_id, $township_name, $township_entrepreneur, $department_id) {
        $database = new Database();
        $conn = $database->getConnection();

        $stmt = $conn->prepare('UPDATE township SET township_name=:township_name, township_entrepreneur=:township_entrepreneur, department_id=:department_id WHERE township_id=:township_id');
        $stmt->bindParam(':township_id', $township_id);
        $stmt->bindParam(':township_name', $township_name);
        $stmt->bindParam(':township_entrepreneur', $township_entrepreneur);
        $stmt->bindParam(':department_id', $department_id);

        if ($stmt->execute()) {
            header('HTTP/1.1 200 OK');
            echo json_encode(['message' => 'Municipio actualizado correctamente']);
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['message' => 'No se pudo actualizar el municipio']);
        }
    }

    public static function delete_township_by_id($township_id) {
        $database = new Database();
        $conn = $database->getConnection();

        $stmt = $conn->prepare('DELETE FROM township WHERE township_id=:township_id');
        $stmt->bindParam(':township_id', $township_id);
        
        if ($stmt->execute()) {
            header('HTTP/1.1 204 No Content'); 
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['message' => 'No se pudo borrar el municipio']);
        }
    }
}
?>