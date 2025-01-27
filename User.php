<?php
class User {
    private $conn;
    private $id;
    private $table_name = 'user';

    public function __construct($connection) {
        $this->conn = $connection;
    }

    public function register($name, $surname, $email, $password) {
        try {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);


            $query = "INSERT INTO user (name, surname, email, password)
                      VALUES (:name, :surname, :email, :password)";
           
            $stmt = $this->conn->prepare($query);
           
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':surname', $surname);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $hashed_password);


            return $stmt->execute();
           
        } catch (PDOException $e) {
            error_log("Registration Error: " . $e->getMessage());
            return false;
        }
    }

    public function login($email, $password) {
        $query = "SELECT * FROM user WHERE email = :email";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            $this->id = $user['user_id']; // Store user ID
            return true;
        }
        return false;
    }
}
?>