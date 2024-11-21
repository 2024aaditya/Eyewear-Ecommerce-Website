<?php
    include("includes/db.php");

    if(isset($_GET['edit_cat'])){


        $cat_id = $_GET['edit_cat'];
        $edit_cat = "SELECT * FROM category WHERE cat_id='$cat_id'";
        $run_edit = mysqli_query($con, $edit_cat);
        $row_edit = mysqli_fetch_array($run_edit);
        $cat_edit_id = $row_edit['cat_id'];
        $cat_title = $row_edit['cat_title'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit This Category</title>
</head>
<body style="font-family: Arial, sans-serif; text-align: center; background-color: #f0f0f0; padding: 20px;">
    <form action="" method="post" style="max-width: 400px; margin: 0 auto; background-color: #fff; padding: 20px; border: 1px solid #ccc; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);">
        <h2 style="font-size: 24px; margin-bottom: 20px;">Edit This Category</h2>
        <input type="text" name="cat_title1" value="<?php echo $cat_title;?>" style="width: 100%; padding: 10px; font-size: 16px; border: 1px solid #ccc; border-radius: 5px; margin-bottom: 20px;">
        <input type="submit" name="update_cat" value="Update Category" style="background-color: #007bff; color: #fff; font-size: 18px; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">
    </form>
</body>
</html>

<?php
    if(isset($_POST['update_cat'])){
        $cat_title123 = $_POST['cat_title1'];

        // Use $cat_id, not $cat_edit_id
        $update_cat = "UPDATE category SET cat_title='$cat_title123' WHERE cat_id='$cat_id'";

        $run_update = mysqli_query($con, $update_cat);

        if($run_update){
            echo "<script>alert('Category has been Updated')</script>";
            echo "<script>window.open('index.php?view_cats','_self')</script>";
        }
    }
?>
