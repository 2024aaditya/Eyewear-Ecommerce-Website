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
    <link rel="stylesheet" href="customer_register.css" media="all"/>
</head>
<body>

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
            <b>Welcome Guest</b>
<b style="color: black;"> Shopping Cart:
    <span> Items: <?php items(); ?> Total Price: <?php total_price(); ?>
        <button style="background-color: white;"><a href="cart.php" style="color: black;">Back To Shopping</a></button>

        <?php
        // Ensure that the session is started
        if (!isset($_SESSION['customer_email'])) {
            echo '<a href="checkout.php">Login</a>';
        } else {
            echo '<a href="logout.php">Logout</a>';
        }
        ?>
    </span>
    <b>
    <b>
    <form action="customer_register.php" method="post" enctype="multipart/form-data">

            <tr>
                <td colspan="2">
                    <h2>Create an Account</h2>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Customer Name</b></td>
                <td><input type="text" name="c_name" required></td>
            </tr>
            <tr>
                <td align="right"><b>Customer Email</b></td>
                <td><input type="text" name="c_email" required></td>
            </tr>
            <tr>
    <td align="right"><b>Customer Password</b></td>
    <td>
        <input type="password" name="c_pass" required 
               pattern="^(?=.*[A-Z])(?=.*\d).*$"
               title="Password must start with an uppercase letter and contain at least one number">
    </td>
</tr>

            <tr>
                <td align="right"><b>Customer City</b></td>
                <td>
                    <select name="c_country">
                        <option>Select Your State</option>
                        <option>Mumbai</option>
                        <option>Up</option>
                        <option>Kolkata</option>
                        <option>Assam</option>
                        <option>Madhya Pradesh</option>
                        <option>Jammu and Kashmir</option>
                    </select>
                </td>
            </tr>
            <td align="right"><b>Customer Mobile Number</b></td>
                <td>
                    <input type="text" name="c_contact" required 
                           pattern="[6789][0-9]{9}" 
                           title="Mobile number must start with 6, 7, 8, or 9 and be 10 digits long">
                </td>
            </tr>
                <td align="right"><b>Customer Address</b></td>
                <td><input type="text" name="c_address" required></td>
            </tr>
            <tr>
                <td align="right"><b>Customer Image</b></td>
                <td><input type="file" name="c_image" required></td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;">
                    <input type="submit" name="register" value="Submit">
                </td>
            </tr>

    </table>
</form>



</body>
</html>
<?php
if(isset($_POST['register'])){
    $c_name = $_POST['c_name']; 
    $c_email = $_POST['c_email']; 
    $c_pass = $_POST['c_pass'];
    $c_country = $_POST['c_country'];
    $c_city = $_POST['c_city'];
    $c_contact = $_POST['c_contact'];
    $c_address = $_POST['c_address'];
    $c_image = $_FILES['c_image']['name']; 
    $c_image_tmp = $_FILES['c_image']['tmp_name']; 

    $c_ip = getRealIpAddr();

    $insert_customer = "INSERT INTO customers (customer_name, customer_email, customer_pass, customer_country, customer_city, customer_contact, customer_address, customer_image, customer_ip) VALUES ('$c_name', '$c_email', '$c_pass', '$c_country', '$c_city', '$c_contact', '$c_address', '$c_image', '$c_ip')";

    $run_customer = mysqli_query($con, $insert_customer);

    move_uploaded_file($c_image_tmp, "customer/customer_photos/$c_image"); 
    $sel_cart = "SELECT * FROM cart WHERE ip_add='$c_ip'";
    $run_cart = mysqli_query($con, $sel_cart);
    $check_cart = mysqli_num_rows($run_cart);

    if($check_cart>0){
        $_SESSION['customer_email'] = $c_email;
        echo "<script>window.open('index.php', '_self')</script>";
        echo "<script>alert('Account created successfully, Thank You!')</script>";

        echo "<script>window.open('checkout.php', '_self')</script>";
    }
    else{
        echo "<script>alert('Account created successfully, Thank You!')</script>";
        echo "<script>window.open('index.php', '_self')</script>";
    }
}
?>