<?php
if(!isset($_SESSION['admin_email'])){
    echo "<script>window.open('login.php','_self')</script>";
}
else{

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link rel="stylesheet" href="product.css" media="all" />
</head>
<body>
    <?php
    if(isset($_GET['view_products'])){
    ?>
    <table>
        <tr align="center">
        <td colspan="8"><h2 style="font-size: 80px;">View All Products</h2></td>

        </tr>
        <tr>
    <th>Product No &#128196;</th>
    <th>Title &#127912;</th>
    <th>Image &#128247;</th>
    <th>Price &#128176;</th>
    <th>Total Sold &#128202;</th>
    <th>Status &#128202;</th>
    <th>Edit &#9998;</th>
    <th>Delete &#128465;</th>
</tr>


       <?php
       include("includes/db.php");

       $i=0;

       $get_pro = "select * from products";

       $run_pro = mysqli_query($con , $get_pro);

       while($row_pro=mysqli_fetch_array($run_pro)){
       $p_id = $row_pro['product_id'];
       $p_title = $row_pro['product_title'];
       $p_img = $row_pro['product_img1'];
       $p_price = $row_pro['product_price'];
  
       $i++;
       ?>

        <tr>
            <td><?php echo $i; ?></td>
            <td><?php echo $p_title; ?></td>
            <td><img src="product_images/<?php echo $p_img; ?>" width="50" height="50" ></td>
            <td><?php echo $p_price; ?></td>
            <td>
                <?php
                $get_sold = "select * from pending_orders where product_id='$p_id'";
                $run_sold = mysqli_query($con,$get_sold);
                $count = mysqli_num_rows($run_sold);
                echo $count;
                ?>
            </td>
            <td>
                <?php
                $get_status = "select * from products where product_id='$p_id'";
                $run_status = mysqli_query($con,$get_status);
                $row_status = mysqli_fetch_array($run_status);
                $p_status = $row_status['status'];
                echo $p_status;
                ?>
            </td>
  
            <td><a href="index.php?edit_pro=<?php echo $p_id; ?>">Edit</a></td>
            <td><a href="delete_pro.php?delete_pro=<?php echo $p_id;?>">Delete</a></td>
        </tr>

        <?php } ?>
    </table>
    <?php   } ?>
</body>
</html>
<?php }?>