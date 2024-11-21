<link rel="stylesheet" href="edit_account.css" media="all"/>
<?php
@session_start();

include("includes/db.php");


if(isset($_GET['edit_account'])){
    $customer_email = $_SESSION['customer_email']; 
    
    $get_customer = "SELECT * FROM customers WHERE customer_email='$customer_email'";

    $run_customer = mysqli_query($con, $get_customer); 
    $row = mysqli_fetch_array($run_customer);
    $id = $row['customer_id'];
    $name = $row['customer_name'];
    $email = $row['customer_email'];
    $pass = $row['customer_pass'];
    $country = $row['customer_country'];
    $city = $row['customer_city'];
    $contact = $row['customer_contact'];
    $address = $row['customer_address'];
    $image = $row['customer_image'];
}
?>
<form action="" method="post" enctype="multipart/form-data">
<div style="max-width: 800px; margin: 0 auto; padding: 30px; background-color: #f7f7f7; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); border-radius: 15px; text-align: center;">
    <h2 style="color: #333; font-size: 28px;">Update Your Account</h2>
    <form action="" method="post" enctype="multipart/form-data">
        <table align="center" style="width: 100%; border-collapse: collapse;">
            <tr>
                <td style="padding: 20px; text-align: right;"><b>Customer Name</b></td>
                <td><input type="text" name="c_name" value="<?php echo $name;?>" style="width: 100%; padding: 20px; font-size: 20px; border: 1px solid #ccc; border-radius: 10px;"></td>
            </tr>
            <tr>
                <td style="padding: 20px; text-align: right;"><b>Customer Email</b></td>
                <td><input type="text" name="c_email" value="<?php echo $email;?>" style="width: 100%; padding: 20px; font-size: 20px; border: 1px solid #ccc; border-radius: 10px;"></td>
            </tr>
            <tr>
                <td style="padding: 20px; text-align: right;"><b>Customer Password</b></td>
                <td><input type="password" name="c_pass" value="<?php echo $pass;?>" style="width: 100%; padding: 20px; font-size: 20px; border: 1px solid #ccc; border-radius: 10px;"></td>
            </tr>
            <tr>
                <td style="padding: 20px; text-align: right;"><b>Customer Country</b></td>
                <td>
                    <select name="c_country" style="width: 100%; padding: 20px; font-size: 20px; border: 1px solid #ccc; border-radius: 10px;">
                        <option>Select A Country</option>
                        <option>India</option>
                        <option>Dubai</option>
                        <option>America</option>
                        <option>Pakistan</option>
                        <option>US</option>
                        <option>UK</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td style="padding: 20px; text-align: right;"><b>Customer City</b></td>
                <td><input type="text" name="c_city" value="<?php echo $city;?>" style="width: 100%; padding: 20px; font-size: 20px; border: 1px solid #ccc; border-radius: 10px;"></td>
            </tr>
            <tr>
                <td style="padding: 20px; text-align: right;"><b>Customer Phone no:</b></td>
                <td><input type="text" name="c_phone" value="<?php echo $contact;?>" style="width: 100%; padding: 20px; font-size: 20px; border: 1px solid #ccc; border-radius: 10px;"></td>

            </tr>
            <tr>
                <td style="padding: 20px; text-align: right;"><b>Customer Address</b></td>
                <td><input type="text" name="c_address" value="<?php echo $address;?>" style="width: 100%; padding: 20px; font-size: 20px; border: 1px solid #ccc; border-radius: 10px;"></td>
            </tr>
            <tr>
                <td style="padding: 20px; text-align: right;"><b>Customer Image</b></td>
                <td><input type="file" name="c_image" style="padding: 20px; font-size: 20px;"></td>
            </tr>
            <td align="center" colspan="8"><input type="submit" name="update_account"value="Update"></td>
        </table>
    </form>
</div>

<?php
if(isset($_POST['update_account'])){
    $update_id = $id;
    $c_name = $_POST['c_name']; 
    $c_email = $_POST['c_email']; 
    $c_pass = $_POST['c_pass'];
    $c_country = $_POST['c_country'];
    $c_city = $_POST['c_city'];
    $c_contact = $_POST['c_phone'];

    $c_address = $_POST['c_address'];
    $c_image = $_FILES['c_image']['name']; 
    $c_image_tmp = $_FILES['c_image']['tmp_name'];

    $update_c = "UPDATE customers SET customer_name='$c_name', customer_email='$c_email', customer_pass='$c_pass', 
                 customer_country='$c_country', customer_city='$c_city', customer_contact='$c_contact', customer_address='$c_address',
                 customer_image='$c_image' WHERE customer_id='$update_id'";

    $run_c = mysqli_query($con, $update_c);

    if ($run_c) {
        move_uploaded_file($c_image_tmp, "customer/customer_images/$c_image");
        echo "<script>alert('Account updated successfully');</script>";
        echo "<script>window.open('my_account.php', '_self')</script>";
    } else {
        echo "<h2 style='text-align:center; color:red;'>Error updating account: " . mysqli_error($con) . "</h2>";
    }
}    
?>