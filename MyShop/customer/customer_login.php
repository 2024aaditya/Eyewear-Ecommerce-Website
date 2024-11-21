<?php
@session_start();
include("includes/db.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="customer/customer_login.css" media="all"/>
</head>
<body>
    <div class="login-register-container">
        <h2>Login Or Register</h2>
        <form action="checkout.php" method="post">
            <div class="input-container">
                <label for="c_email"><b>Your Email</b></label><br>
                <input type="text" name="c_email" id="c_email" placeholder="Enter Your Email">
            </div>
            <div class="input-container">
                <label for="c_pass"><b>Your Password</b></label><br>
                <input type="password" name="c_pass" id="c_pass" placeholder="Enter Your Password">
                <a href="forgot_pass.php" class="forgot-password-link">Forgot My Password</a>
            </div>
            <input type="submit" name="c_login" value="Login" class="login-button">
            <h2><a href="customer_register.php" class="register-link"><b>New Register</b></a></h2>
        </form>
    </div>
    
    <script src="login.js"></script>
</body>
</html>

<?php
if(isset($_POST['c_login'])){
    $customer_email = $_POST['c_email'];
    $customer_pass = $_POST['c_pass'];

    $sel_customer = "select * from customers where customer_email='$customer_email' AND customer_pass='$customer_pass'";
      
    $run_customer = mysqli_query($con, $sel_customer);
    $check_customer = mysqli_num_rows($run_customer);
    $get_ip = getRealIpAddr();
    $sel_cart = "select * from cart where ip_add='$get_ip'";
    $run_cart = mysqli_query($con, $sel_cart);
    $check_cart = mysqli_num_rows($run_cart);
    if($check_customer==0){
        echo"<script>alert('password or email address is not correct please try again')</script>";
        exit();
    }
    if($check_customer==1 AND $check_cart==0){
        $_SESSION['customer_email']=$customer_email;
                echo "<script>window.open('customer/my_account.php','_self')</script>";
    }
    else{
        $_SESSION['customer_email']=$customer_email;
        echo"<script>alert('You have loged in now you can place order or Pay for your order')</script>";
        include("payment_options.php");
    }
   

}
?>