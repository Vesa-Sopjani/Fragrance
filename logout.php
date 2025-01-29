<?php
session_start();
session_destroy();
header("Location: View/login.php"); // Redirect to login page after logout
exit;
?>