<?php
include_once 'Database/databaseConnection.php';
$sql = "SELECT * FROM paragraphs";
$conn = DatabaseConnection::getInstance()->getConnection();
$result = $conn->prepare($sql);
$result->execute();


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8" />
    <title>About us</title>
    <link rel="stylesheet" href="css/About.css">
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
<div class="slider">
  <img id="slideshow" src="Images/mfk.jpg" alt="Slider Image">
  <button class="prev" onclick="moveSlide(-1)">&#10094;</button>
  <button class="next" onclick="moveSlide(1)">&#10095;</button>
</div>
<main>
    <section class="start">
      <h1>Welcome to Fragrance</h1>
      <h3>Our Mission</h3>
      <p>Our mission is to provide a deeper understanding of the art of perfumery and to make the world of fragrances accessible to all. We aim to educate our visitors about the complexity of perfumes, from their creation to their impact on our daily lives. Through detailed guides, expert insights, and an easy-to-navigate platform, we hope to inspire both newcomers and seasoned fragrance lovers to explore, appreciate, and find the perfect scent that resonates with them. Our goal is to foster a community that shares a passion for perfume and enhances the sensory experience it offers.</p>
    </section>
    <?php
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
    echo '<section class="start">';
    echo '<h1>' . $row['title'] . '</h1>';
    echo '<p>' . $row['content'] . '</p>';
    echo '</section>';
}
?>
    <div class="cont1">
        <div class="cont-text">
    <section class="people">
      <h3 style=" color:white; text-shadow:  0px 0px 6px rgba(255, 255, 255, 0.852) ;">Our Team</h3>
      <h1 style="color: rgb(164, 123, 123); text-shadow: 0 0 3px rgb(0, 0, 0);">Informing others about what we love</h1>
      <p>Our website is dedicated to providing comprehensive information about perfumes. Together, our two-person team has worked to design a user-friendly platform that highlights the rich world of fragrances. From understanding different perfume notes to learning about the history and artistry behind them, our site aims to educate visitors while sparking a deeper appreciation for the scents that define our everyday lives. Whether you're a fragrance enthusiast or just starting your journey, our goal is to make perfume more accessible and enjoyable for everyone.</p>
    </div>
      <div class="image">
        <img src="Images/sweet.jpg" alt="" style="width: 500px; height: auto; box-shadow: 2px 2px 15px rgba(0, 0, 0, 0.776); border-radius: 20px;">
        
      </div>
    </div>
    </section>
  </main>
  
    <div class="container">
     

    <h3 style="text-shadow: 2px 2px 6px rgb(0, 0, 0);">Team Members</h3>
     <div class="team">
        <br>
        <div class="team-member">
         <img src="Images/ubt.png" alt="Team Member 1">
         <p>Erina Tërnava</p>
        </div>
        <div class="team-member">
            <img src="Images/ubt.png" alt="Team Member 1">
            <p>Vesa Sopjani</p>
           </div>
     </div>
    </div>

    <footer>
        <p>&copy; 2024 Fragrance. All Rights Reserved </p>
    </footer>

    <script>
      var i = 0;
var imgArray = [
    "Images/jpg.jpg",
    "Images/d.jpg",
    "Images/k.jpg"
];

function moveSlide(direction) {
    i += direction;

    if (i < 0) {
        i = imgArray.length - 1;
    } else if (i >= imgArray.length) {
        i = 0;
    }

    document.getElementById('slideshow').src = imgArray[i];
}

setInterval(function() {
    moveSlide(1);  
}, 2600);

    </script>
</body>
</html>

