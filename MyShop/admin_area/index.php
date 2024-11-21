<?php
session_start();
if (!isset($_SESSION['admin_email'])) {
    echo "<script>window.open('login.php','_self')</script>";
} else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="admin.css" media="all" />
</head>
<body>
<div class="top">
    <img src="image.jpg" alt="Admin Logo">
</div>
<div class="container">
    <div class="left">
    <h2>Manage Your Content</h2>
 <a>Activities</a>
            <ul class="act">
                <li><a href="index.php?view_products">View All Products</a></li>
                <li><a href="index.php?insert_cat">Insert New Category</a></li>
                <li><a href="index.php?view_cats">View All Categories</a></li>
                <li><a href="index.php?insert_brand">Insert New Brands</a></li>
                <li><a href="index.php?view_brands">View All Brands</a></li>
                <li><a href="index.php?view_customers">View Customers</a></li>
                <li><a href="index.php?view_orders">View Orders</a></li>
                <li><a href="index.php?view_payments">View Payments</a></li>
                <li><a href="logout.php">Admin Logout</a></li>
            </ul>
        </li>
    </ul>
</div>




        <h2 style="color:green; text-align: center;"><?php echo @$_GET['logged_in'];?></h2>

            <?php
            include("includes/db.php");
            if(isset($_GET['insert_product'])){
                include("insert_product.php");
            }
            if(isset($_GET['view_products'])){
                include("view_products.php");
            }
            if(isset($_GET['edit_pro'])){
                include("edit_pro.php");
            }
            if(isset($_GET['view_cats'])){
                include("view_cats.php");
            }
          
            if(isset($_GET['edit_cat'])){
                include("edit_cat.php");
            }
            if(isset($_GET['insert_cat'])){
                include("insert_cat.php");
            }
            if(isset($_GET['delete_cat'])){
                include("delete_cat.php");
            }
            if(isset($_GET['insert_brand'])){
                include("insert_brand.php");
            }
            
            if(isset($_GET['view_brands'])){
                include("view_brands.php");
            }
            if(isset($_GET['edit_brand'])){
                include("edit_brand.php");
            }
            if(isset($_GET['view_customers'])){
                include("view_customers.php");
            }
            if(isset($_GET['view_orders'])){
                include("view_orders.php");
            }
            if(isset($_GET['view_payments'])){
                include("view_payments.php");
            }
            ?>
        </div>
    </div>
</body>
</html>
<?php }?>

