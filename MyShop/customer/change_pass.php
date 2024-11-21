<form action="" method="post" style="text-align: center;">
    <table width="50%" style="margin: 0 auto; padding: 30px; border: 2px solid #007bff; border-radius: 10px;">
        <tr>
            <td colspan="2">
                <h2 style="font-size: 26px; color: #007bff; margin-bottom: 20px;">Change Your Password</h2>
            </td>
        </tr>
        <tr>
            <td style="text-align: right; padding: 10px;">
                <label for="old_pass" style="font-size: 20px; color: #333;">Current Password:</label>
            </td>
            <td>
                <input type="password" name="old_pass" id="old_pass" required style="font-size: 18px; padding: 12px; width: 100%; border: 2px solid #ccc; border-radius: 8px;">
            </td>
        </tr>
        <tr>
            <td style="text-align: right; padding: 10px;">
                <label for="new_pass" style="font-size: 20px; color: #333;">New Password:</label>
            </td>
            <td>
                <input type="password" name="new_pass" id="new_pass" required style="font-size: 18px; padding: 12px; width: 100%; border: 2px solid #ccc; border-radius: 8px;">
            </td>
        </tr>
        <tr>
            <td style="text-align: right; padding: 10px;">
                <label for="new_pass_again" style="font-size: 20px; color: #333;">Confirm New Password:</label>
            </td>
            <td>
                <input type="password" name="new_pass_again" id="new_pass_again" required style="font-size: 18px; padding: 12px; width: 100%; border: 2px solid #ccc; border-radius: 8px;">
            </td>
        </tr>
        <tr>
            <td colspan="2" style="padding: 30px;">
                <input type="submit" name="change_pass" value="Change Password" style="font-size: 22px; padding: 14px 28px; background-color: #007bff; color: #fff; border: none; border-radius: 8px; cursor: pointer;">
            </td>
        </tr>
    </table>
</form>



<?php


$c = $_SESSION['customer_email'];

if(isset($_POST['change_pass'])){
    $c = $_SESSION['customer_email'];
    $old_pass = $_POST['old_pass'];
    $new_pass = $_POST['new_pass'];
    $new_pass_again = $_POST['new_pass_again'];

    $get_real_pass = "SELECT * FROM customers WHERE customer_email='$c' AND customer_pass='$old_pass'";

    $run_real_pass = mysqli_query($con, $get_real_pass);

    $check_pass = mysqli_num_rows($run_real_pass);



    if($check_pass == 0){
        echo "<script>alert('Your current password is not correct!')</script>";
        exit();
    }
    if($new_pass != $new_pass_again){
        echo "<script>alert('New passwords do not match. Please try again.')</script>";
    }
    else{
        $update_pass = "UPDATE customers SET customer_pass='$new_pass' WHERE customer_email='$c'";
        $run_pass = mysqli_query($con, $update_pass);
        echo "<script>alert('Your password has been successfully updated')</script>";
        echo "<script>window.open('my_account.php', '_self')</script>";
    }
}
?>
