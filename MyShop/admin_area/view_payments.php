<?php
if(!isset($_SESSION['admin_email'])){
    echo "<script>window.open('login.php','_self')</script>";
}
else{

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="payments.css" media="all" />
    <title>View All Customers</title>
</head>
<body>
    <table width="auto">
        <tr>
            <td colspan="7"><h2>View All Customers</h2></td>
        </tr>
        <tr>
            <th>Payment No</th>
            <th>Invoice No</th>
            <th>Amount Paid</th>
            <th>Payment Method</th>
            <th>Ref No</th>
            <th>Code</th>
            <th>Payment Date</th>
        </tr>
        <?php
        include("includes/db.php");

        $get_payments = "SELECT * FROM payments";
        $run_payments = mysqli_query($con, $get_payments);

        $i = 0;
        while ($row_payments = mysqli_fetch_array($run_payments)) {
            $payment_id = $row_payments['payment_id'];
            $invoice= $row_payments['invoice_no'];
            $amount = $row_payments['amount'];
            $payment_m = $row_payments['product_mode'];
            $ref_no = $row_payments['ref_no'];
            $code = $row_payments['code'];
            $date = $row_payments['payment_date'];
            $i++;
            ?>
            <tr>
                <td><?php echo $i; ?></td>
                </td>
                <td><?php echo $invoice; ?></td>
                <td><?php echo $amount; ?></td>
                <td><?php echo $payment_m; ?></td>
                <td>
                <td><?php echo $ref_no;?></td>
                <td><?php echo $code;?></td>
                <td><?php echo $date;?></td>
                </td>
            </tr>
        <?php } ?>
    </table>
</body>
</html>
<?php }?>