<?php

include_once '../Repository/userRepository.php';
include_once '../Model/user.php';

if (isset($_POST['registerBtn'])) {
 
    if (empty($_POST['name']) || empty($_POST['surname']) || empty($_POST['email']) ||
        empty($_POST['password'])) {
        echo "Fill all fields!"; 
    } else {
        
        $name = $_POST['name'];          
        $surname = $_POST['surname'];    
        $email = $_POST['email'];       
        $password = $_POST['password'];  

        

       
        $user = new User($user_id, $name, $surname, $email, $password);

       
        $userRepository = new UserRepository();

        
        $userRepository->insertUser($user);
    }
}
?>