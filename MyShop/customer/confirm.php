<?php
session_start();
include("includes/db.php");


if(isset($_GET['order_id'])){
 $order_id = $_GET['order_id'];
}
 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form action="confirm.php?update_id=<?php echo $order_id;?>" method="post">
    <table width="600" height="600" align="center" border="2">
        <tr>
            <td colspan="2" style="text-align: center;">
                <h2 style="margin: 10px 0;">Please Confirm Your Payment</h2>
            </td>
        </tr>
       
        <tr>
            <td style="padding: 5px;">Invoice NO:</td>
            <td><input type="text" name="invoice_no" style="padding: 5px;" /></td>
        </tr>
        <tr>
            <td style="padding: 5px;">Amount Paid:</td>
            <td><input type="text" name="amount" style="padding: 5px;" /></td>
        </tr>
        <tr>
            <td style="padding: 5px;">Select Your Payment Method:</td>
            <td>
                <select name="payment_method" style="padding: 5px;">
                    <option>Select Payment</option>
                    <option>Bank Transaction</option>
                    <option>Easypaisa/UBL omni</option>
                    <option>GPay/Phonepe</option>
                    <option>Paypal</option>
                </select>
            </td>
        </tr>
        <tr>
        <tr>
        <tr>
            <td style="padding: 5px;">Transaction/Refference ID:</td>
            <td><input type="text" name="tr" style="padding: 5px;" /></td>
        </tr>
        <tr>
            <td style="padding: 5px;">Easypaisa/UBL omni Code:</td>
            <td><input type="text" name="code" style="padding: 5px;" /></td>
        </tr>
            <td style="padding: 5px;">Payment Date:</td>
            <td><input type="text" name="date" style="padding: 5px;" /></td>
        </tr>
       
       
        <tr>
            <td colspan="2" style="text-align: center;">
                <input type="submit" name="confirm" value="Confirm Payment"/></td>
            </tr>
    </table>
</form>

</body>  
</html>

<?php
if (isset($_POST['confirm'])) {

    $invoice = $_POST['invoice_no'];
    $amount = $_POST['amount'];
    $payment_method = $_POST['payment_method'];
    $ref_no = $_POST['tr'];
    $code = $_POST['code'];
    $date = $_POST['date'];


    $insert_payment = "INSERT INTO payments (invoice_no, amount, payment_meode, ref_no, code, payment_date)
                       VALUES ('$invoice', '$amount', '$payment_method', '$ref_no', '$code', '$date')";
    $run_payment = mysqli_query($con, $insert_payment);

    if($run_payment){
        echo"<h2 style='text-align:center; color:red;'>Payment receiverd, order will be placed within 24 hrs</h2> ";
    }
    
        $update_order = "UPDATE customer_orders SET order_status='Complete' WHERE order_id='$order_id'";

        $run_order = mysqli_query($con, $update_order);



}
?>