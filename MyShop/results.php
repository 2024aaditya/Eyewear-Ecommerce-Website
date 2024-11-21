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
      
        <div id="products_box">
        <?php
    if(isset($_GET['search'])){    
        $user_keyword = $_GET['user_query'];
        $get_products = "SELECT * FROM products WHERE product_keywords LIKE '%$user_keyword%'";

        $run_products = mysqli_query($con, $get_products);
        while ($row_products = mysqli_fetch_array($run_products)) {
            $pro_id = $row_products['product_id'];
            $pro_title = $row_products['product_title'];
            $pro_cat = $row_products['cat_id'];
            $pro_brand = $row_products['brand_id'];
            $pro_desc = $row_products['product_desc'];
            $pro_price = $row_products['product_price'];
            $pro_image = $row_products['product_img1'];
            
            echo "
            <div id='single_product'>
                <h3>$pro_title</h3>
                <img src='admin_area/product_images/$pro_image' width='490' height='300'/><br>
                <p><b>Price: RS $pro_price</b></p>
                <a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
                <a href='index.php?add_cart=$pro_id'><button style='float:right;'>Add to Cart</button></a>
            </div>";
        }
    }
    ?>
        </div>


        </div>
    </div>

</body>
</html>