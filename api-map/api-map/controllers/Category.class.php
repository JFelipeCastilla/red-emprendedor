<?php
    require_once('../../includes/Database.class.php');

    class Category {
        public static function create_category($name, $amount_users) {
            $database = new Database();
            $conn = $database->getConnection();

            $stmt = $conn->prepare('INSERT INTO category(name, amount_users) VALUES(:name, :amount_users)');
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':amount_users', $amount_users);

            if($stmt->execute()) {  
                header('HTTP/1.1 201 Categoria creada correctamente'); 
            } else {
                header('HTTP/1.1 404 Categoria no se pudo crear correctamente');  
            }
        }
        public static function delete_category_by_id($id){
            $database = new Database();
            $conn = $database->getConnection();

            $stmt = $conn->prepare('DELETE FROM category WHERE id=:id');
            $stmt->bindParam(':id',$id);
            if($stmt->execute()){
                header('HTTP/1.1 201 Categoria borrada correctamente'); 
            } else {
                header('HTTP/1.1 404 Categoria no se pudo borrar correctamente');
            }
        }
        public static function get_all_categories() {
            $database = new Database();
            $conn = $database->getConnection();
            $stmt = $conn->prepare('SELECT * FROM category');
            
            if($stmt->execute()) {
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($result);
                header('HTTP/1.1 200 OK'); 
            } else {
                header('HTTP/1.1 500 Internal Server Error');
            }
        }
        public static function update_category($id, $name, $amount_users) {
            $database = new Database();
            $conn = $database->getConnection();

            $stmt = $conn->prepare('UPDATE category SET name=:name, amount_users=:amount_users WHERE id=:id');
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':amount_users', $amount_users);

            if($stmt->execute()){
                header('HTTP/1.1 201 Categoria actualizada correctamente'); 
            } else {
                header('HTTP/1.1 404 Categoria no se pudo actualizar correctamente');
            }
        }
    }
?>