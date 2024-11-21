<?php
include("includes/db.php");
include("functions/functions.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyShop</title>
    <link rel="stylesheet" href="all_products.css" media="all"/>
</head>
<body>
    <!-- main wrapper-->
    <div class="main_wrapper">

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
         <!--navbar end-->

        <div id="right_content">
                    <b>Welcome Guest</b>
                    <b style="color: browm;"> Shopping Cart:
                    <span> Itmes - Price : </span>
            </div>
        </div>
        <div id="products_box">
            <?php 
                global $con; 
                if (!isset($_GET['cat'])){
                    if(!isset($_GET['brands'])){
                
                    $get_products = "select * from products";
            
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
                        <p><b>Price: RS $pro_price  </b></p>
                        
                        <a href='details.php?pro_id=$pro_id' style='float:left;'>Details</a>
                        <a href='all_products.php?add_cart=$pro_id'><button>Add to Cart</button></a>
                    </div>
                        ";
                    }
                }
            }
            ?>
        </div>


        </div>
    </div>



    </div>
    <!--main ends-->
</body>
</html>