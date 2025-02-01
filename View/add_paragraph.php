<?php
include_once '../Database/databaseConnection.php';  

$conn = DatabaseConnection::getInstance()->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    $sql = "INSERT INTO paragraphs (title, content) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $title);
    $stmt->bindParam(2, $content);

    if ($stmt->execute()) {
        echo "Paragraph added successfully!";
        header("Location: ../About.php");
        exit();
    } else {
        echo "Error: " . $stmt->errorInfo()[2];  
    }
}
?>
