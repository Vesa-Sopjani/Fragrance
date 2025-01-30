<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

if (!isset($_SESSION['user_id'])) {
    echo "You are not logged in! Redirecting to login...<br>";
    print_r($_SESSION); 
    header("Refresh: 5; URL=../View/login.php"); 
    exit;
}

echo "Welcome, " . $_SESSION['email'] . "!<br>";
echo "<a href='logout.php'>Logout</a>"; 
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home Page</title>
  <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
        <a href="View/dashboard.php">
            <button class="dashboard-butoni" style="background-color: rgb(103, 20, 34) ; color: #010000 ; padding: 10px 20px; border-radius: 5px; ">Go to Admin Dashboard</button>
        </a>
    <?php endif; ?>
<header>
    <nav>
        <div class="frag" id="fillimi-i-faqes">Fragrance</div>
      <ul class="nav-lista">
        <li><a href="Home.php">Home</a></li>
        <li><a href="Brands.html">Brands</a></li>
        <li><a href="Products.html">Products</a></li>
        <li><a href="About.html">About Us</a></li>
        <li><a href="Contact.html">Contact Us</a></li>
      </ul>
    </nav>
  </header>

  <main>
    <section class="hero">
      <div class="image-content">
      <img src="Images/h.jpg" alt="">
      <div class="hero-content">
      <h1>Fragrance</h1>
      <p>Welcome to the world of perfumes</p>
      </div>
    </div>
    </section>

    <section class="gallery">
      <h1>Fragrance</h1>
      <h2>Learn more about perfumes</h2>
      <p>Perfume notes based on your preferences</p>
      <div class="gallery-grid">
        <div class="gallery-item" style=" background-image: url('Images/elegant.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat ;">
          <img src="Images/elegant.jpg" alt="" style=" width: 85%; height: 250px; object-fit: cover; border-radius: 15px ; box-shadow: 5px 5px 15px rgb(255, 255, 255);">
          <h3>Elegant and Timeless:</h3>
          <p style=" color:rgb(255, 240, 252);font-weight: bold; text-shadow: 1px 2px 4px rgb(0, 0, 0);"> A perfume that blends white floral notes with fresh citrus, creating a sense of purity and sophistication. Perfect for special occasions or elegant events.</p>
        </div>
        <div class="gallery-item"  style=" background-image: url('Images/sweet.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat ;">
          <img src="Images/sweet.jpg" alt="" style=" width: 85%; height: 250px; object-fit: cover; border-radius: 15px ; box-shadow: 5px 5px 15px rgb(255, 255, 255);">
          <h3>Sweet and Warm:</h3>
          <p style=" color:rgb(255, 240, 252);font-weight: bold; text-shadow: 1px 2px 4px rgb(0, 0, 0);"> Featuring vanilla and amber wood, this fragrance brings a cozy, comforting vibe, ideal for evenings or the colder seasons.</p>
          </div>
        <div class="gallery-item" style=" background-image: url('Images/tropical.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat ;">
          <img src="Images/tropical.jpg" alt="" style=" width: 85%; height: 250px; object-fit: cover; border-radius: 15px ; box-shadow: 5px 5px 15px rgb(255, 255, 255);">
          <h3>Tropical Freshness:</h3>
          <p style=" color:rgb(255, 240, 252);font-weight: bold; text-shadow: 1px 2px 4px rgb(0, 0, 0);"> A lively mix of pineapple, coconut, and vanilla evokes the feeling of a tropical beach. Great for summer days or moments of relaxation.</p>
        </div>
        <div class="gallery-item" style=" background-image: url('Images/magnetic.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat ;">
          <img src="Images/magnetic.jpg" alt="" style=" width: 85%; height: 250px; object-fit: cover; border-radius: 15px ; box-shadow: 5px 5px 15px rgb(255, 255, 255);">
          <h3>Mysterious and Magnetic:</h3>
          <p style=" color:rgb(255, 240, 252);font-weight: bold; text-shadow: 1px 2px 4px rgb(0, 0, 0);"> With incense, sandalwood, and deep amber notes, this perfume offers a rich and alluring aroma that leaves a lasting impression.</p>
        </div>
      </div>
    </section>
  </main>
  <footer class="footer">
    <div><p>&copy; 2024 Fragrance. All Rights Reserved </p></div>
    <div>
        <h4>Socials</h4>
        <a href="https://www.instagram.com" style="color: black;" target="_blank"><img src="Images/ig.png" alt="" style="height: 30px; width: 30px;"></a>
        
       <a href="https://www.facebook.com" style="color: black;"  target="_blank"> <img src="Images/fb.png" alt="" style="height: 30px; width: 30px;"></a>
       
       <a href="https://www.x.com" style="color: black;"  target="_blank"><img src="Images/x.png" alt="" style="height: 30px; width: 30px;"></a>
    </div>

</footer>
</body>
</html>