<?php
// Include Razorpay PHP library
require __DIR__ . '/path/to/razorpay-php/Razorpay.php';

use Razorpay\Api\Api;

// Your Razorpay Key ID and Key Secret
$key_id = 'rzp_test_BrYjKCpe2AhYUu';
$key_secret = 'OT4fipPKa83go0IKadMsuxRy';

// Initialize Razorpay API
$api = new Api($key_id, $key_secret);

// Rest of your code...

// Example: Create a Razorpay order
$order = $api->order->create([
    'amount' => 1000,  // Example amount in paisa (e.g., 1000 paisa = 10 INR)
    'currency' => 'INR',
    'payment_capture' => 1,
]);

// Get the Razorpay order ID
$order_id = $order['id'];

// Display the payment button
echo "<a href='path/to/razorpay-php/razorpay-php/checkout.php?order_id=$order_id'>Pay with Razorpay</a>";

// Rest of your code...
?>

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Order Details</title>
    <style>
        <!-- Your existing styles -->
    </style>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
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
                <a href='#' onclick='payWithRazorpay($order_id, $due_amount)'>Online Payment</a>
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

<script>
    function payWithRazorpay(orderId, amount) {
        var options = {
            key: '<?php echo $key_id; ?>',
            amount: amount * 100, // Amount in paise
            currency: 'INR',
            name: 'Your Company Name',
            description: 'Order Payment',
            image: 'your_logo_url',
            order_id: orderId,
            handler: function (response) {
                // Handle the success callback
                alert('Payment successful. Payment ID: ' + response.razorpay_payment_id);

                // You may want to update the order status or perform other actions here
            },
            prefill: {
                name: 'Customer Name',
                email: 'customer@example.com',
                contact: 'customer_contact_number',
            },
            notes: {
                address: 'Razorpay Order Payment',
            },
            theme: {
                color: '#007bff',
            },
        };

        var rzp = new Razorpay(options);
        rzp.open();
    }
</script>

</body>
</html>
