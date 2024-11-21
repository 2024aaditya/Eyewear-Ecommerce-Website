<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert New Brand</title>
</head>
<body style="font-family: Arial, sans-serif; text-align: center; background-color: #f0f0f0; padding: 20px;">

    <form action="" method="post" style="max-width: 400px; margin: 0 auto; background-color: #fff; padding: 20px; border: 1px solid #ccc; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);">
        <h2 style="font-size: 24px; margin-bottom: 20px;">Insert New Brand</h2>
        <label for="brand_title" style="display: block; font-weight: bold; margin-bottom: 10px;">Brand Title:</label>
        <input type="text" name="brand_title" id="brand_title" style="width: 100%; padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 20px;" required>
        <input type="submit" name="insert_brand" value="Insert Brand" style="background-color: #007bff; color: #fff; font-size: 18px; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
    </form>

    <?php
    include("includes/db.php");

    if(isset($_POST['insert_brand'])){
        $brand_title = $_POST['brand_title'];

        $insert_brand = "INSERT INTO brands (brand_title) VALUES ('$brand_title')";
        $run_brand = mysqli_query($con, $insert_brand);

        if($run_brand){
            echo "<script>alert('New Brand Has been inserted')</script>";
            echo "<script>window.open('index.php?view_brands','_self')</script>";
        }
    }
    ?>
</body>
</html>

