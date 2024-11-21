<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="cat.css" media="all" />
</head>
<body>
    <table width="auto" align="center">
        <tr>
            <td><h2>View All Category</h2></td>
        </tr>
        <tr>
    <th>Category Id</th>
    <th>Category Title</th>
    <th>Delete <i class="fas fa-trash-alt"></i></th>
    <th>Edit <i class="fas fa-edit"></i></th>
</tr>

    <?php
    include("includes/db.php");

    $get_cats = "select * from category";
    $run_cats = mysqli_query($con ,$get_cats);
    while($row_cats=mysqli_fetch_array($run_cats)){

        $cat_id = $row_cats['cat_id'];
        $cat_title = $row_cats['cat_title'];

    
    ?>
    <tr>
        <td><?php echo $cat_id;?></td>
        <td><?php echo $cat_title; ?></td>
        <td><a href="index.php?edit_cat=<?php echo $cat_id; ?>">Edit</a></td>
        <td><a href="index.php?delete_cat=<?php echo $cat_id; ?>">Delete</a></td>
    </tr>

<?php } ?>


    </table>

</body>
</html>