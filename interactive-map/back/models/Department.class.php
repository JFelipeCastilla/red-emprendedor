<?php
require_once('../../includes/Database.class.php');

class Department {
    public static function create_department($department_name, $description, $department_entrepreneur) {
        $database = new Database();
        $conn = $database->getConnection();

        $stmt = $conn->prepare('INSERT INTO department (department_name, description, department_entrepreneur) VALUES(:department_name, :description, :department_entrepreneur)');
        $stmt->bindParam(':department_name', $department_name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':department_entrepreneur', $department_entrepreneur);

        if ($stmt->execute()) {  
            header('HTTP/1.1 201 Created');
            echo json_encode(['message' => 'Departamento creado correctamente']);
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['message' => 'No se pudo crear el departamento']);
        }
    }

    public static function get_all_departments() {
        $database = new Database();
        $conn = $database->getConnection();
        $stmt = $conn->prepare('SELECT * FROM department');
        
        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            header('Content-Type: application/json');
            echo json_encode($result);
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['message' => 'Error al obtener los departamentos']);
        }
    }

    public static function update_department($department_id, $department_name, $description, $department_entrepreneur) {
        $database = new Database();
        $conn = $database->getConnection();

        $stmt = $conn->prepare('UPDATE department SET department_name=:department_name, description=:description, department_entrepreneur=:department_entrepreneur WHERE department_id=:department_id');
        $stmt->bindParam(':department_id', $department_id);
        $stmt->bindParam(':department_name', $department_name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':department_entrepreneur', $department_entrepreneur);

        if ($stmt->execute()) {
            header('HTTP/1.1 200 OK');
            echo json_encode(['message' => 'Departamento actualizado correctamente']);
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['message' => 'No se pudo actualizar el departamento']);
        }
    }

    public static function delete_department_by_id($department_id) {
        $database = new Database();
        $conn = $database->getConnection();

        $stmt = $conn->prepare('DELETE FROM department WHERE department_id=:department_id');
        $stmt->bindParam(':department_id', $department_id);
        
        if ($stmt->execute()) {
            header('HTTP/1.1 204 No Content'); 
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['message' => 'No se pudo borrar el departamento']);
        }
    }
}
?>