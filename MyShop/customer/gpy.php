<?php
// Include the database connection file
include("includes/db.php");

// Check if the order_id is set in the URL
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Fetch order details based on the order_id
    $get_order_query = "SELECT * FROM customer_orders WHERE order_id='$order_id'";
    $run_order = mysqli_query($con, $get_order_query);

    // Check if the order details are found
    if ($order_details = mysqli_fetch_array($run_order)) {
        $invoice_no = $order_details['invoice_no'];
        $due_amount = $order_details['due_amount'];
    } else {
        // Redirect to the previous page if order details are not found
        header("Location: my_orders.php");
        exit();
    }
} else {
    // Redirect to the previous page if order_id is not provided
    header("Location: my_orders.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Online Payment</title>
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
            margin-top: 20px;
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            cursor: pointer;
        }
    </style>
</head>
<body>

<h3>Online Payment</h3>

<form action="process_payment.php" method="post">
    <label for="invoice_no">Invoice No:</label>
    <input type="text" id="invoice_no" name="invoice_no" value="<?php echo $invoice_no; ?>" readonly>

    <label for="due_amount">Due Amount:</label>
    <input type="text" id="due_amount" name="due_amount" value="<?php echo $due_amount; ?>" readonly>

    <label for="card_number">Card Number:</label>
    <input type="text" id="card_number" name="card_number" placeholder="Enter your card number" required>

    <label for="expiry_date">Expiry Date:</label>
    <input type="text" id="expiry_date" name="expiry_date" placeholder="MM/YYYY" required>

    <label for="cvv">CVV:</label>
    <input type="text" id="cvv" name="cvv" placeholder="Enter CVV" required>

    <button type="submit">Pay Now</button>
</form>

</body>
</html>
