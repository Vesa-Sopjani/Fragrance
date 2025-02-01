<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
$added_by = $_SESSION['user_id']; 

if ($_SESSION['role'] !== 'admin') {
    header("Location: dashboard.php");
    exit;
}


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_brand'])) {
    include_once '../Repository/brandRepository.php';
    $brandRepository = new BrandRepository();
        
    $name = $_POST['name'];
    $description = $_POST['description'];
    $image = $_POST['image']; 

    
    $brandRepository->addBrand($name, $description, $image);

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;

}


include_once '../Repository/ProductsRepository.php';
$productsRepository = new ProductsRepository();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_product'])) {
    include_once '../Repository/ProductsRepository.php';
    $productsRepository = new ProductsRepository();

    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image = $_POST['image'];
    $added_by = $_SESSION['user_id'];  

    $productsRepository->addProduct($name, $description, $price, $image, $added_by);

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
$conn = DatabaseConnection::getInstance()->getConnection();
$query = "SELECT * FROM paragraphs";
$stmt = $conn->prepare($query);
$stmt->execute();
$paragraphs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/dashboard.css">
    <title>Admin Dashboard</title>
</head>
<body>
    <div class="dashboard-container">
    <div class="home-btn">
    <a href="../Home.php">Back to Home</a>
        <h1>Admin Dashboard</h1>
       
        </div>
        <br>
        <br>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Surname</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Password</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include_once '../Repository/userRepository.php';

                $userRepository = new UserRepository();
                $user_id = $_SESSION['user_id'];
                $user = $userRepository->getAdmin($user_id);

                if ($user) {
                    echo "
                    <tr>
                        <td>{$user['user_id']}</td>
                        <td>{$user['name']}</td>
                        <td>{$user['surname']}</td>
                        <td>{$user['email']}</td>
                        <td>{$user['role']}</td>
                        <td>{$user['password']}</td>
                        <td class='action-links'><a href='edit.php?user_id={$user['user_id']}'>Edit</a></td>
                        <td class='action-links'><a href='delete.php?user_id={$user['user_id']}'>Delete</a></td>
                    </tr>
                    ";
                }
                ?>
            </tbody>
        </table>

        <div class="contact-form-entries">
    <h2>Contact From Messages</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Message</th>
                <th>Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include_once '../Repository/contactFormRepository.php'; 
            $contactFormRepository = new ContactFormRepository();
            $entries = $contactFormRepository->getAllEntries(); 

            foreach ($entries as $entry) {
                echo "
                <tr>
                    <td>{$entry['id']}</td>
                    <td>{$entry['name']}</td>
                    <td>{$entry['email']}</td>
                    <td>{$entry['phone']}</td>
                    <td>{$entry['message']}</td>
                    <td>{$entry['created_at']}</td>
                </tr>
                ";
            }
            ?>
        </tbody>
    </table>
</div>

<div style="display: flex; justify-content: space-between; gap: 20px; flex-wrap: wrap; padding: 20px;">
    <div class="add-brand" style="flex: 1; max-width: 30%; background-color:rgba(0, 0, 0, 0.38); padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <h2 style="text-align: center; color: rgb(177, 47, 47);">Add Brand</h2>
        <form method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 10px;">
            <label for="name" style="font-size: 16px; color:rgb(255, 255, 255);">Brand Name:</label>
            <input type="text" name="name" required style="padding: 8px; border: 1px solid #ccc; border-radius: 5px;">

            <label for="description" style="font-size: 16px; color:rgb(255, 255, 255);">Description:</label>
            <textarea name="description" required style="padding: 8px; border: 1px solid #ccc; border-radius: 5px;"></textarea>

            <label for="image" style="font-size: 16px; color:rgb(255, 255, 255);">Image:</label>
            <select name="image" required style="padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
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

            <button type="submit" name="add_brand" style="background-color: rgb(177, 47, 47); color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; margin-top: 10px;">
                Add Brand
            </button>
        </form>
    </div>

    <div class="add-product" style="flex: 1; max-width: 30%; background-color:rgba(0, 0, 0, 0.38); padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <h2 style="text-align: center; color: rgb(177, 47, 47);">Add Product</h2>
        <form method="POST" enctype="multipart/form-data" style="display: flex; flex-direction: column; gap: 10px;">
            <label for="name" style="font-size: 16px; color:rgb(255, 255, 255);">Product Name:</label>
            <input type="text" name="name" required style="padding: 8px; border: 1px solid #ccc; border-radius: 5px;">

            <label for="description" style="font-size: 16px; color:rgb(255, 255, 255);">Description:</label>
            <textarea name="description" required style="padding: 8px; border: 1px solid #ccc; border-radius: 5px;"></textarea>

            <label for="price" style="font-size: 16px; color:rgb(255, 255, 255);">Price:</label>
            <input type="number" name="price" step="0.01" required style="padding: 8px; border: 1px solid #ccc; border-radius: 5px;">

            <label for="image" style="font-size: 16px;  color:rgb(255, 255, 255);">Image:</label>
            <select name="image" required style="padding: 8px; border: 1px solid #ccc; border-radius: 5px;">
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

            <button type="submit" name="add_product" style="background-color:rgb(177, 47, 47); color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; margin-top: 10px;">
                Add Product
            </button>
        </form>
    </div>

    <div class="add-paragraph" style="flex: 1; max-width: 30%; background-color:rgba(0, 0, 0, 0.38); padding: 20px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);">
        <h2 style="text-align: center; color: rgb(177, 47, 47);">Add Paragraph</h2>
        <form action="../View/add_paragraph.php" method="POST" style="display: flex; flex-direction: column; gap: 10px;">
            <label for="title" style="font-size: 16px; color:rgb(255, 255, 255);">Title:</label>
            <input type="text" id="title" name="title" required style="padding: 8px; border: 1px solid #ccc; border-radius: 5px;">

            <label for="content" style="font-size: 16px; color:rgb(255, 255, 255);">Text:</label>
            <textarea id="content" name="content" rows="4" required style="padding: 8px; border: 1px solid #ccc; border-radius: 5px;"></textarea>

            <button type="submit" style="background-color:rgb(177, 47, 47); color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer; font-size: 16px; display: block; margin: 0 auto;">
                Add Paragraph
            </button>
        </form>
    </div>
</div>


<br>
<table border="1">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Content</th>
        <th>Action</th>
    </tr>
    <?php foreach ($paragraphs as $para) : ?>
        <tr>
            <td><?php echo $para['id']; ?></td>
            <td><?php echo htmlspecialchars($para['title']); ?></td>
            <td><?php echo htmlspecialchars($para['content']); ?></td>
            <td>
                <a href="delete_paragraph.php?id=<?php echo $para['id']; ?>" style="color:red;"
                   onclick="return confirm('Are you sure you want to delete this paragraph?');">
                   Delete
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<div class="brand-list">
    <h2>List of Brands</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Image</th>
                <th>Manage</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include_once '../Repository/brandRepository.php';
            $brandRepository = new BrandRepository();
            $brands = $brandRepository->getAllBrands();

            foreach ($brands as $brand) {
                echo "
                <tr>
                    <td>{$brand['id']}</td>
                    <td>{$brand['name']}</td>
                    <td>{$brand['description']}</td>
                    <td><img src='../{$brand['image']}' alt='{$brand['name']}' width='100'></td>
                    <td class='action-links'>
                        <a href='../View/edit_brand.php?id={$brand['id']}'>Edit</a>
                        <a href='../View/delete_brand.php?id={$brand['id']}'>Delete</a>
                    </td>
                </tr>
                ";
            }
            ?>
        </tbody>
    </table>
</div>
<div class="product-list">
    <h2>List of Products</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image</th>
                <th>Manage</th>
                <th>Inserted by</th>
            </tr>
        </thead>
        <tbody>
        <?php
include_once '../Repository/ProductsRepository.php';
$productsRepository = new ProductsRepository();
$products = $productsRepository->getAllProducts(); 

foreach ($products as $product) {
    echo "
    <tr>
        <td>{$product['id']}</td>
        <td>{$product['name']}</td>
        <td>{$product['description']}</td>
        <td>{$product['price']}€</td>
        <td><img src='../{$product['image']}' alt='Product Image' width='100'></td>
        <td class='action-links'>
            <a href='../View/edit_product.php?id={$product['id']}'>Edit</a>
            <a href='../View/delete_product.php?id={$product['id']}'>Delete</a>
        </td>
        <td>{$product['email']}</td> <!-- Display the email here -->
    </tr>
    ";
}
?>

        </tbody>
    </table>
</div>

   <br>
        <div class="logout-btn">
            <a href="../logout.php">Logout</a>
        </div>
        <br>
    </div>
</body>
</html>