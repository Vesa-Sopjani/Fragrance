<?php
session_start();
require_once __DIR__ . '/Repository/ProductsRepository.php';

$productsRepo = new ProductsRepository();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $product = $productsRepo->getProductById($product_id);

    if ($product) {
        if (!isset($_SESSION['cart'][$product_id])) {
            $_SESSION['cart'][$product_id] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => 1
            ];
        } else {
            $_SESSION['cart'][$product_id]['quantity']++;
        }
    }
    header("Location: cart.php");
    exit();
}

if (isset($_GET['remove'])) {
    $remove_id = $_GET['remove'];
    unset($_SESSION['cart'][$remove_id]);
    header("Location: cart.php");
    exit();
}

if (isset($_GET['clear'])) {
    $_SESSION['cart'] = [];
    header("Location: cart.php");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <nav>
            <div class="frag">Fragrance</div>
            <ul class="nav-lista">
                <li><a href="Home.php">Home</a></li>
                <li><a href="Brands.php">Brands</a></li>
                <li><a href="Products.php">Products</a></li>
                <li><a href="About.html">About Us</a></li>
                <li><a href="Contact.php">Contact Us</a></li>
                <li><a href="cart.php">Cart</a></li>
            </ul>
        </nav>
    </header>

    <div class="container">
        <h1>Your Cart</h1>
        <div class="card-row">
            <?php if (!empty($_SESSION['cart'])): ?>
                <?php foreach ($_SESSION['cart'] as $item): ?>
                    <div class="card">
                        <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                        <p>Price: $<?php echo htmlspecialchars($item['price']); ?></p>
                        <p>Quantity: <?php echo htmlspecialchars($item['quantity']); ?></p>
                        <a href="cart.php?remove=<?php echo $item['id']; ?>" class="jump-button">Remove</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>Your cart is empty.</p>
            <?php endif; ?>
        </div>
        <a href="cart.php?clear=true" class="jump-button">Clear Cart</a>
    </div>
</body>
</html>
