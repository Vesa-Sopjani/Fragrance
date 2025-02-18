<?php
if (isset($_GET['success']) && $_GET['success'] == 'true') {
    echo "<p style='color:white; background-color:rgb(103, 20, 34)'>Message sent successfully!</p>";
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact Form</title>
    <link rel="stylesheet" href="css/contact.css" />
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
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
      <span class="big-circle"></span>
      
      <div class="form">
        <div class="contact-info">
          <h3 class="title">Let's get in touch</h3>
          <p class="text">
            If you have something to say to us , please feel free to write us here!!
            You are welcome anytime.
          </p>

          <div class="info">
            <div class="information">
              <img src="Images/location.png" class="icon" alt="" />
              <p>UBT College , Pristina 10000, Kosova</p>
            </div>
            <div class="information">
              <img src="Images/email.png" class="icon" alt="" />
              <p>ubt-uni.net</p>
            </div>
            <div class="information">
              <img src="Images/phone.png" class="icon" alt="" />
              <p>123-456-789</p>
            </div>
          </div>

          <div class="social-media">
            <p>Connect with us :</p>
            <div class="social-icons">
              <a href="https://www.facebook.com" style="color: black;"  target="_blank"> <img src="Images/facebook-svgrepo-com.svg" alt="" style="height: 30px; width: 30px;"></a>
                <i class="fab fa-facebook-f"></i>
              </a>
              <a href="https://x.com/?lang=en&mx=2" style="color: black;"  target="_blank"> <img src="Images/twitter-svgrepo-com.svg" alt="" style="height: 30px; width: 30px;"></a>
                <i class="fab fa-twitter"></i>
              </a>
              <a href="https://www.instagram.com/" style="color: black;"  target="_blank"> <img src="Images/instagram-svgrepo-com.svg" alt="" style="height: 30px; width: 30px;"></a>
                <i class="fab fa-instagram"></i>
              </a>
              <a href="https://www.linkedin.com/" style="color: black;"  target="_blank"> <img src="Images/linkedin-svgrepo-com.svg" alt="" style="height: 30px; width: 30px;"></a>
                <i class="fab fa-linkedin-in"></i>
              </a>
            </div>
          </div>
        </div>

        <div class="contact-form">
        <span class="circle one"></span>
        <span class="circle two"></span>

          <form action="View/contact_form.php" method="POST" autocomplete="off">
            <h3 class="title">Contact us</h3>
            <div class="input-container">
              <input type="text" name="name" class="input" />
              <label for="">Name</label>
              <span>Name</span>
            </div>
            <div class="input-container">
              <input type="email" name="email" class="input" />
              <label for="">Email</label>
              <span>Email</span>
            </div>
            <div class="input-container">
              <input type="tel" name="phone" class="input" />
              <label for="">Phone</label>
              <span>Phone</span>
            </div>
            <div class="input-container textarea">
              <textarea name="message" class="input"></textarea>
              <label for="">Message</label>
              <span>Message</span>
            </div>
            <input type="submit" value="Send" class="btn" />
          </form>
        </div>
      </div>
    </div>

    <script>
        const inputs = document.querySelectorAll(".input");

  function focusFunc() {
  let parent = this.parentNode;
  parent.classList.add("focus");
}

function blurFunc() {
  let parent = this.parentNode;
  if (this.value == "") {
    parent.classList.remove("focus");
  }
}

inputs.forEach((input) => {
  input.addEventListener("focus", focusFunc);
  input.addEventListener("blur", blurFunc);
});
    </script>

  </body>

</html>