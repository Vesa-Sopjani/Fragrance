<?php
include_once '../Database/DatabaseConnection.php'; // Përfshi lidhjen me databazën

$conn = DatabaseConnection::getInstance();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fshij paragrafin me ID e dhënë
    $query = "DELETE FROM paragraphs WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    // Ridrejto përsëri në dashboard pas fshirjes
    header("Location: ../View/dashboard.php");
    exit();
} else {
    echo "ID e paragrafit nuk u gjet!";
}
?>
