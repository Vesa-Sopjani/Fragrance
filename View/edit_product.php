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
<body style="background: #1c1c1c; color: white; font-family: Arial, sans-serif;">

<form method="POST" enctype="multipart/form-data" style="width: 50%; margin: 50px auto; padding: 25px; background: #1c1c1c; color: white; border-radius: 12px; box-shadow: 0 0 12px rgba(255, 255, 255, 0.15);">
    <h2 style="text-align: center; font-size: 22px; margin-bottom: 15px;">Edit Product</h2>

    <label for="name" style="display: block; margin: 10px 0 5px; font-weight: bold;">Product Name:</label>
    <input type="text" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required 
        style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #555; background: #333; color: white;">

    <label for="description" style="display: block; margin: 10px 0 5px; font-weight: bold;">Description:</label>
    <textarea name="description" required 
        style="width: 100%; height: 100px; padding: 10px; border-radius: 6px; border: 1px solid #555; background: #333; color: white;"><?php echo htmlspecialchars($product['description']); ?></textarea>

    <label for="price" style="display: block; margin: 10px 0 5px; font-weight: bold;">Price (€):</label>
    <input type="number" step="0.01" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required 
        style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #555; background: #333; color: white;">

    <label for="image" style="display: block; margin: 10px 0 5px; font-weight: bold;">Image:</label>
    <select name="image" required 
        style="width: 100%; padding: 10px; border-radius: 6px; border: 1px solid #555; background: #333; color: white;">
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

    <button type="submit" 
        style="width: 100%; margin-top: 15px; padding: 12px; background: crimson; color: white; font-size: 16px; font-weight: bold; border: none; border-radius: 6px; cursor: pointer; transition: 0.3s;">
        Update Product
    </button>
</form>
    </body>