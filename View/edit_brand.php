<?php
include_once '../Repository/brandRepository.php';

$brandRepository = new BrandRepository();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $brand = $brandRepository->getBrandById($id);
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $description = $_POST['description'];
        $image = $_FILES['image']['name'] ? 'uploads/' . basename($_FILES['image']['name']) : $brand['image'];

        
        if ($_FILES['image']['name']) {
            move_uploaded_file($_FILES['image']['tmp_name'], $image);
        }

        $brandRepository->updateBrand($id, $name, $image, $description);
        header("Location: ../View/dashboard.php"); 
        exit;
    }
}
?>

<form method="POST" enctype="multipart/form-data">
    <input type="text" name="name" value="<?php echo $brand['name']; ?>" required>
    <textarea name="description" required><?php echo $brand['description']; ?></textarea>
    <input type="file" name="image">
    <button type="submit">Update</button>
</form>
