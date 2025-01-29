<?php
session_start();
include_once '../Database/databaseConnection.php';
include_once '../Model/user.php';
include_once '../Repository/UserRepository.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $db = new databaseConnection();
    $connection = $db->getConnection();
    $userRepository = new userRepository($connection);  

    $name = filter_input(INPUT_POST, 'emri', FILTER_SANITIZE_STRING);
    $surname = filter_input(INPUT_POST, 'mbiemri', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];

    $errors = [];
    if (empty($name)) $errors[] = "Name is required.";
    if (empty($surname)) $errors[] = "Surname is required.";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email format.";
    if (strlen($password) < 8) $errors[] = "Password must be at least 8 characters.";

    if (empty($errors)) {
      $user = new User($name, $surname, $email, $password);

      if ($userRepository->insertUser($user)) {
          header("Location: ../login.php");
          exit();
      } else {
          $error = "Registration failed. Email might already exist.";
      }
  } else {
      $error = implode("<br>", $errors);
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up Form</title>
  <link rel="stylesheet" href="signin.css">
</head>
<body>
  <div class="background">
    <div class="form-container">
      <form class="signin-form" id="signin-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
        <h2>Sign Up</h2>
        
        <?php if (!empty($error)): ?>
          <div class="error" style="color: red;"><?php echo $error; ?></div>
        <?php endif; ?>

        <div class="form-group">
          <label for="emri" class="tekst">Emri</label>
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

        <button type="submit" id="register-btn" class="register-btn">Sign Up</button>
      </form>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const form = document.getElementById('signin-form');

      form.addEventListener('submit', function(event) {
        event.preventDefault();

        const emriInput = document.getElementById('emri');
        const mbiemriInput = document.getElementById('mbiemri');
        const emailInput = document.getElementById('email');
        const passwordInput = document.getElementById('password');

        let errorMessages = [];

        if (!emriInput.value.trim()) {
          errorMessages.push("Please enter your name.");
        }

        if (!mbiemriInput.value.trim()) {
          errorMessages.push("Enter your last name.");
        }

        const emailRegex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;
        if (!emailRegex.test(emailInput.value.trim())) {
          errorMessages.push("Please enter a valid email.");
        }

        if (emailInput.value.trim() !== emailInput.value.trim().toLowerCase()) {
          errorMessages.push("Email must be in lowercase.");
        }

        if (passwordInput.value.trim().length < 8) {
          errorMessages.push("Password must be at least 8 characters.");
        }

        if (errorMessages.length > 0) {
          alert(errorMessages.join("\n"));
          return; 
        }

        form.submit(); 
      });
    });
  </script>
  <?php include_once '../Controller/registerController.php';?>
</body>
</html>