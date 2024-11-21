<?php
include("includes/db.php");
include("functions/functions.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details - MyShop</title>
    <link rel="stylesheet" href="details.css" media="all"/>
</head>
<body>
    <header>
        <!-- Navbar -->
        <nav>
            <ul>
                <li><a href="index.php">Home</a></li>
                <li><a href="all_products.php">All Products</a></li>
                <li><a href="my_account.php">My Account</a></li>
            </ul>
        </nav>
    </header>
    
    <main>
        <div class="product-details">
            <?php 
            if (isset($_GET['pro_id'])) {
                $product_id = $_GET['pro_id'];
                $get_product_query = "SELECT * FROM products WHERE product_id = $product_id";
                $run_product = mysqli_query($con, $get_product_query);

                if ($row_product = mysqli_fetch_array($run_product)) {
                    $pro_title = $row_product['product_title'];
                    $pro_desc = $row_product['product_desc'];
                    $pro_price = $row_product['product_price'];
                    $pro_image1 = $row_product['product_img1'];
                    $pro_image2 = $row_product['product_img2'];
                    $pro_image3 = $row_product['product_img3'];

                    $formatted_price = "RS " . number_format($pro_price, 2);

                    // Remove question marks from the description
                    $pro_desc_cleaned = str_replace('?', '', $pro_desc);

                    echo "
                    <h1>$pro_title</h1>
                    <div class='product-images'>
                        <img src='admin_area/product_images/$pro_image1' alt='$pro_title' class='product-image'>
                        <img src='admin_area/product_images/$pro_image2' alt '$pro_title' class='product-image'>
                        <img src='admin_area/product_images/$pro_image3' alt '$pro_title' class='product-image'>
                    </div>
                    <p class='price'><b>Price:</b> $formatted_price</p>
                    <div class='description'>
                        <p><b>Description:</b></p>
                        <p>$pro_desc_cleaned</p>
                    </div>
                    <a href='index.php' class='btn'>Go Back</a>
                    <a href='index.php?add_cart=$product_id' class='btn'>Add to Cart</a>
                    ";
                } else {
                    echo "Product not found.";
                }
            }
            ?>
        </div>
    </main>
    
</body>
</html>
