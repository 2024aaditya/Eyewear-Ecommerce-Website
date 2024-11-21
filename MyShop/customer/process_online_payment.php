<?php
require_once __DIR__ . '/../vendor/autoload.php';

use PayPal\Api\Amount;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;

$clientId = 'YOUR_PAYPAL_CLIENT_ID';
$clientSecret = 'YOUR_PAYPAL_CLIENT_SECRET';

$apiContext = new \PayPal\Rest\ApiContext(
    new OAuthTokenCredential($clientId, $clientSecret)
);

// Set API context options (sandbox mode)
$apiContext->setConfig([
    'mode' => 'sandbox',
    'log.LogEnabled' => true,
    'log.FileName' => 'PayPal.log',
    'log.LogLevel' => 'DEBUG',
]);

$payer = new Payer();
$payer->setPaymentMethod('paypal');

$amount = new Amount();
$amount->setTotal('10.00'); // Set the total amount
$amount->setCurrency('USD');

$transaction = new Transaction();
$transaction->setAmount($amount);

$redirectUrls = new RedirectUrls();
$redirectUrls->setReturnUrl('http://yourwebsite.com/success')
    ->setCancelUrl('http://yourwebsite.com/cancel');

$payment = new Payment();
$payment->setIntent('sale')
    ->setPayer($payer)
    ->setTransactions([$transaction])
    ->setRedirectUrls($redirectUrls);

try {
    $payment->create($apiContext);
    $approvalUrl = $payment->getApprovalLink();
    header("Location: $approvalUrl");
} catch (\Exception $e) {
    // Handle errors
    echo $e->getMessage();
}
?>
