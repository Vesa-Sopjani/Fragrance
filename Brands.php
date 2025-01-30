<?php

include_once 'Database/databaseConnection.php';
include_once 'Repository/brandRepository.php';


$brandRepository = new BrandRepository();
$brands = $brandRepository->getAllBrands();  
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brands</title>
    <link rel="stylesheet" href="css/brands.css">
</head>
<body>
    <header>
        <nav>
            <div class="frag" id="fillimi-i-faqes">Fragrance</div>
          <ul class="nav-lista">
            <li><a href="Home.php">Home</a></li>
            <li><a href="Brands.php">Brands</a></li>
            <li><a href="Products.html">Products</a></li>
            <li><a href="About.html">About Us</a></li>
            <li><a href="Contact.php">Contact Us</a></li>
          </ul>
        </nav>
      </header>
      
    <div class="container">
        <div class="title-section">
            <h1>Popular Brands</h1>
            <p style="font-weight: bold;">Most popular brands with the best scent</p>
        </div>
    

        

        <div class="section">
            <h2>Explore the most captivating scents</h2>
            <div class="card-row">
                <div class="click-div" >
                <div class="card" onclick="document.getElementById('section2').scrollIntoView({ behavior: 'smooth' });" style="border-color: rgb(103, 20, 34);">
                    <h2 >Designer Brands</h2>
                    <p style="font-weight: bold;">Designer perfumes are crafted by fashion and luxury brands that are well-known for their broader influence in the fashion and beauty industries. These fragrances are typically designed to appeal to a wide audience, often combining universally loved scents with high-quality ingredients. Designer fragrances are celebrated for their versatility, making them ideal for everyday wear or special occasions. Iconic examples include Chanel, Versace, and Dior, offering scents that are elegant, accessible, and timeless.</p>
                </div>
                </div>
                <div class="click-div">
                <div class="card" onclick="document.getElementById('section3').scrollIntoView({ behavior: 'smooth' });" style="border-color: rgb(103, 20, 34);">
                    <h2 >Niche Brands</h2>
                    <p style="font-weight: bold;">Niche perfumes are the epitome of exclusivity and artistry in the fragrance world. Created by smaller, independent perfume houses, niche fragrances focus on unique, often using rare or unconventional ingredients. These scents are designed for individuals who seek something unique, distinct and personal, rather than mass appeal. Brands like Maison Francis Kurdijan, Xerjoff, and Kilian exemplify niche perfumery, offering luxurious, complex aromas that make bold, unforgettable statements.</p>
                </div>
                </div>
            </div>
        </div>

        <div class="section">
            <h2 id="section2">Designer perfumes</h2>
            <div class="card-row">
                <div class="card" style=" background-image: url('Images/perfume3.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat ;">
                    <h3 style="color:rgb(255, 255, 255); text-shadow: -2px 1px 2px rgb(240, 174, 221);">YSL</h3>
                    <a href="https://www.yslbeautyus.com/fragrance/?srsltid=AfmBOopKHi-VmPWqImRlIwq65cz_Y-YV9pPcKelUdwQrC4W6roQqPvI5" target="_blank" >  <img src="Images/perfume3.jpg" alt="" style=" width: 100%; height: 250px; object-fit: cover; border-radius: 15px ; box-shadow: 5px 5px 15px rgb(255, 255, 255);"></a> 
                    <p style=" color:rgb(255, 240, 252);text-shadow: 1px 2px 4px rgb(0, 0, 0);"> YSL perfumes are a bold statement of elegance and individuality, blending sensual and daring notes. Fragrances like Libre and Black Opium are celebrated for their modern, edgy appeal, embodying confidence and sophistication.</p>
                </div>
                <div class="card" style=" background-image: url('Images/herrera.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat ;">
                    <h3 style="color:rgb(255, 255, 255); text-shadow: -2px 1px 2px rgb(240, 174, 221);">Carolina Herrera</h3>
                    <a href="https://www.carolinaherrera.com/ww/en/c/fragrances" target="_blank">  <img src="Images/herrera.jpg" alt="" style=" width: 100%; height: 250px; object-fit: cover; border-radius: 15px ; box-shadow: 5px 5px 15px rgb(255, 255, 255);"></a>
                    <p style=" color:rgb(255, 240, 252); text-shadow: 1px 2px 4px rgb(0, 0, 0);">Known for its glamorous and dynamic scents, Carolina Herrera captures timeless elegance with perfumes like Good Girl, which perfectly balances sweet and seductive notes, offering a bold yet refined olfactory experience.</p>
                </div>
                <div class="card" style=" background-image: url('Images/versace.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat ;">
                    <h3 style="color:rgb(255, 255, 255); text-shadow: -2px 1px 2px rgb(240, 174, 221);">Versace</h3>
                    <a href="https://www.versace.com/al/en/fragrances/" target="_blank"> <img src="Images/versace.jpg" alt="" style=" width: 100%; height: 250px; object-fit: cover; border-radius: 15px ; box-shadow: 5px 5px 15px rgb(255, 255, 255);"></a>
                    <p style=" color:rgb(255, 240, 252); text-shadow: 1px 2px 4px rgb(0, 0, 0);">Versace fragrances embody Italian luxury and bold sophistication. From the fresh elegance of 'Bright Crystal' to the powerful allure of 'Eros,' each scent reflects confidence, glamour, and modern sensuality.</p>
                </div>
                <div class="card" style=" background-image: url('Images/tomford'); background-size: cover; background-position: center; background-repeat: no-repeat ;">
                    <h3 style="color:rgb(255, 255, 255);text-shadow: -2px 1px 2px rgb(240, 174, 221);">Tom Ford</h3>
                    <a href="https://www.tomfordbeauty.com/products/fragrance" target="_blank"> <img src="Images/tomford" alt="" style=" width: 100%; height: auto; object-fit: cover; border-radius: 15px ; box-shadow: 5px 5px 15px rgb(255, 255, 255);"></a>
                    <p style=" color:rgb(255, 240, 252); text-shadow: 1px 2px 4px rgb(0, 0, 0);">Tom Ford fragrances embody luxury and sophistication, crafted with precision and rare ingredients. From the bold allure of 'Black Orchid' to the refined warmth of 'Oud Wood,' each scent exudes elegance, confidence, and individuality, making a lasting impression.</p>
                </div>
            </div>
        </div>
            <div class="card-row">
                <div class="card" style=" background-image: url('Images/jpg1.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat ;">
                    <h3 style="color:rgb(255, 255, 255); text-shadow: -2px 1px 2px rgb(240, 174, 221);">Jean Paul Gaultier</h3>
                    <a href="https://www.jeanpaulgaultier.com/ww/en/fragrances?srsltid=AfmBOopvreaMWOAz5TCzTDZi-GlaJbdyc5j8skiYUsk1RGZLJoIQ2ByS" target="_blank"> <img src="Images/jpg1.jpg" alt="" style=" width: 100%; height: auto; object-fit: cover; border-radius: 15px ; box-shadow: 5px 5px 15px rgb(255, 255, 255);"></a>
                    <p style=" color:rgb(255, 240, 252); text-shadow: 1px 2px 4px rgb(0, 0, 0);">Jean Paul Gaultier perfumes are bold and iconic, blending unforgettable scents with striking designs.From the sensual florals of Classique to the masculine freshness of Le Male, each fragrance embodies individuality and timeless elegance.</p>
                </div>
                <div class="card" style=" background-image: url('Images/diorperfumes.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat ;">
                    <h3 style="color:rgb(255, 255, 255); text-shadow: -2px 1px 2px rgb(240, 174, 221);">Dior</h3>
                    <a href="https://www.dior.com/en_int/beauty/fragrance/fragrance-homepage.html" target="_blank"> <img src="Images/diorperfumes.jpg" alt=""  style=" width: 100%; height: auto; object-fit: cover; border-radius: 15px ; box-shadow: 5px 5px 15px rgb(255, 255, 255); "></a>
                     <p  style=" color:rgb(255, 240, 252); text-shadow: 1px 2px 4px rgb(0, 0, 0);">Dior perfumes are synonymous with luxury, elegance, and sophistication. Carefully crafted with creativity and precision, they feature rich fragrances that blend classic and modern notes, appealing to a wide range of tastes. From the freshness of J'adore to the intensity of Sauvage, each Dior perfume embodies exceptional craftsmanship and tells a unique story, offering an unforgettable aromatic experience.</p>
                </div>
                <div class="card" style=" background-image: url('Images/chanel1'); background-size: cover; background-position: center; background-repeat: no-repeat ;">
                    <h3 style="color:rgb(255, 255, 255); text-shadow: -2px 1px 2px rgb(240, 174, 221);">Chanel</h3>
                    <a href="https://www.chanel.com/us/fragrance/" target="_blank"> <img src="Images/chanel1" alt="" style="width: 100%; height: auto; object-fit: cover; border-radius: 15px ; box-shadow: 5px 5px 15px rgb(255, 255, 255); "></a>
                    <p style=" color:rgb(255, 240, 252); text-shadow: 1px 2px 4px rgb(0, 0, 0);">Chanel perfumes epitomize luxury and sophistication, with iconic creations like No. 5 and Coco Mademoiselle. These timeless fragrances blend classic elegance with a modern twist, making them a symbol of refined beauty.</p>
                </div>
                <div class="card" style=" background-image: url('Images/armanii.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat ;">
                    <h3 style="color:rgb(255, 255, 255); text-shadow: -2px 1px 2px rgb(240, 174, 221);">Armani</h3>
                    <a href="https://www.armani.com/en-us/giorgio-armani/fragrances/" target="_blank"> <img src="Images/armanii.jpg" alt="" style="width: 100%; height: auto; object-fit: cover; border-radius: 15px ; box-shadow: 5px 5px 15px rgb(255, 255, 255); "></a>
                    <p style=" color:rgb(255, 240, 252); text-shadow: 1px 2px 4px rgb(0, 0, 0);">Giorgio Armani perfumes are synonymous with understated luxury, combining simplicity and refinement. Scents like Acqua di Gio and Si offer a harmonious mix of freshness and warmth, reflecting effortless elegance and timeless appeal.</p>
                </div>
            </div>
            <div class="section">
                <h2 id="section3">Niche perfumes</h2>
                <div class="card-row">
                    <div class="card" style=" background-image: url('Images/maison.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat ;">
                        <h3 style="color:rgb(255, 255, 255); text-shadow: -2px 1px 2px rgb(240, 174, 221);">Maison Francis Kurkdjian</h3>
                        <a href="https://www.franciskurkdjian.com/int-en" target="_blank" >  <img src="Images/maison.jpg" alt="" style=" border-radius: 15px ; box-shadow: 5px 5px 15px rgb(255, 255, 255); "></a>
                        <p style=" color:rgb(255, 240, 252);text-shadow: 1px 2px 4px rgb(0, 0, 0);"> Founded by renowned perfumer Francis Kurkdjian, this luxury fragrance house is celebrated for its elegant and timeless creations. Known for its sophisticated blends, MFK crafts scents that exude refinement and long-lasting impact. Its iconic Baccarat Rouge 540 has become a global sensation, blending sweet, woody, and amber notes for an unmistakable signature.</p>
                    </div>
                    <div class="card" style=" background-image: url('Images/xerjoff.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat ;">
                        <h3 style="color:rgb(255, 255, 255); text-shadow: -2px 1px 2px rgb(240, 174, 221);">Xerjoff</h3>
                        <a href="https://www.xerjoff.com/" target="_blank">  <img src="Images/xerjoff.jpg" alt="" style=" border-radius: 15px ; box-shadow: 5px 5px 15px rgb(255, 255, 255); "></a>
                        <p style=" color:rgb(255, 240, 252); text-shadow: 2px 2px 4px rgb(0, 0, 0);">An Italian niche perfume house, Xerjoff is synonymous with opulence and artistry. Using rare ingredients and exquisite craftsmanship, the brand creates unique fragrances that leave a lasting impression. One of its standout scents, Naxos, combines honey, tobacco, and citrus for a warm and captivating experience that embodies Italian luxury.</p>
                    </div>
                    <div class="card" style=" background-image: url('Images/parfumsdemarly.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat ;">
                        <h3 style="color:rgb(255, 255, 255); text-shadow: -2px 1px 2px rgb(240, 174, 221);">Parfums de Marly</h3>
                        <a href="https://parfums-de-marly.com/" target="_blank"> <img src="Images/parfumsdemarly.jpg" alt="" style=" width: 100%; height: auto; object-fit: cover; border-radius: 15px ; box-shadow: 5px 5px 15px rgb(255, 255, 255); "></a>
                        <p style="color:rgb(255, 240, 252); text-shadow: 1px 2px 4px rgb(0, 0, 0);">Inspired by 18th-century French elegance and the royal passion for horses, Parfums de Marly brings classic sophistication to the modern world. Its fragrances, such as the beloved Layton, blend traditional notes like vanilla and spices with contemporary twists, resulting in refined and powerful scents.</p>
                    </div>
                    <div class="card" style=" background-image: url('Images/kilian2.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat ;">
                        <h3 style="color:rgb(255, 255, 255); text-shadow: -2px 1px 2px rgb(240, 174, 221);">Kilian</h3>
                        <a href="https://www.bykilian.com/" target="_blank"> <img src="Images/kilian2.jpg" alt="" style=" width: 90%; height: auto; object-fit: cover; border-radius: 15px ; box-shadow: 5px 5px 15px rgb(255, 255, 255); "></a>
                        <p style="color:rgb(255, 240, 252); text-shadow: 1px 2px 4px rgb(0, 0, 0);">Founded by Kilian Hennessy, this brand epitomizes modern luxury with a focus on storytelling and sustainability. Kilian perfumes are rich, sensual, and bold, often presented in refillable bottles that double as art pieces. Iconic creations like Black Phantom showcase dark and mysterious notes such as rum, chocolate, and coffee.</p>
                    
                    </div>
                </div>
            </div>
        
    </div>
    <div id="button-div">
    <button type="submit" id="jump-button" onclick="document.getElementById('fillimi-i-faqes').scrollIntoView({behavior: 'smooth'});" class="jump-button" >Jump back at Top</button>
    </div>
    <br>
    <footer class="footer">
        <div><p>&copy; 2024 Fragrance. All Rights Reserved </p></div>
        <div>
            <h4>Socials</h4>
            <a href="https://www.instagram.com" style="color: black;" target="_blank"><img src="Images/ig.png" alt="" style="height: 30px; width: 30px;"></a>
            
           <a href="https://www.facebook.com" style="color: black;"> <img src="Images/fb.png" alt="" style="height: 30px; width: 30px;"></a>
           
           <a href="https://www.x.com" style="color: black;"><img src="Images/x.png" alt="" style="height: 30px; width: 30px;"></a>
        </div>
        
    </footer>
    
</body>
</html>