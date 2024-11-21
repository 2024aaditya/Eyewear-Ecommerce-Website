<?php
session_start();
include("includes/db.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
<div class="login">
    <h1>Login</h1>
    <form method="post">
        <input type="text" name="admin_email" placeholder="Email" required="required" />
        <input type="password" name="admin_name" placeholder="Password" required="required" />
        <button type="submit" class="btn btn-primary btn-block btn-large" name="login">Let me in.</button>
    </form>
</div>
<h2 style="color: azure; text-align: center;"><?php echo @$_GET['logout'];?></h2>

</body>
</html>

<?php
if(isset($_POST['login'])){
    $user_email = $_POST['admin_email'];
    $user_pass = $_POST['admin_name'];

    $sel_admin = "SELECT * FROM admins WHERE admin_email='$user_email' AND admin_pass='$user_pass'";
    $run_admin = mysqli_query($con, $sel_admin);

    $check_admin = mysqli_num_rows($run_admin);

    if($check_admin==1){
        $_SESSION['admin_email'] = $user_email;
        echo "<script>window.open('index.php?logged_in=You have Successfully logged in','_self')</script>";
    } else {
        echo "<script>alert('Admin Email or Password is incorrect, try again')</script>";
    }
}
?>