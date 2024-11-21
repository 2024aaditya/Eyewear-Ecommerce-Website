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
    <link rel="stylesheet" href="checkout.css" media="all"/>
</head>
<body>


    <!--header end-->

    <!--navbar-->
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

           
        </div>
       
        <div id="user-cart-info">
    <?php
    if (!isset($_SESSION['customer_email'])) {
        echo "<b>Welcome Guest</b><b class='cart-details'>Shopping Cart:</b>";
    } else {
        echo "<b>Welcome:<span class='user-name'>" . $_SESSION['customer_email'] . "</span><b class='cart-details'>Shopping Cart:</b>";
    }

    // Assuming that items() and total_price() are functions defined elsewhere in your code.
    echo "<span class='cart-details'>Items: " . items() . " Total Price: " . total_price() . "</span>";

    if (!isset($_SESSION['customer_email'])) {
        echo "<button><a href='checkout.php'>Login</a></button>";
    } else {
        echo "<a href='logout.php'>Logout</a>";
    }
    ?>
    <button><a href='cart.php'>Go To Your Cart</a></button>
</div>


    </span>
</b>
             <?php 
                     if(!isset($_SESSION['customer_email']))
                     {
                         include("customer/customer_login.php");
                     }
                         else{
                             include("payment_options.php");
                           
                         
                     }
 
                     ?>
     
                 </div>            
 
     </div>
           
        </div>


        </div>
    </div>




                     
</body>
</html>