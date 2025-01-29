<?php
session_start();

include_once '../Database.php';
include_once '../User.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new Database();
    $connection = $db->getConnection();
    $user = new User($connection);

    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if ($user->login($email, $password)) {
      echo "Login successful!<br>";
      echo "Session User ID: " . $_SESSION['user_id'] . "<br>";
      echo "Session Email: " . $_SESSION['email'] . "<br>";
      
      header("Refresh: 3; URL=../Home.php"); 
      exit;
  }
  
     else {
        echo "Invalid login credentials!";
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Form</title>
  <link rel="stylesheet" href="../css/signin.css">
</head>
<body>
  <div class="backgroundi">
    <div class="form-container">
      <form class="login-form" id="login-form" method="POST" action="">
        <h2>Log In</h2>
        
        <?php if (!empty($error)): ?>
          <div class="error" style="color: red;"><?php echo $error; ?></div>
        <?php endif; ?>

        <div class="form-group">
          <label for="email" class="tekst">Email</label>
          <input type="email" id="email" name="email" placeholder="Enter your email" required>
        </div>

        <div class="form-group">
          <label for="password" class="tekst">Password</label>
          <input type="password" id="password" name="password" placeholder="Enter your password" required>
        </div>

        <div style="display: flex; align-items: center;">
          <input type="checkbox" id="rememberMe" name="rememberMe">
          <label for="rememberMe" style="margin-left: 5px;"> Remember me</label>
        </div>

        <br>
        
        <button type="submit" id="login-btn" class="register-btn">Log In</button>
        
        <br><br>
        <p>Don't have an account? 
          <a href="register.php" style="color: #ff0000; text-decoration: underline;">Sign up</a>
        </p>
      </form>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const form = document.getElementById('login-form');

      form.addEventListener('submit', function(event) {
        event.preventDefault();

        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');
        let errorMessages = [];

        // Validation logic
        if (!emailInput.value.trim()) errorMessages.push("Email is required.");
        if (!passwordInput.value.trim()) errorMessages.push("Password is required.");

        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailRegex.test(emailInput.value.trim())) {
          errorMessages.push("Invalid email format.");
        }

        if (errorMessages.length > 0) {
          alert(errorMessages.join("\n"));
          return;
        }

        form.submit(); 
      });
    });
  </script>
</body>
</html>