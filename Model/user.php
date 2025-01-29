<?php

session_start();
class User {

    private $name;       
    private $surname;    
    private $email;      
    private $password;  


    function __construct($name, $surname, $email, $password) {
        $this->name = $name;           
        $this->surname = $surname;    
        $this->email = strtolower($email); 
        $this->password = password_hash($password, PASSWORD_DEFAULT);  
    }

 
    function getName() {
        return $this->name;
    }

   
    function getSurname() {
        return $this->surname;
    }

  
    function getEmail() {
        return $this->email;
    }

 
    function getPassword() {
        return $this->password;
    }

    function setSessionRole($user) {
        if (isset($user['role'])) { 
            $_SESSION['role'] = $user['role'];
        }

}


?>
