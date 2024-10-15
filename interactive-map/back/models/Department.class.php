<?php
require_once('../../includes/Database.class.php');

class Department {
    public static function create_department($department_name, $description, $amount_entrepreneurship) {
        $database = new Database();
        $conn = $database->getConnection();

        $stmt = $conn->prepare('INSERT INTO department (department_name, description, amount_entrepreneurship) VALUES(:department_name, :description, :amount_entrepreneurship)');
        $stmt->bindParam(':department_name', $department_name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':amount_entrepreneurship', $amount_entrepreneurship);

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

    public static function get_department_by_id($department_id) {
        $database = new Database();
        $conn = $database->getConnection();
    
        $stmt = $conn->prepare('SELECT * FROM department WHERE department_id = :department_id');
        $stmt->bindParam(':department_id', $department_id);
        
        if ($stmt->execute()) {
            $department = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($department) {
                header('Content-Type: application/json');
                echo json_encode($department);
            } else {
                header('HTTP/1.1 404 Not Found');
                echo json_encode(['message' => 'Departamento no encontrado']);
            }
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['message' => 'Error al obtener el departamento']);
        }
    }

    public static function get_entrepreneurs_with_departments_and_products() {
        $database = new Database();
        $conn = $database->getConnection();
        $stmt = $conn->prepare('
            SELECT d.department_name, e.entrepreneurship_name, p.product_name, p.product_image, p.product_description, p.product_innovation  
            FROM entrepreneurship AS e
            INNER JOIN department AS d ON e.department_fk = d.department_id
            INNER JOIN product AS p ON e.entrepreneurship_id = p.entrepreneurship_fk
        ');

        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            header('Content-Type: application/json');
            echo json_encode($result);
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['message' => 'Error al obtener datos']);
        }
    }

    public static function update_department($department_id, $department_name, $description, $amount_entrepreneurship) {
        $database = new Database();
        $conn = $database->getConnection();

        $stmt = $conn->prepare('UPDATE department SET department_name=:department_name, description=:description, amount$amount_entrepreneurship=:amount$amount_entrepreneurship WHERE department_id=:department_id');
        $stmt->bindParam(':department_id', $department_id);
        $stmt->bindParam(':department_name', $department_name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':amount$amount_entrepreneurship', $amount_entrepreneurship);

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