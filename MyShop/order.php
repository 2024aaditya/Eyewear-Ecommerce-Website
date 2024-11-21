<?php
include("includes/db.php");
include("functions/functions.php");


if (isset($_GET['c_id'])) {
    $customer_id = $_GET['c_id'];
}

$ip_add = getRealIpAddr();

$total = 0;


$sel_price = "SELECT * FROM cart WHERE ip_add='$ip_add'";
$run_price = mysqli_query($con, $sel_price);
$status = 'Pending';
$invoice_no = mt_rand();
$count_pro = mysqli_num_rows($run_price);
$total = 0; 

while ($record = mysqli_fetch_array($run_price)) {
    $pro_id = $record['p_id'];
    $pro_price_query = "SELECT product_price FROM products WHERE product_id='$pro_id'";
    $run_pro_price = mysqli_query($con, $pro_price_query);

   
    if ($p_price = mysqli_fetch_array($run_pro_price)) {
        $product_price = $p_price['product_price'];
        $total += $product_price; 
    }
}

$get_cart = "select * from cart where ip_add='$ip'";
$run_cart = mysqli_query($con, $get_cart);
$get_qty = mysqli_fetch_array($run_cart);
$qty = $get_qty['qty']; //

if ($qty == 0) {
    $qty = 1;
    $sub_total = $total;
} 
else {
    $qty = $qty;
    $sub_total = $total * $qty;
}

$insert_order = "INSERT INTO customer_orders (customer_id, due_amount, invoice_no, total_products, order_date, order_status) VALUES ('$customer_id', '$sub_total', '$invoice_no', '$count_pro', NOW(), '$status')";
$run_order = mysqli_query($con, $insert_order);

 
    echo "<script>alert('Successfully order submitted, Thank you!')</script>";
    echo "<script>window.open('customer/my_account.php','_self')</script>";
    
   
    $insert_to_pending_orders = "INSERT INTO pending_orders (customer_id, invoice_no, product_id, qty, order_status) VALUES ('$customer_id', '$invoice_no', '$pro_id', '$qty', '$status')";
    $run_pending_order = mysqli_query($con, $insert_to_pending_orders);

    $empty_cart = "DELETE FROM cart WHERE ip_add='$ip_add'";
    $run_empty = mysqli_query($con, $empty_cart);
    
   ?>
