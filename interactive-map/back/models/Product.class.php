<?php
require_once('../../includes/Database.class.php');

class Product {
    public static function create_product($product_name, $product_image, $product_description, $product_innovation, $entrepreneurship_fk) {
        $database = new Database();
        $conn = $database->getConnection();

        $stmt = $conn->prepare('INSERT INTO product (product_name, product_image, product_description, product_innovation, entrepreneurship_fk) VALUES (:product_name, :product_image, :product_description, :product_innovation, :entrepreneurship_fk)');
        $stmt->bindParam(':product_name', $product_name);
        $stmt->bindParam(':product_image', $product_image);
        $stmt->bindParam(':product_description', $product_description);
        $stmt->bindParam(':product_innovation', $product_innovation);
        $stmt->bindParam(':entrepreneurship_fk', $entrepreneurship_fk);

        if ($stmt->execute()) {  
            return [
                'message' => 'Producto creado correctamente',
                'product_name' => $product_name,
                'product_image' => $product_image,
                'product_description' => $product_description,
                'product_innovation' => $product_innovation,
                'entrepreneurship_fk' => $entrepreneurship_fk
            ];
        } else {
            throw new Exception('No se pudo crear el producto');
        }
    }

    public static function get_all_products() {
        $database = new Database();
        $conn = $database->getConnection();
        $stmt = $conn->prepare('SELECT * FROM product');
        
        if ($stmt->execute()) {
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            header('Content-Type: application/json');
            echo json_encode($result);
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['message' => 'Error al obtener los productos']);
        }
    }

    public static function update_product($product_id, $product_name, $product_image, $product_description, $product_innovation, $entrepreneurshipship_fk) {
        $database = new Database();
        $conn = $database->getConnection();

        $stmt = $conn->prepare('UPDATE product SET product_name=:product_name, product_image=:product_image, product_description=:product_description,
        product_innovation=:product_innovation, entrepreneurship_fk=:entrepreneurship_fk WHERE product_id=:product_id');
        $stmt->bindParam(':product_id', $product_id);
        $stmt->bindParam(':product_name', $product_name);
        $stmt->bindParam(':product_image', $product_image);
        $stmt->bindParam(':product_description', $product_description);
        $stmt->bindParam(':product_innovation', $product_innovation);
        $stmt->bindParam(':entrepreneurship_fk', $entrepreneurship_fk);

        if ($stmt->execute()) {
            header('HTTP/1.1 200 OK');
            echo json_encode(['message' => 'Producto actualizado correctamente']);
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['message' => 'No se pudo actualizar el producto']);
        }
    }

    public static function delete_product_by_id($product_id) {
        $database = new Database();
        $conn = $database->getConnection();

        $stmt = $conn->prepare('DELETE FROM product WHERE product_id=:product_id');
        $stmt->bindParam(':product_id', $product_id);
        
        if ($stmt->execute()) {
            header('HTTP/1.1 204 No Content'); 
        } else {
            header('HTTP/1.1 500 Internal Server Error');
            echo json_encode(['message' => 'No se pudo borrar el producto']);
        }
    }
}
?>