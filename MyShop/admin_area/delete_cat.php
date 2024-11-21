<?php
include("includes/db.php");

    if(isset($_GET['delete_cat'])){
        $delete_id = $_GET['delete_cat'];

        $delete_pro = "delete from category where cat_id='$delete_id'";

        $run_delete = mysqli_query($con , $delete_pro);

        if($run_delete){
            echo "<script>alert('ONE CATEGORY HAS BEEN DELETED')</script>";
            echo "<script>window.open('index.php?view_cats', '_self')</script>";
        }
    }


?>