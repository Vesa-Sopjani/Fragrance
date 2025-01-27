<?php
include_once 'Database.php';
include_once 'User.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new Database();
    $connection = $db->getConnection();
    $user = new User($connection);

    // Get form data
    $name = $_POST['name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Register the user
    if ($user->register($name, $surname, $email, $password)) {
        header("Location: login.php"); // Redirect to login page
        exit;
    } else {
        echo "Error registering user!";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign in Form</title>
  <link rel="stylesheet" href="signin.css">
</head>
<body>
  <div class="background">
    <div class="form-container">
      <form class="signin-form" id="signin-form">

        <h2>Sign In</h2>
        
        <div class="form-group">
          <label for="emri"  class="tekst">Emri</label>
          <input type="text" id="emri" name="emri" placeholder="Enter your name" required>
        </div>
        <div class="form-group">
          <label for="mbiemri" class="tekst">Mbiemri</label>
          <input type="text" id="mbiemri" name="mbiemri" placeholder="Enter your last name" required>
        </div>
        <div class="form-group">
          <label for="email" class="tekst">Email</label>
          <input type="email" id="email" name="email" placeholder="Enter your email" required>
        </div>

        <div class="form-group">
          <label for="password" class="tekst">Password</label>
          <input type="password" id="password" name="password" placeholder="Enter your password" required>
        </div>

        <br>
        
        <button type="submit" id="register-btn" class="register-btn" onclick="goToLogin()">Sign up</button>
        
        
      </form>
    </div>
  </div>
  <script>
    document.addEventListener("DOMContentLoaded", function (event) {
      const submit = document.getElementById('register-btn');

      const validate=(event) => {
        event.preventDefault();

        const emriInput = document.getElementById('emri');
        const mbiemriInput = document.getElementById('mbiemri');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');

        if (emriInput.value === "") {
          alert("Please enter your name.");
          emriInput.focus();
          return false;
        }

        if (mbiemriInput.value.trim() === "") {
          alert("Enter your last name.");
          mbiemriInput.focus();
          return false;
        }

        if (emailInput.value.trim() === "") {
          alert("Enter your Email.");
          emailInput.focus();
          return false;
        }

        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailRegex.test(emailInput.value.trim())) {
            alert("Please enter a valid Email.");
            emailInput.focus();
           return false;
        }


            if (emailInput.value.trim() !== emailInput.value.trim().toLowerCase()) {
               alert("Email must be in lowercase only.");
               emailInput.focus();
               return false;
            }


            if (passwordInput.value.trim() === "") {
              alert("Enter a password.");
              passwordInput.focus();
              return false;
            }

            if(passwordInput.value.trim().length < 8) {
              alert("Your password must be at least 8 characters long.");
              passwordInput.focus();
              return false;
            } 

            alert("Sign In completed successfully!");
            document.getElementById('signin-form').submit();
          };

          submit.addEventListener("click", validate);
          });
          function goToLogin() {
    window.location.href = 'login.php'; 
          }

  </script>
</body>
</html>
