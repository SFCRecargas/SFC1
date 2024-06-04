<?php 
$config = require_once 'configmp.php';
require_once 'vendor/autoload.php';

use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\MercadoPagoConfig;

MercadoPagoConfig::setAccessToken($config['accesstoken']);
$client = new PaymentClient();

$body = json_decode(file_get_contents('php://input'));

if (isset($body->data->id)) {
    $id = $body->data->id;
    $payment = $client->get($id);
    
    $status = $payment->status;
    $external_reference = $payment->external_reference;
    
    // Aqui você pode adicionar a lógica para atualizar o status do pagamento no seu sistema
    // Por exemplo, salvar o status no banco de dados
}
?>
