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
    <link rel="stylesheet" href="my_account.css" media="all"/>
</head>
<body>
    <!-- main wrapper-->
    <div class="main_wrapper">
    </div>
    </div>
    <!--navbar-->
        <div id="navbar">
            <ul id="menu">
                <li><a href="../index.php">Home</a></li>
                <li><a href="../all_products.php">All products</a></li>
                <li><a href="customer/my_account.php">My Account</a></li>
                <?php
                if (isset($_SESSION['customer_email'])) {
            echo "<li><span style='display:none;'<a href='../customer_register.php'>Sign UP</a></li></span>" ;
                    }
                    else{
                        echo "<li><a href='../customer_register.php'>Sign UP</a></li>";
                    }
        ?>
        
                <li><a href="../cart.php">Shopping Cart</a></li>

              
            </ul>
    
            </div>


        </div>
       
        </div>
         </div>
         
        <div id="right_content">
            <?php cart(); ?>
            <?php
            if(isset($_SESSION['customer_email'])){
                echo "<b>Welcome"  . "</b>" . "<b style='color:green;'>" .  $_SESSION['customer_email'] . "</b>";
            }
            ?>
            <?php
            if (!isset($_SESSION['customer_email'])) {
    echo "<a href='checkout.php'>Login</a>";
} else {
    echo "<a href='logout.php'>Logout</a>";
}
?>
        </div>
         </div>
         
       
         <div id="content_wrapper">
        <div id="left_sidebar">
        <h2 style="color:black; padding: 20px; text-align: center; ">Manage Your Account</h2>
            <ul id="cats">
                <?php
              
                    $customer_session = $_SESSION['customer_email'];
                    $get_customer_pic = "SELECT * FROM customers WHERE customer_email='$customer_session'";
                    $run_customer = mysqli_query($con, $get_customer_pic);
                    $row_customer = mysqli_fetch_array($run_customer);
                    $customer_pic = $row_customer['customer_image'];
                    echo "<img src='customer_photos/$customer_pic' width='150' height='180'>";
                
                ?>
                <li><a href="my_account.php?my_orders">My Orders</a></li>
                <li><a href="my_account.php?edit_account">Edit Account</a></li>
                <li><a href="my_account.php?change_pass">Change Password</a></li>
                <li><a href="my_account.php?delete_account">Delete Account</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
            </span>
          
            <?php getDefault(); ?>
            <?php 
            if(isset($_GET['my_orders']))
            {
                include("my_orders.php");
            }
            
            if(isset($_GET['edit_account'])){
                include("edit_account.php");
            }
        
        if(isset($_GET['change_pass'])){
            include("change_pass.php");
        }
        if(isset($_GET['delete_account'])){
            include("delete_account.php");
        }

?>

    </div>

</body>
</html>