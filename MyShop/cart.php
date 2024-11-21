<?php
session_start()
;
include("includes/db.php");
include("functions/functions.php");

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyShop</title>
    <link rel="stylesheet" href="cart.css" media="all"/>
</head>
<body>

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

            <div id="form" >
            <form method="get" action="results.php" enctype="multipart/form-data">
        <input type="text" name="user_query" placeholder="Search Product" />
        <input type="submit" name="search" value="Search" />
    </form>
            </div>


        </div>

        <div id="user-cart-info">
    <?php
    if (!isset($_SESSION['customer_email'])) {
        echo "<span class='welcome-message'>Welcome Guest</span> <span class='cart-info'>Shopping Cart: </span>";
    } else {
        echo "<span class='welcome-message'>Welcome: <span class='user-name'>" . $_SESSION['customer_email'] . "</span></span> <span class='cart-info'>Shopping Cart: </span>";
    }

    // Assuming that items() and total_price() are functions defined elsewhere in your code.
    echo "<span class='cart-details'>Items: " .  items() . " Total Price: " . total_price() . "</span>";

    if (!isset($_SESSION['customer_email'])) {
        echo "<a href='checkout.php' class='login-button'>Login</a>";
    } else {
        echo "<a href='logout.php' class='login-button'>Logout</a>";
    }
    ?>
    <a href='cart.php' class='cart-button'>Go To Your Cart</a>
</div>

    </span>
</b>

       
     
                </button></span>
            </div>
        </div>
        </div>
            <form action="cart.php" method="post" enctype="multipart/form-data">
                <table width="700" align="left">
                    <tr align="left">
                        <td><b>Remove</b></td>
                        <td><b>Product</b></td>
                        <td><b>Quantity</b></td>
                        <td><b>Total Price</b></td>
                    </tr>
                    <?php
                    $ip_add = getRealIpAddr();
                    global $con;
                    $total = 0;

                    $sel_price = "SELECT * FROM cart WHERE ip_add='$ip_add'";
                    $run_price = mysqli_query($con, $sel_price);

                    while ($record = mysqli_fetch_array($run_price)) {
                        $pro_id = $record['p_id'];
                        $pro_price_query = "SELECT product_price, product_title, product_img1 FROM products WHERE product_id='$pro_id'";
                        $run_pro_price = mysqli_query($con, $pro_price_query);

                        if ($pro_price_record = mysqli_fetch_array($run_pro_price)) {
                            $product_price = $pro_price_record['product_price'];
                            $product_title = $pro_price_record['product_title'];
                            $product_image = $pro_price_record['product_img1'];
                            $total += $product_price;
                        }
                    ?>
                    <tr>
                        <td><input type="checkbox" name="remove[]" value="<?php echo $pro_id; ?>"></td>
                        <td><?php echo $product_title; ?><br><img src="admin_area/product_images/<?php echo $product_image; ?>" width="100" height="60"></td>
                        <td><input type="text" name="qty[<?php echo $pro_id; ?>]" value="1"></td>
                        <?php
                        if(isset($_POST['update'])) {
                            $qty = $_POST['qty'][$pro_id]; 
                            $qty = intval($qty); // Convert to an integer
                            if($qty < 0) {
                            
                                $qty = 0;
                            }
                            $insert_qty = "UPDATE cart SET qty='$qty' WHERE p_id='$pro_id'";
                            $run_qty  = mysqli_query($con, $insert_qty);
                            $total = $total * $qty; // Fix the missing semicolon here
                        }
                        ?>
                        <td><?php echo "RS " . $product_price; ?></td>
                    </tr>
                    <?php
                    }
                   ?>


                    <tr>
                        <td colspan="2"><b>Total Price: RS <?php echo $total; ?></b><b>THANKS FOR YOUR ORDER</b></td>
                        
                    </tr>
                    <tr>
                        <td><input type="submit" name="update" value="Update Cart"></td>
                        <td><input type="submit" name="continue" value="Continue Shopping"></td>
                        <td><button><a href="checkout.php">Checkout</a></button></td>
                    </tr>
                </table>
            </form>
        </div>

        <?php
        if(isset($_POST['update'])) {
            if(isset($_POST['remove'])) {
                foreach($_POST['remove'] as $remove_id) {
                    // Use prepared statements to prevent SQL injection
                    $delete_products = "DELETE FROM cart WHERE p_id = ?";
                    $stmt = mysqli_prepare($con, $delete_products);
                    mysqli_stmt_bind_param($stmt, "s", $remove_id);
                    $run_delete = mysqli_stmt_execute($stmt);

                    if($run_delete) {
                        echo "<script>window.open('cart.php','_self')</script>";
                    }
                }
            }
            
            foreach($_POST['qty'] as $pro_id => $qty) {
                
                $qty = intval($qty); // Convert to an integer
                if($qty < 0) {
                    
                    $qty = 0;
                }

                // Use prepared statements to update the quantity
                $update_qty = "UPDATE cart SET qty = ? WHERE p_id = ?";
                $stmt = mysqli_prepare($con, $update_qty);
                mysqli_stmt_bind_param($stmt, "ss", $qty, $pro_id);
                $run_update = mysqli_stmt_execute($stmt);

                if(!$run_update) {
                    echo "Error updating quantity: " . mysqli_error($con);
                }
            }
        } 



if(isset($_POST['continue'])){
    echo "<script>window.open('index.php','_self')</script>";
}
?>

</body>
</html>

