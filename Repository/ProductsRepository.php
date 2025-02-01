<?php
require_once __DIR__ . '/../Database/databaseConnection.php';

class ProductsRepository {
    private $conn;

    public function __construct() {
        $this->conn = DatabaseConnection::getInstance()->getConnection(); 
    }

public function addProduct($name, $description, $price, $image, $added_by) {
    $query = "INSERT INTO products (name, description, price, image, added_by) 
              VALUES (:name, :description, :price, :image, :added_by)";

    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':description', $description);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':image', $image);
    $stmt->bindParam(':added_by', $added_by); 

    $stmt->execute();
}

    
    public function getProductById($id) {
        $sql = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getAllProducts() {
        $sql = "
            SELECT p.id, p.name, p.description, p.price, p.image, u.email 
            FROM products p 
            JOIN user u ON p.added_by = u.user_id
        ";
        
        $stmt = $this->conn->prepare($sql); 
        $stmt->execute(); 
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
    

    public function updateProduct($id, $name = null, $image = null, $description = null, $price = null) {
        $query = "UPDATE products SET ";
        $params = [];
        
        if (!empty($name)) {
            $query .= "name = ?, ";
            $params[] = $name;
        }
        if (!empty($image)) {
            $query .= "image = ?, ";
            $params[] = $image;
        }
        if (!empty($description)) {
            $query .= "description = ?, ";
            $params[] = $description;
        }
        if (!empty($price)) {
            $query .= "price = ?, ";
            $params[] = $price;
        }
    
        $query = rtrim($query, ', ');
    
        if (empty($params)) {
            return; 
        }
    
        $query .= " WHERE id = ?";
        $params[] = $id;
    
        $stmt = $this->conn->prepare($query);
        
        try {
            $stmt->execute($params);
        } catch (PDOException $e) {
            die("Error updating product: " . $e->getMessage());
        }
    }
    

    public function deleteProduct($id) {
        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $this->conn->prepare($sql);

        try {
            $stmt->execute([$id]);
        } catch (PDOException $e) {
            die("Error deleting product: " . $e->getMessage());
        }
    }
}
?>
