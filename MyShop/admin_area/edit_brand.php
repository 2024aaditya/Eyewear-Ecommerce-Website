<?php
include("includes/db.php");

if(isset($_GET['edit_brand'])){
    $brand_id = $_GET['edit_brand'];
    $edit_brand = "SELECT * FROM brands WHERE brand_id='$brand_id'";
    $run_brand = mysqli_query($con, $edit_brand);
    $row_brand = mysqli_fetch_array($run_brand);
    $brand_edit_id = $row_brand['brand_id']; 
    $brand_title = $row_brand['brand_title']; 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit This Brand</title>
</head>
<body style="font-family: Arial, sans-serif; text-align: center; background-color: #f0f0f0; padding: 20px;">
    <form action="" method="post" style="max-width: 400px; margin: 0 auto; background-color: #fff; padding: 20px; border: 1px solid #ccc; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);">
        <h2 style="font-size: 24px; margin-bottom: 20px;">Edit This Brand</h2>
        <input type="text" name="brand_title1" value="<?php echo $brand_title;?>" style="width: 100%; padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 20px;">
        <input type="submit" name="update_brand" value="Update Brand" style="background-color: #007bff; color: #fff; font-size: 18px; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
    </form>
</body>
</html>

<?php
if(isset($_POST['update_brand'])){
    $brand_title123 = $_POST['brand_title1'];

    $update_brand = "UPDATE brands SET brand_title='$brand_title123' WHERE brand_id='$brand_id'";

    $run_update = mysqli_query($con, $update_brand);

    if($run_update){
        echo "<script>alert('Brand has been Updated')</script>";
        echo "<script>window.open('index.php?view_brands','_self')</script>";
    }
}
?>
