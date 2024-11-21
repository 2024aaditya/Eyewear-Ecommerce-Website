<link rel="stylesheet" href="styles/style.css" media="all" />
<?php
include("includes/db.php");
if (isset($_GET['edit_pro'])) {
    $edit_id = $_GET['edit_pro'];
    $get_edit = "SELECT * FROM products WHERE product_id='$edit_id'";
    $run_edit = mysqli_query($con, $get_edit);

    $row_edit = mysqli_fetch_array($run_edit);

    $update_id = $row_edit['product_id'];

    $p_title = $row_edit['product_title'];
    $cat_id = $row_edit['cat_id'];
    $brand_id = $row_edit['brand_id'];
    $p_image1 = $row_edit['product_img1'];
    $p_image2 = $row_edit['product_img2'];
    $p_image3 = $row_edit['product_img3'];
    $p_price = $row_edit['product_price'];
    $p_desc = $row_edit['product_desc'];
    $p_keywords = $row_edit['product_keywords'];
}

$get_cat = "SELECT * FROM category WHERE cat_id='$cat_id'";
$run_cat = mysqli_query($con, $get_cat);
$cat_row = mysqli_fetch_array($run_cat);
$cat_edit_title = $cat_row['cat_title'];

$get_brand = "SELECT * FROM brands WHERE brand_id='$brand_id'";
$run_brand = mysqli_query($con, $get_brand);
$brand_row = mysqli_fetch_array($run_brand);
$brand_edit_title = $brand_row['brand_title'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update or Edit Products</title>
</head>
<body>
<form method="post" action="" enctype="multipart/form-data">
    <div style="display: flex; justify-content: center; align-items: center; height: 100vh;">
        <table border="2" cellspacing="10" cellpadding="10" style="width: 60%; max-width: 800px; margin: 0 auto;">
            <tr>
                <td colspan="2" style="background-color: #007bff; color: #fff; text-align: center;"><h2>Update or Edit Products</h2></td>
            </tr>
            <tr>
                <td align="right"><b>Product Title</b></td>
                <td><input type="text" name="product_title" size="60" style="font-size: 20px;" value="<?php echo $p_title; ?>" /></td>
            </tr>
            <tr>
                <td align="right"><b>Product Category</b></td>
                <td>
                    <select name="product_cat" style="width: 100%; font-size: 20px;">
                        <option value="<?php echo $cat_id; ?>"><?php echo $cat_edit_title; ?></option>
                        <?php
                        $get_cats = "SELECT * FROM category";
                        $run_cats = mysqli_query($con, $get_cats);

                        while ($row_cats = mysqli_fetch_array($run_cats)) {
                            $cat_id = $row_cats['cat_id'];
                            $cat_title = $row_cats['cat_title'];
                            echo "<option value='$cat_id'>$cat_title</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Product Brand</b></td>
                <td>
                    <select name="product_brand" style="width: 100%; font-size: 20px;">
                        <option value="<?php echo $brand_id; ?>"><?php echo $brand_edit_title; ?></option>
                        <?php
                        $get_brands = "SELECT * FROM brands";
                        $run_brands = mysqli_query($con, $get_brands);

                        while ($row_brands = mysqli_fetch_array($run_brands)) {
                            $brand_id = $row_brands['brand_id'];
                            $brand_title = $row_brands['brand_title'];
                            echo "<option value='$brand_id'>$brand_title</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td align="right"><b>Product Image 1</b></td>
                <td>
                    <input type="file" name="product_img1" style="font-size: 20px;" />
                    <img src="product_images/<?php echo $p_image1; ?>" width="100" height="100" alt="Product Image 1" />
                </td>
            </tr>
            <tr>
                <td align="right"><b>Product Image 2</b></td>
                <td>
                    <input type="file" name="product_img2" style="font-size: 20px;" />
                    <img src="product_images/<?php echo $p_image2; ?>" width="100" height="100" alt="Product Image 2" />
                </td>
            </tr>
            <tr>
                <td align="right"><b>Product Image 3</b></td>
                <td>
                    <input type="file" name="product_img3" style="font-size: 20px;" />
                    <img src="product_images/<?php echo $p_image3; ?>" width="100" height="100" alt="Product Image 3" />
                </td>
            </tr>
            <tr>
                <td align="right"><b>Product Price</b></td>
                <td><input type="text" name="product_price" value="<?php echo $p_price; ?>" style="font-size: 20px;" /></td>
            </tr>
            <tr>
                <td align="right"><b>Product Description</b></td>
                <td><textarea name="product_desc" cols="50" rows="10" style="font-size: 20px;"><?php echo $p_desc; ?></textarea></td>
            </tr>
            <tr>
                <td align="right"><b>Product Keywords</b></td>
                <td><input type="text" name="product_keywords" size="60" style="font-size: 20px;" value="<?php echo $p_keywords; ?>" /></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" name="update_product" value="Update Product" style="font-size: 24px; padding: 10px 20px; background-color: #007bff; color: #fff;" /></td>
            </tr>
        </table>
    </div>
</form>
</body>
</html>
<?php

if (isset($_POST['update_product'])) {
    $product_title = $_POST['product_title'];
    $product_cat = $_POST['product_cat'];
    $product_brand = $_POST['product_brand'];
    $product_price = $_POST['product_price'];
    $product_desc = $_POST['product_desc'];
    $status = 'on';
    $product_keywords = $_POST['product_keywords'];

    $product_img1 = $_FILES['product_img1']['name'];
    $product_img2 = $_FILES['product_img2']['name'];
    $product_img3 = $_FILES['product_img3']['name'];

    $temp_name1 = $_FILES['product_img1']['tmp_name'];
    $temp_name2 = $_FILES['product_img2']['tmp_name'];
    $temp_name3 = $_FILES['product_img3']['tmp_name'];

    if ($product_title == '' || $product_cat == '' || $product_brand == '' || $product_price == '' || $product_desc == '' || $product_keywords == '' || $product_img1 == '' ) {
        echo "<script>alert('Please fill in all the required details!')</script>";
        exit();
    } else {
        move_uploaded_file($temp_name1, "product_images/$product_img1");
        move_uploaded_file($temp_name2, "product_images/$product_img2");
        move_uploaded_file($temp_name3, "product_images/$product_img3");

        $update_product = "UPDATE products SET cat_id='$product_cat', brand_id='$product_brand', date=NOW(), product_title='$product_title', product_img1='$product_img1', product_img2='$product_img2', product_img3='$product_img3', product_price='$product_price', product_desc='$product_desc', product_keywords='$product_keywords' 
        where product_id='$update_id'";
        $run_update = mysqli_query($con, $update_product);

        if ($run_update) {
            echo "<script>alert('Product updated successfully')</script>";
            echo "<script>window.open('index.php?view_products','_self')</script>";
        }
    }
}


?>