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

            if($stmt->execute()) {  
                header('HTTP/1.1 201 Departamento fue creada correctamente'); 
            } else {
                header('HTTP/1.1 404 Departamento no se pudo crear correctamente');  
            }
        }
        public static function get_all_departments() {
            $database = new Database();
            $conn = $database->getConnection();
            $stmt = $conn->prepare('SELECT * FROM department');
            
            if($stmt->execute()) {
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

            $stmt = $conn->prepare('UPDATE deparment SET department_name=:department_name, description=:description, department_entrepreneur=:department_entrepreneur WHERE department_id=:department_id');
            $stmt->bindParam(':department_id', $department_id);
            $stmt->bindParam(':department_name', $department_name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':department_entrepreneur', $department_entrepreneur);

            if($stmt->execute()){
                header('HTTP/1.1 201 Departamento actualizada correctamente');
            } else {
                header('HTTP/1.1 404 Departamento no se pudo actualizar correctamente');
            }
        }
        public static function delete_department_by_id($department_id){
            $database = new Database();
            $conn = $database->getConnection();

            $stmt = $conn->prepare('DELETE FROM deparment WHERE department_id=:department_id');
            $stmt->bindParam(':department_id',$department_id);
            if($stmt->execute()){
                header('HTTP/1.1 201 Departamento fue borrado correctamente'); 
            } else {
                header('HTTP/1.1 404 Departamento no se a podido borrar correctamente');
            }
        }
    }
?>