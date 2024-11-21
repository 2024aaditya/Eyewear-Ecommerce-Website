<?php
session_start();
include("includes/db.php");
include("functions/functions.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyShop</title>
    <link rel="stylesheet" href="index.css" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>
    <div class="slideshow-container">
        <div class="mySlides fade">
            <img src="images/Thumb_Women_EYE.webp" style="width:100%">
        </div>
        <div class="mySlides fade">
            <img src="images/Thumbnail_Men_EYE.webp" style="width:100%">
        </div>
        <div class="mySlides fade">
            <img src="images/home.png" style="width:100%">
        </div>
    </div>
    <script src="js/home.js"></script>

    <div id="navbar">
        <ul id="menu">
            <li>
                <a href="index.php">
                    <span class="icon">&#127968;</span> Home
                </a>
            </li>
            <li>
                <a href="all_products.php">
                    <span class="icon">&#128083;</span> All products
                </a>
            </li>
            <li>
                <a href="customer/my_account.php">
                    <span class="icon">&#128101;</span> My Account
                </a>
            </li>
            <li>
                <a href="customer_register.php">
                    <span class="icon">&#128100;</span> Sign Up
                </a>
            </li>
            <li>
                <a href="cart.php">
                    <span class="icon">&#128722;</span> Shopping Cart
                </a>
            </li>
            <li>
                <a href="review.php">
                    <span class="icon">&#128073;</span> Review
                </a>
            </li>
            <li>
 
<li>
    <a href="admin_area/index.php">
        <span class="icon"><i class="fas fa-user-cog"></i></span> Admin Login
    </a>
</li>

</li>
        </ul>
        <div id="form">
            <form method="get" action="results.php" enctype="multipart/form-data">
                <input type="text" name="user_query" placeholder="Search Product">
                <input type="submit" name="search" value="Search">
            </form>
        </div>
        <li>
  
</li>
    </div>
    <div class="welcome-cart">
        <?php
        if (!isset($_SESSION['customer_email'])) {
            echo "<b class='welcome-text'>Welcome Guest</b> <b class='shopping-cart' style='color: green;'> Shopping Cart: </b>";
        } else {
            echo "<b class='welcome-text'>Welcome: <span class='customer-email'>" . $_SESSION['customer_email'] . "</span></b> <b class='shopping-cart' style='color: green;'> Shopping Cart: </b>";
        }
        ?>
    </div>
    <div class="cart-details">
        <span class="cart-items">Items: <?php echo items(); ?> Total Price: <?php echo total_price(); ?> </span>
        <button class="go-to-cart-button"><a href="cart.php">Go To Your Cart</a></button>
    </div>
    <div class="login-logout">
        <?php
        if (!isset($_SESSION['customer_email'])) {
            echo "<a class='login-link' href='checkout.php'>Login</a>";
        } else {
            echo "<a class='logout-link' href='logout.php'>Logout</a>";
        }
        ?>
    </div>
    <div class="content_wrapper">
        <div id="left_sidebar">
            <div id="sidebar_title">Category</div>
            <!-- Add a wrapper for the dropdown -->
            <div class="dropdown">
                <button class="dropbtn">Select Category</button>
                <ul id="cats" class="dropdown-content">
                    <?php getCats(); ?>
                </ul>
            </div>
        </div>
    </div>
    <div id="right_content">
        <?php cart(); ?>
    </div>
    <div id="products_box">
        <?php getPro();
        getCatPro();
        getBrandPro();
        ?>
    </div>
    <div class="video-container" style="position: relative; width: 100%;">
        <video id="myVideo" width="100%" height="auto" controls>
            <source src="images/EYEWEAR.mp4" type="video/mp4">
        </video>
        <div class="controls" style="position: absolute; bottom: 0; left: 0; width: 100%; background-color: rgba(0, 0, 0, 0.5); display: flex; justify-content: space-between; padding: 5px;">
            <button id="playPause" style="background-color: transparent; border: none; color: white;">Play/Pause</button>
            <input type="range" id="seekBar" value="0" style="background-color: transparent; border: none; color: white;">
            <button id="fullScreen" style="background-color: transparent; border: none; color: white;">Full Screen</button>
        </div>
    </div>
    <script src="js/homevideo.js"></script>
    <div class="brands-container" style="text-align: center; padding: 20px;">
        <img src="images/10.jpg" style="width:100%">
        <h2 style="color: #333; font-size: 28px;">Soon we are going to introduce some eyewear brands:</h2>
        <?php
        $eyewearBrands = array(
            'Nike' => array('url' => 'nike_page.php', 'icon' => '👓'),
            'Puma' => array('url' => 'puma_page.php', 'icon' => '👓'),
            'Lenscart' => array('url' => 'lenscart_page.php', 'icon' => '👓'),
            'Adidas' => array('url' => 'adidas_page.php', 'icon' => '👓'),
            'Prince' => array('url' => 'prince_page.php', 'icon' => '👓'),
        );
        function generateEyewearBrandsWithLinks($eyewearBrands) {
            foreach ($eyewearBrands as $brand => $info) {
                echo "<p style='margin: 10px;'>
                <a href='{$info['url']}' style='text-decoration: none; color: #0077b6; font-weight: bold; font-size: 24px; transition: color 0.3s;'>
                {$info['icon']} $brand</a></p>";
            }
        }
        generateEyewearBrandsWithLinks($eyewearBrands);
        ?>
    </div>
</div>
<?php getPro1();?>
<footer class="site-footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-section">
                <h3>About Us</h3>
                <p>A MILESTONE TO ENHANCE THE VISION OF THE WORLD</p>
            </div>
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">Products</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">FAQs</a></li>
                    <li><a href="#">Terms of Service</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Returns & Refunds</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Contact Us</h3>
                <p>Mumbai<br><br>Email: contact@example.com<br>Phone: 123456</p>
            </div>
            <div class="footer-section">
                <h3>Newsletter</h3>
                <p>Subscribe to our newsletter for updates and promotions.</p>
                <form>
                    <input type="email" placeholder="Your Email">
                    <button type="submit">Subscribe</button>
                </form>
            </div>
            <div class="footer-section">
                <h3>Recent Posts</h3>
                <ul>
                    <li><a href="#">Latest News</a></li>
                    <li><a href="#">Product Updates</a></li>
                    <li><a href="#">Tips & Tricks</a></li>
                </ul>
            </div>
            <div class="footer-section">
                <h3>Social Media</h3>
                <div class="social-icons">
                    <a href="#" class="social-icon"><i class="fab fa-facebook"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
                </div>
            </div>
        </div>
    </div>
</footer>

</body>
</html>
