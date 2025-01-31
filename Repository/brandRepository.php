<?php
include_once __DIR__ . '/../Database/databaseConnection.php';
  

class BrandRepository {
    private $connection;

    public function __construct() {
        $this->connection = DatabaseConnection::getInstance(); 
    }


public function getBrandById($id) {
    $conn = $this->connection;
    
    $sql = "SELECT * FROM brand WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();

    
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

    public function getAllBrands() {
        $conn = $this->connection;
    
        $sql = "SELECT * FROM brand";
        $statement = $conn->query($sql);  
    
        if ($statement) {
           
            $brands = $statement->fetchAll(PDO::FETCH_ASSOC);
            return $brands;
        } else {
            echo "Error: " . $conn->errorInfo(); 
            return [];
        }
    }
    public function addBrand($name, $image, $description) {
        $conn = $this->connection;
        
        
        $sql = "INSERT INTO brand (name, image, description) VALUES (:name, :image, :description)";
        
        $stmt = $conn->prepare($sql);
        
        
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':image', $image, PDO::PARAM_STR);
        $stmt->bindParam(':description', $description, PDO::PARAM_STR);
        
     
        if ($stmt->execute()) {
            return;
        } else {
            echo "Error: " . $stmt->errorInfo()[2];
        }
    }
    
    

    

    
    public function updateBrand($id, $name, $image, $description) {
        $conn = $this->connection;

        $sql = "UPDATE brand SET name = ?, image = ?, description = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);  

        $stmt->bindParam(1, $name, PDO::PARAM_STR);
        $stmt->bindParam(2, $image, PDO::PARAM_STR);
        $stmt->bindParam(3, $description, PDO::PARAM_STR);
        $stmt->bindParam(4, $id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            echo "Brand updated successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
    }

   
    public function deleteBrand($id) {
        $conn = $this->connection;

        $sql = "DELETE FROM brand WHERE id = ?";
        $stmt = $conn->prepare($sql);  

        $stmt->bindParam(1, $id, PDO::PARAM_INT);  

        
        if ($stmt->execute()) {
            echo "Brand deleted successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}
?>
