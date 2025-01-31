<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

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

    $productsRepository->addProduct($name, $description, $price, $image);

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}
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

        <div class="add-brand">
    <h2>Add Brand</h2>
    <form method="POST" enctype="multipart/form-data">
    <label for="name">Brand Name:</label>
    <input type="text" name="name" required>
    <br>

    <label for="description">Description:</label>
    <textarea name="description" required></textarea>
    <br>

    <label for="image">Image:</label>
    < <select name="image" required>
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
    <br>

    <button type="submit" name="add_brand">Add Brand</button>
</form>
</div>
<div class="add-product">
    <h2>Add Product</h2>
    <form method="POST" enctype="multipart/form-data">
        <label for="name">Product Name:</label>
        <input type="text" name="name" required>
        <br>

        <label for="description">Description:</label>
        <textarea name="description" required></textarea>
        <br>

        <label for="price">Price:</label>
        <input type="number" name="price" step="0.01" required>
        <br>

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

        <button type="submit" name="add_product">Add Product</button>
    </form>
</div>

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
            </tr>
        </thead>
        <tbody>
            <?php
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