<!DOCTYPE html>
<html>
    <head>
        <title>Payment Options</title>
        <link rel="stylesheet" href="payment_options.css">

    </head>
    <body>
<?php
include("includes/db.php");

?>
<div class="text-center">
    <h2>Payment Options For You</h2>
    <?php
        $ip = getRealIpAddr();

        $get_customer = "select * from customers where customer_ip='$ip'";
        $run_customer = mysqli_query($con, $get_customer);
        $customer = mysqli_fetch_array($run_customer);
        $customer_id = $customer['customer_id'];
    ?>

    <b><a href="order.php?c_id=<?php echo $customer_id; ?>" class="pay-offline-link">Proceed For Payment</a></b>
    <td><b><a href="checkout.php">Add More</a></b></td>
</div>
</body>
