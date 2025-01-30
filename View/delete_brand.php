<?php
include_once '../Repository/brandRepository.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $brandRepository = new BrandRepository();
    $brandRepository->deleteBrand($id);
    header("Location: ../View/dashboard.php"); 
    exit;
}
?>
