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
<body style="background: #1c1c1c; color: white; font-family: Arial, sans-serif;">

<form method="POST" enctype="multipart/form-data" style="width: 50%; margin: 50px auto; padding: 25px; background: #1c1c1c; color: white; border-radius: 12px; box-shadow: 0 0 12px rgba(255, 255, 255, 0.15);">
    <h2 style="text-align: center; font-size: 22px; margin-bottom: 15px;">Edit Brand</h2>

    <label for="name" style="display: block; margin: 10px 0 5px; font-weight: bold;">Brand Name:</label>
    <input type="text" name="name" value="<?php echo $brand['name']; ?>" required 
        style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #555; background: #333; color: white;">

    <label for="description" style="display: block; margin: 10px 0 5px; font-weight: bold;">Description:</label>
    <textarea name="description" required 
        style="width: 100%; height: 100px; padding: 10px; border-radius: 6px; border: 1px solid #555; background: #333; color: white;"><?php echo $brand['description']; ?></textarea>

    <label for="image" style="display: block; margin: 10px 0 5px; font-weight: bold;">Brand Image:</label>
    <input type="file" name="image" 
        style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #555; background: #333; color: white;">

    <button type="submit" 
        style="width: 100%; margin-top: 15px; padding: 12px; background: crimson; color: white; font-size: 16px; font-weight: bold; border: none; border-radius: 6px; cursor: pointer; transition: 0.3s;">
        Update Brand
    </button>
</form>

</body>