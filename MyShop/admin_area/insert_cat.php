<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="cat.css" media="all" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert New Category</title>
</head>
<body style="font-family: Arial, sans-serif; text-align: center; background-color: #f0f0f0; padding: 20px;">

    <form action="" method="post" style="max-width: 400px; margin: 0 auto; background-color: #fff; padding: 20px; border: 1px solid #ccc; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);">
        <h2 style="font-size: 24px; margin-bottom: 20px;">Insert New Category</h2>
        <label for="cat_title" style="display: block; font-weight: bold; margin-bottom: 10px;">Category Title:</label>
        <input type="text" name="cat_title" id="cat_title" style="width: 100%; padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 20px;" required>
        <input type="submit" name="insert_cat" value="Insert Category" style="background-color: #007bff; color: #fff; font-size: 18px; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
    </form>

    <?php
    include("includes/db.php");

    if(isset($_POST['insert_cat'])){
        $cat_title = $_POST['cat_title'];

        // Corrected SQL query
        $insert_cat = "INSERT INTO category (cat_title) VALUES ('$cat_title')";
        $run_cat = mysqli_query($con, $insert_cat);

        if($run_cat){
            echo "<script>alert('New Category Has been inserted')</script>";
            echo "<script>window.open('index.php?view_cats','_self')</script>";
        }
    }
    ?>
</body>
</html>

