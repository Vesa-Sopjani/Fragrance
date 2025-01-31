<?php
require_once __DIR__ . '/Repository/ProductsRepository.php';

$productsRepo = new ProductsRepository();
$products = $productsRepo->getAllProducts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    
<header>
    <nav>
        <div class="frag" id="fillimi-i-faqes">Fragrance</div>
      <ul class="nav-lista">
        <li><a href="Home.php">Home</a></li>
        <li><a href="Brands.php">Brands</a></li>
        <li><a href="Products.php">Products</a></li>
        <li><a href="About.php">About Us</a></li>
        <li><a href="Contact.php">Contact Us</a></li>
      </ul>
    </nav>
  </header>
    <div class="container">
    <div style=" text-align: right; padding: 20px;">
    <a href="cart.php" style=" display: inline-block; background:rgb(69, 14, 14); color: #222; padding: 12px 20px; font-size: 1em; font-weight: bold; text-decoration: none; border-radius: 10px; transition: background 0.3s ease-in-out, transform 0.2s ease; box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);">🛒</a>
</div>
       
        <h1 style="text-align:center;">Our Products</h1> 

        <div style="display: flex; flex-wrap: wrap; gap: 20px; justify-content: center; padding: 20px;" >
            <?php foreach ($products as $product): ?>

                <div style=" width: 300px; background: rgba(255, 255, 255, 0.1); border-radius: 15px; overflow: hidden; box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3); transition: transform 0.3s ease-in-out; text-align: center; backdrop-filter: blur(10px); ">
                    <div style=" width: 100%; height: 66%; border-top-left-radius: 15px; border-top-right-radius: 15px;">
                <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="Product Image" style="width: 100%; height: auto;">
            </div>
            <div style="padding: 15px;">
                <h3 style="  font-size: 1.4em;  color: #f8f8f8; margin-bottom: 10px;"><?php echo htmlspecialchars($product['name']); ?></h3>
                    <p style=" font-size: 0.9em;  color: #ddd; margin-bottom: 10px;"><?php echo htmlspecialchars($product['description']); ?></p>
                    <p style="  font-weight: bold; color:rgba(199, 127, 127, 0.59);">Price: $<?php echo htmlspecialchars($product['price']); ?></p>
                    
                    <form action="cart.php" method="POST">
                        <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                        <button type="submit" class="jump-button" style=" background:rgb(51, 51, 51); color:rgb(160, 160, 160);   border: none;   padding: 7px 15px;   font-size: 1em;   font-weight: bold;   border-radius: 10px;   cursor: pointer;   transition: background 0.3s ease-in-out;">Add to Cart</button>
                    </form>
                   </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>
