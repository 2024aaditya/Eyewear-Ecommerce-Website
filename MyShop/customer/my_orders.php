<?php
include("includes/db.php");

$c = $_SESSION['customer_email'];

$get_c = "SELECT * FROM customers WHERE customer_email='$c'";
$run_c = mysqli_query($con, $get_c);
$row_c = mysqli_fetch_array($run_c);

$customer_id = $row_c['customer_id'];

if (isset($_POST['delete_order'])) {
    $delete_order_id = $_POST['delete_order_id'];

    // Perform the deletion in the database
    $delete_query = "DELETE FROM customer_orders WHERE order_id='$delete_order_id'";
    $run_delete = mysqli_query($con, $delete_query);

    if ($run_delete) {
        // Send a success response to the JavaScript function
        echo json_encode(['status' => 'success']);
        exit();
    } else {
        // Send an error response to the JavaScript function
        echo json_encode(['status' => 'error', 'message' => 'Error deleting order']);
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Order Details</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 20px;
            text-align: center;
        }

        h3 {
            color: #343a40;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table, th, td {
            border: 1px solid #dee2e6;
        }

        th, td {
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        tr:nth-child(even) {
            background-color: #f1f1f1;
        }

        tr:hover {
            background-color: #e9ecef;
        }

        a {
            text-decoration: none;
            color: #007bff;
        }

        a:hover {
            text-decoration: underline;
        }
        </style>
</head>
<body>

<h3>Your Order Details</h3>

<table>
    <tr>
        <th>Order No</th>
        <th>Due Amount</th>
        <th>Invoice No</th>
        <th>Total Products</th>
        <th>Order Date</th>
        <th>Status</th>
        <th>Action</th>
        <th>Delete</th> <!-- New column for delete action -->
    </tr>

    <?php
    $get_orders = "SELECT * FROM customer_orders WHERE customer_id='$customer_id'";
    $run_orders = mysqli_query($con, $get_orders);

    $i = 0;

    while ($row_orders = mysqli_fetch_array($run_orders)) {
        $order_id = $row_orders['order_id'];
        $due_amount = $row_orders['due_amount'];
        $invoice_no = $row_orders['invoice_no'];
        $products = $row_orders['total_products'];
        $date = $row_orders['order_date'];
        $status = $row_orders['order_status'];

        $i++;
        $status_display = ($status == 'Pending') ? 'Unpaid' : 'Paid';

        echo "
        <tr>
            <td>$i</td>
            <td>$due_amount</td>
            <td>$invoice_no</td>
            <td>$products</td>
            <td>$date</td>
            <td>$status_display</td>
            <td>
                <a href='offline_payment.php?order_id=$order_id'>Offline Payment</a> |
                <a href='payment.php?order_id=<?php echo $order_id; ?>'>Online Payment</a>

            </td>
            <td>
                <form method='post' action=''>
                    <input type='hidden' name='delete_order_id' value='$order_id'>
                    <input type='submit' name='delete_order' value='Delete'>
                </form>
            </td>
        </tr>
        ";
    }
    ?>

</table>

</body>
</html>