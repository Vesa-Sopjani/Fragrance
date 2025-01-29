<?php
include_once '../Database/databaseConnection.php';
include_once '../Model/user.php';

class UserRepository {
    private $connection;

    public function __construct() {
        $db = new DatabaseConnection();
        $this->connection = $db->getConnection();
    }

    function insertUser($user) {
        $conn = $this->connection;
    
        $name = $user->getName();
        $surname = $user->getSurname();
        $email = $user->getEmail();
        $password = $user->getPassword();
    
        try {
            $sql = "INSERT INTO user (name, surname, email, password) VALUES (?, ?, ?, ?)";
            $statement = $conn->prepare($sql);
            
            $result = $statement->execute([$name, $surname, $email, $password]);
    
            return $result;
        } catch (PDOException $e) {
            echo "Error in insertUser: " . $e->getMessage();
            return false;
        }
    }
    
    function getAllUsers() {
        $conn = $this->connection;

        $sql = "SELECT * FROM user";

        $statement = $conn->query($sql); 
        $users = $statement->fetchAll(); 

        return $users; 
    }

    
    function getUserById($user_id) {
        $conn = $this->connection;
    
        $sql = "SELECT user_id, name, surname, email, password FROM user WHERE user_id = :user_id";
    
        $statement = $conn->prepare($sql);
        $statement->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $statement->execute();
    
        return $statement->fetch(PDO::FETCH_ASSOC);
    }
    

    
    function updateUser($user_id, $name, $surname, $email, $password) {
        $conn = $this->connection;


        $sql = "UPDATE user SET name=?, surname=?, email=?, password=? WHERE user_id=?";

        $statement = $conn->prepare($sql); 

      
        $statement->execute([$name, $surname, $email, $password, $user_id]);

      
        echo "<script>alert('Update was successful');</script>";
    }

    
    function deleteUser($user_id) {
        $conn = $this->connection;

      
        $sql = "DELETE FROM user WHERE user_id=?";

        $statement = $conn->prepare($sql); 
        $statement->execute([$user_id]);

       
        echo "<script>alert('Delete was successful');</script>";
    }

    public function login($email, $password) {
        try {
            $query = "SELECT user_id, name, surname, email, password FROM user WHERE email = :email";
            $stmt = $this->connection->prepare($query);
            $stmt->bindValue(':email', $email, PDO::PARAM_STR);
            $stmt->execute();

            if ($stmt->rowCount() > 0) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);
                if (password_verify($password, $row['password'])) {
                    session_start();
                    $_SESSION['user_id'] = $row['user_id'];
                    $_SESSION['email'] = $row['email'];

                    return true;
                }
            }
            return false;
        } catch (PDOException $e) {
            echo "Error in login: " . $e->getMessage();
            return false;
        }
    }
}
?>
