<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="customer.css" media="all" />
    <title>View All Customers</title>
</head>
<body>
    <table width="auto">
        <tr>
            <td colspan="6"><h2>View All Customers</h2></td>
        </tr>
        <tr>
            <th>S.N <i class="fas fa-sort"></i></th>
            <th>Name <i class="fas fa-user"></i></th>
            <th>Email <i class="fas fa-envelope"></i></th>
            <th>Image <i class="fas fa-image"></i></th>
            <th>Country <i class="fas fa-globe"></i></th>
            <th>Delete <i class="fas fa-trash"></i></th>
        </tr>
        <?php
        include("includes/db.php");

        $get_c = "select * from customers";
        $run_c = mysqli_query($con, $get_c);

        $i = 0; // Initialize $i before the loop

        while ($row_c = mysqli_fetch_array($run_c)) {
            $c_id = $row_c['customer_id'];
            $c_name = $row_c['customer_name'];
            $c_email = $row_c['customer_email'];
            $c_image = $row_c['customer_image'];
            $c_country = $row_c['customer_country'];
            $i++;

            // Output customer information in the table
            echo "<tr>
                    <td>$i</td>
                    <td>$c_name</td>
                    <td>$c_email</td>
                    <td><img src='../customer/customer_photos/$c_image' width='60' height='60' alt='Customer Image'/></td>
                    <td>$c_country</td>
                    <td><a href='delete_c.php?delete_c=$c_id'>Delete</a></td>
                  </tr>";
        }
        ?>
    </table>
</body>
</html>
