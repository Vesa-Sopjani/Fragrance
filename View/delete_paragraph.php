<?php
include_once '../Database/DatabaseConnection.php'; 

$conn = DatabaseConnection::getInstance();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM paragraphs WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    header("Location: ../View/dashboard.php");
    exit();
} else {
    echo "ID e paragrafit nuk u gjet!";
}
?>
