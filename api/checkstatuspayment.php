<?php 
$config = require_once 'configmp.php';
require_once 'vendor/autoload.php';

use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\MercadoPagoConfig;

header('Content-Type: application/json');

MercadoPagoConfig::setAccessToken($config['accesstoken']);
$client = new PaymentClient();

$response = [];

if (isset($_GET['id'])) {
    $paymentId = $_GET['id'];
    try {
        $payment = $client->get($paymentId);
        $response['status'] = $payment->status;
    } catch (Exception $e) {
        $response['error'] = $e->getMessage();
    }
} else {
    $response['error'] = 'ID do pagamento não fornecido';
}

echo json_encode($response);
?>
