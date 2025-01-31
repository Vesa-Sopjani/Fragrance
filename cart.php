<?php
require_once __DIR__ . '/Repository/ProductsRepository.php';
require_once __DIR__ . '/Database/databaseConnection.php';

$conn = DatabaseConnection::getInstance();

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];

    $stmt = $conn->prepare("SELECT quantity FROM cart WHERE product_id = ?");
    $stmt->execute([$product_id]);
    $existingProduct = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingProduct) {
        $newQuantity = $existingProduct['quantity'] + 1;
        $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE product_id = ?");
        $stmt->execute([$newQuantity, $product_id]);
    } else {
        $stmt = $conn->prepare("INSERT INTO cart (product_id, quantity) VALUES (?, 1)");
        $stmt->execute([$product_id]);
    }
    header("Location: " . $_SERVER['PHP_SELF']);
    exit;

}
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['decrease_product_id'])) {
    $product_id = $_POST['decrease_product_id'];

    $stmt = $conn->prepare("SELECT quantity FROM cart WHERE product_id = ?");
    $stmt->execute([$product_id]);
    $existingProduct = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingProduct && $existingProduct['quantity'] > 1) {
        $newQuantity = $existingProduct['quantity'] - 1;
        $stmt = $conn->prepare("UPDATE cart SET quantity = ? WHERE product_id = ?");
        $stmt->execute([$newQuantity, $product_id]);
    } elseif ($existingProduct && $existingProduct['quantity'] == 1) {
        $stmt = $conn->prepare("DELETE FROM cart WHERE product_id = ?");
        $stmt->execute([$product_id]);
    }

    header("Location: " . $_SERVER['PHP_SELF']);
    exit;
}

$stmt = $conn->query("SELECT p.id, p.name, p.price, p.image, c.quantity FROM cart c JOIN products p ON c.product_id = p.id");
$cartItems = $stmt->fetchAll(PDO::FETCH_ASSOC);

$totalPrice = 0;
foreach ($cartItems as $item) {
    $totalPrice += $item['price'] * $item['quantity']; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background:rgb(11, 11, 11);
            text-align: center;
            margin: 0;
            padding: 20px;
        }
        h1 {
            color: rgb(88, 0, 0);
        }
        .cart-items {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }
        .cart-item {
            background: rgb(35, 35, 35);
            padding: 15px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 220px;
            text-align: center;
        }
        .cart-item img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 10px;
        }
        .cart-item h3 {
            font-size: 18px;
            margin: 10px 0;
            color: #888;
        }
        .cart-item p {
            font-size: 16px;
            font-weight: bold;
            color: rrgba(89, 14, 14, 0.24)
        }
        .cart-summary {
            margin-top: 20px;
            font-size: 18px;
            font-weight: bold;
            color: rgb(211, 211, 211);
        }
        .cart-buttons {
            margin-top: 20px;
        }
        .cart-buttons a {
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin: 10px;
            display: inline-block;
            font-size: 16px;
        }
        .continue-shopping {
            background:rgb(78, 50, 50);
            color: white;
        }

        .continue-shopping:hover {
            background:rgb(126, 24, 24); 
        }

        .checkout:hover {
            background: #d60000; 
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); 
        }

        .checkout {
            background: rgb(89, 14, 14);
            color: white;
        }
    </style>
</head>
<body>
    <h1>Your Cart</h1>
    <div class="cart-items">
        <?php foreach ($cartItems as $item): ?>
            <div class="cart-item">
            <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="Product Image" style="width: 100%; height: auto;">               
             <h3><?php echo htmlspecialchars($item['name']); ?></h3>
                <p>Price: $<?php echo number_format($item['price'], 2); ?></p>
                <p>Quantity: <?php echo $item['quantity']; ?></p> 
                <form method="POST" action="">
                <input type="hidden" name="product_id" value="<?php echo $item['id']; ?>">
                <button type="submit" style="padding: 3px 10px; background-color:rgb(78, 78, 78); color: white; border: 1px solid #111; border-radius: 30px; cursor: pointer; font-size: 14px;">+</button>
            </form>

            <form method="POST" action="">
                <input type="hidden" name="decrease_product_id" value="<?php echo $item['id']; ?>">
                <button type="submit" style="padding: 3px 10px; background-color:rgb(9, 9, 9); color: white; border: 1px solid #111; border-radius: 30px; cursor: pointer; font-size: 14px;"> - </button>           
 </form>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="cart-summary">
        <p>Total: $<?php echo number_format($totalPrice, 2); ?></p>
    </div>

    <div class="cart-buttons">
        <a href="products.php" class="continue-shopping">Continue Shopping</a>
        <a href="#" class="checkout">Proceed to Checkout</a>
    </div>
</body>
</html>
