<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="brand.css" media="all" />
</head>
<body>
    <table width="auto" align="center">
        <tr>
            <td><h2>View All Brands</h2></td>
        </tr>
    <tr>
        <th>Brand Id</th>
        <th>Brand Title</th>
        <th>Delete</th>
        <th>Edit</th>
    </tr>
    <?php
    include("includes/db.php");

    $get_brands = "select * from brands";
    $run_brands = mysqli_query($con ,$get_brands);
    while($row_brands=mysqli_fetch_array($run_brands)){

        $brand_id = $row_brands['brand_id'];
        $brand_title = $row_brands['brand_title'];

    
    ?>
    <tr>
        <td><?php echo $brand_id;?></td>
        <td><?php echo $brand_title; ?></td>
        <td><a href="index.php?edit_brand=<?php echo $brand_id; ?>">Edit</a></td>
        <td><a href="delete_brand.php?delete_brand=<?php echo $brand_id; ?>">Delete</a></td>
    </tr>

<?php } ?>


    </table>

</body>
</html>