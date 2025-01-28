<?php
class User {
    private $conn;
    private $table_name = 'user';

    public function __construct($db) {
        $this->conn = $db;
    }

    public function register($name, $surname, $email, $password) {
        $query = "INSERT INTO {$this->table_name} (name, surname, email, password) VALUES (:name, :surname, :email, :password)";

        $stmt = $this->conn->prepare($query);

        $stmt->bindValue(':name', $name, PDO::PARAM_STR);
        $stmt->bindValue(':surname', $surname, PDO::PARAM_STR);
        $stmt->bindValue(':email', $email, PDO::PARAM_STR);
        $stmt->bindValue(':password', password_hash($password, PASSWORD_DEFAULT), PDO::PARAM_STR); // Hashing the password

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function login($email, $password) {
        $query = "SELECT user_id, name, surname, email, password FROM {$this->table_name} WHERE email = :email";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
    
        if ($stmt->rowCount() > 0) {
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            
            if (password_verify($password, $row['password'])) {
                session_start(); 
                
                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['email'] = $row['email'];
    

                echo "Session started in login function!<br>";
                echo "User ID: " . $_SESSION['user_id'] . "<br>";
                echo "Email: " . $_SESSION['email'] . "<br>";
    
                return true;
            }
        }
        return false;
    }
    
}
?>