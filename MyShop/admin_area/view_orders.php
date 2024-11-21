<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="order.css" media="all" />
    <title>View All Customers</title>
</head>
<body>
    <table width="auto">
        <tr>
            <td colspan="7"><h2>View All Customers</h2></td>
        </tr>
        <tr>
            <th>Order No <i class="fas fa-sort"></i></th>
            <th>Customer <i class="fas fa-user"></i></th>
            <th>Invoice No <i class="fas fa-file-invoice"></i></th>
            <th>Product_ID <i class="fas fa-barcode"></i></th>
            <th>QTY <i class="fas fa-shopping-cart"></i></th>
            <th>Status <i class="fas fa-check-circle"></i></th>
            <th>Delete <i class="fas fa-trash"></i></th>
        </tr>
        <?php
include("includes/db.php");

$get_orders = "SELECT * FROM customer_orders";
$run_orders = mysqli_query($con, $get_orders);

$i = 0;
while ($row_orders = mysqli_fetch_array($run_orders)) {
    $order_id = $row_orders['order_id'];
    $c_id = $row_orders['customer_id'];
    $due_amount = $row_orders['due_amount'];
    $invoice = $row_orders['invoice_no'];
    $total_products = $row_orders['total_products'];
    $order_date = $row_orders['order_date'];
    $status = $row_orders['order_status'];
    $i++;

    $get_customer_email = "SELECT customer_email FROM customers WHERE customer_id='$c_id'";
    $run_customer_email = mysqli_query($con, $get_customer_email);
    $row_customer_email = mysqli_fetch_array($run_customer_email);
    $customer_email = $row_customer_email['customer_email'];
    ?>
    <tr>
        <td><?php echo $i; ?></td>
        <td><?php echo $customer_email; ?></td>
        <td><?php echo $invoice; ?></td>
        <td><?php echo $total_products; ?></td>
        <td><?php echo $due_amount; ?></td>
        <td><?php echo $order_date; ?></td>
        <td>
            <?php
            if ($status == 'Pending') {
                echo $status = 'Pending';
            } else {
                echo $status = 'Complete';
            }
            ?>
        </td>
        <td><a href="delete_order.php?delete_order=<?php echo $order_id; ?>">Delete</a></td>
    </tr>
<?php } ?>

    </table>
</body>
</html>
