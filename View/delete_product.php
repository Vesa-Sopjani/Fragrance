<?php
include_once '../Repository/ProductsRepository.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $productsRepository = new ProductsRepository();
    $productsRepository->deleteProduct($id);
    
    header("Location: ../View/dashboard.php");
    exit;
}
?>
