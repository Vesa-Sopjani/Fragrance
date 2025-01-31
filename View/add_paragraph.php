<?php
include_once '../Database/databaseConnection.php';  // Përfshi klasën

// Merrni lidhjen me bazën e të dhënave
$conn = DatabaseConnection::getInstance();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Query për shtimin e paragrafin
    $sql = "INSERT INTO paragraphs (title, content) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $title);
    $stmt->bindParam(2, $content);

    if ($stmt->execute()) {
        echo "Paragraph added successfully!";
        header("Location: ../About.php");
        exit();
    } else {
        echo "Error: " . $stmt->errorInfo()[2];  // Shfaq gabimin e SQL
    }
}
?>
