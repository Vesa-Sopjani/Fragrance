<?php
include_once '../Repository/ProductsRepository.php';

$productsRepository = new ProductsRepository();

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $product = $productsRepository->getProductById($id);

    if (!$product) {
        die("Product not found!");
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = !empty($_POST['name']) ? trim($_POST['name']) : null;
        $description = !empty($_POST['description']) ? trim($_POST['description']) : null;
        $price = isset($_POST['price']) ? floatval($_POST['price']) : null;
    
        if (!empty($_FILES['image']['tmp_name'])) {
            $image = file_get_contents($_FILES['image']['tmp_name']); 
        } else {
            $image = null; 
        }
    
        $productsRepository->updateProduct($id, $name, $image, $description, $price);
    
        header("Location: ../View/dashboard.php");
        exit;
    }
    
} else {
    die("Invalid request!");
}
?>
<form method="POST" enctype="multipart/form-data" style="width: 50%; margin: 50px auto; padding: 20px; background: #222; color: white; border-radius: 10px; box-shadow: 0 0 10px rgba(255, 255, 255, 0.2);">
    <h2 style="text-align: center;">Edit Product</h2>

    <label for="name" style="display: block; margin-top: 10px;">Product Name:</label>
    <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required style="width: 100%; padding: 8px; margin-top: 5px; border-radius: 5px; border: none;">

    <label for="description" style="display: block; margin-top: 10px;">Description:</label>
    <textarea name="description" required style="width: 100%; padding: 8px; margin-top: 5px; border-radius: 5px; border: none;"><?php echo htmlspecialchars($product['description']); ?></textarea>

    <label for="price" style="display: block; margin-top: 10px;">Price ($):</label>
    <input type="number" step="0.01" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required style="width: 100%; padding: 8px; margin-top: 5px; border-radius: 5px; border: none;">

    <label for="image">Image:</label>
        <select name="image" required>
        <?php
        $imageDir = "../images/";
        $images = scandir($imageDir);
        
        foreach ($images as $image) {
            if ($image !== '.' && $image !== '..') {
                echo "<option value='images/$image'>$image</option>";
            }
        }
        ?>
    </select>

    <button type="submit" style="width: 100%; margin-top: 20px; padding: 10px; background: crimson; color: white; font-size: 16px; border: none; border-radius: 5px; cursor: pointer;">Update Product</button>
</form>