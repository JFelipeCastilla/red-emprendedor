<?php
    require_once('../../includes/Database.class.php');

    class Department {
        public static function create_department($name, $description, $entrepreneurs) {
            $database = new Database();
            $conn = $database->getConnection();

            $stmt = $conn->prepare('INSERT INTO department (name, description, entrepreneurs) VALUES(:name, :description, :entrepreneurs)');
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':entrepreneurs', $entrepreneurs);

            if($stmt->execute()) {  
                header('HTTP/1.1 201 Departamento fue creada correctamente'); 
            } else {
                header('HTTP/1.1 404 Departamento no se pudo crear correctamente');  
            }
        }
        public static function delete_department_by_id($id){
            $database = new Database();
            $conn = $database->getConnection();

            $stmt = $conn->prepare('DELETE FROM deparment WHERE id=:id');
            $stmt->bindParam(':id',$id);
            if($stmt->execute()){
                header('HTTP/1.1 201 Departamento fue borrado correctamente'); 
            } else {
                header('HTTP/1.1 404 Departamento no se a podido borrar correctamente');
            }
        }
        public static function get_all_departments() {
            $database = new Database();
            $conn = $database->getConnection();
            $stmt = $conn->prepare('SELECT * FROM department');
            
            if($stmt->execute()) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                // Establecer la cabecera de tipo de contenido a JSON antes de cualquier salida
                header('Content-Type: application/json');
                echo json_encode($result); // Enviar el resultado como JSON
            } else {
                // Si hay un error, envía un código de error
                header('HTTP/1.1 500 Internal Server Error');
                echo json_encode(['message' => 'Error al obtener los departamentos']);
            }
        }
        public static function update_department($id, $name, $description, $entrepreneurs) {
            $database = new Database();
            $conn = $database->getConnection();

            $stmt = $conn->prepare('UPDATE deparment SET name=:name, description=:description, entrepreneurs=:entrepreneurs WHERE id=:id');
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':entrepreneurs', $entrepreneurs);

            if($stmt->execute()){
                header('HTTP/1.1 201 Departamento actualizada correctamente');
            } else {
                header('HTTP/1.1 404 Departamento no se pudo actualizar correctamente');
            }
        }
    }
?>