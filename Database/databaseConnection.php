<?php
class DatabaseConnection {
    private $host = 'localhost';
    private $dbname = 'projekti'; 
    private $username = 'root';
    private $password = '';
    private $conn;

    public function __construct() {
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname}",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Database Connection Failed: " . $e->getMessage();
            $this->conn = null; 
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>
