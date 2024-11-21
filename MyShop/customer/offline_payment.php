<?php
include("includes/db.php");

// Start the session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['customer_email'])) {
    // Redirect to the login page or handle the situation where the user is not logged in
    header("Location: login.php"); // Change login.php to the actual login page
    exit();
}

$c = $_SESSION['customer_email'];

$get_c = "SELECT * FROM customers WHERE customer_email='$c'";
$run_c = mysqli_query($con, $get_c);
$row_c = mysqli_fetch_array($run_c);

$customer_id = $row_c['customer_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Offline Payment Confirmation</title>
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

        form {
            max-width: 400px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #495057;
        }

        input {
            width: 100%;
            padding: 12px;
            margin-bottom: 20px;
            box-sizing: border-box;
            border: 1px solid #ced4da;
            border-radius: 6px;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #28a745;
            color: #ffffff;
            cursor: pointer;
            font-size: 18px;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        p {
            margin-bottom: 20px;
            color: #6c757d;
        }
    </style>
</head>
<body>

    <h3>Offline Payment Confirmation</h3>
    <?php
    if (isset($_GET['order_id'])) {
        $order_id = $_GET['order_id'];

        // Retrieve order details
        $get_order = "SELECT * FROM customer_orders WHERE order_id='$order_id' AND customer_id='$customer_id'";
        $run_order = mysqli_query($con, $get_order);
        $row_order = mysqli_fetch_array($run_order);

        if ($row_order) {
            $due_amount = $row_order['due_amount'];
            $invoice_no = $row_order['invoice_no'];
            $products = $row_order['total_products'];
            $date = $row_order['order_date'];

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Process the form submission
                $customer_name = mysqli_real_escape_string($con, $_POST['customer_name']);
                $phone_number = mysqli_real_escape_string($con, $_POST['phone_number']);
                $address = mysqli_real_escape_string($con, $_POST['address']);

                // Validate form data
                if (!empty($customer_name) && !empty($phone_number) && !empty($address)) {
                    // Update order status to 'Paid'
                    $update_status = "UPDATE customer_orders SET order_status='Paid' WHERE order_id='$order_id'";
                    $run_update = mysqli_query($con, $update_status);

                    if ($run_update) {
                        // Your confirmation echo or processing here
                        echo "Payment confirmed for $customer_name. Thank you!";

                        // Optionally, redirect to the success page after processing
                        // header("Location: success.php");
                        // exit();
                    } else {
                        echo "Failed to update order status.";
                    }
                } else {
                    echo "Please fill in all the required fields.";
                }
            }


            echo "
            <p>Invoice No: $invoice_no</p>
            <p>Total Amount: $due_amount</p>
            <p>Total Products: $products</p>
            <p>Order Date: $date</p>

            <form method='post' action=''>
                <label for='customer_name'>Customer Name:</label>
                <input type='text' name='customer_name' required><br>

                <label for='phone_number'>Phone Number:</label>
                <input type='text' name='phone_number' required><br>

                <label for='address'>Address:</label>
                <input type='text' name='address' required><br>

                <input type='hidden' name='order_id' value='$order_id'>
                <input type='submit' value='Confirm Payment'>
            </form>
            ";
        } else {
            echo "Invalid order ID.";
        }
    } else {
        echo "Order ID not provided.";
    }
    ?>

</body>
</html>
