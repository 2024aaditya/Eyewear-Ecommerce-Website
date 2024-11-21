<form action="" method="post" style="text-align: center;">
    <table style="margin: 0 auto; padding: 20px; border: 2px solid #ff0000; border-radius: 10px;">
        <tr>
            <td colspan="2">
                <h2 style="font-size: 24px; color: green; margin-bottom: 20px;">ARE YOU SURE YOU WANT TO DELETE YOUR ACCOUNT?</h2>
            </td>
        </tr>
        <tr>
            <td>
                <input type="submit" name="yes" value="YES, I WANT TO DELETE" style="font-size: 20px; padding: 10px 20px; background-color: #ff0000; color: #fff; border: none; border-radius: 8px; cursor: pointer;">
            </td>
            <td>
                <input type="submit" name="no" value="NO, I DON'T WANT TO DELETE" style="font-size: 20px; padding: 10px 20px; background-color: #007bff; color: #fff; border: none; border-radius: 8px; cursor: pointer;">
            </td>
        </tr>
    </table>
</form>

<?php

$c = $_SESSION['customer_email'];

if (isset($_POST['yes'])) {
    $delete_customer = "DELETE FROM customers WHERE customer_email='$c'";
    $run_delete = mysqli_query($con, $delete_customer);

    if ($run_delete) {
        session_destroy();
        echo "<script>alert('Your Account has been deleted, GOOD BYE')</script>";
        echo "<script>window.open('../index.php', '_self')</script>";
    }
}

if (isset($_POST['no'])) {
    echo "<script>window.open('my_account.php', '_self')</script>";
}
?>
