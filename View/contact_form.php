<?php
// Aktivizoni shfaqjen e gabimeve për të ndihmuar në debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Lidhja me bazën e të dhënave
$servername = "localhost"; // ose IP e serverit të databazës
$username = "root"; // emri i përdoruesit të databazës
$password = ""; // fjalëkalimi i përdoruesit të databazës
$dbname = "Projekti"; // emri i bazës së të dhënave

// Krijo lidhjen
$conn = new mysqli($servername, $username, $password, $dbname);

// Kontrollo lidhjen
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Kontrollo nëse është bërë POST kërkesa nga formulari
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Merr të dhënat nga formulari
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $message = $_POST['message'];

    // Përgatitja e pyetjes SQL për të shtuar të dhënat në bazë
    $sql = "INSERT INTO contact_form (name, email, phone, message) 
            VALUES ('$name', '$email', '$phone', '$message')";

    // Ekzekuto pyetjen dhe kontrollo nëse është ekzekutuar me sukses
    if ($conn->query($sql) === TRUE) {
        // Redirekto përdoruesin në faqen e kontaktit me mesazh të suksesit
        header("Location: ../contact.php?success=true");
        exit(); // Kjo ndalon ekzekutimin e mëtejshëm të kodit
    } else {
        echo "Gabim: " . $sql . "<br>" . $conn->error;
    }

    // Mbyll lidhjen me databazën
    $conn->close();
}
?>
