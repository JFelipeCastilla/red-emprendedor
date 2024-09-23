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

            if($stmt->execute()) {  
                header('HTTP/1.1 201 Municipio fue creada correctamente'); 
            } else {
                header('HTTP/1.1 404 Municipio no se pudo crear correctamente');  
            }
        }
        public static function get_all_townships() {
            $database = new Database();
            $conn = $database->getConnection();
            $stmt = $conn->prepare('SELECT * FROM township');
            
            if($stmt->execute()) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
                header('Content-Type: application/json');
                echo json_encode($result);
            } else {
                header('HTTP/1.1 500 Internal Server Error');
                echo json_encode(['message' => 'Error al obtener los Municipios']);
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

            if($stmt->execute()){
                header('HTTP/1.1 201 Municipio actualizada correctamente');
            } else {
                header('HTTP/1.1 404 Municipio no se pudo actualizar correctamente');
            }
        }
        public static function delete_department_by_township_id($township_id){
            $database = new Database();
            $conn = $database->getConnection();

            $stmt = $conn->prepare('DELETE FROM township WHERE township_id=:township_id');
            $stmt->bindParam(':township_id',$township_id);
            if($stmt->execute()){
                header('HTTP/1.1 201 Municipio fue borrado correctamente'); 
            } else {
                header('HTTP/1.1 404 Municipio no se a podido borrar correctamente');
            }
        }
    }
?>