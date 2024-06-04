<?php 
    require_once 'vendor/autoload.php';
    MercadoPago\SDK::setAcessToken("APP_USR-287711365593730-060119-b83ba5f933e90d460c89db5939b18c43-1608531401");//mudar acess token

    $payment = new MercadoPago\Payment();
    $payment->transaction_amount=30;
    $payment->payer=array(
        "email" =>"payer@email.com"
    );

    $payment->payment_method_id = "pix";
    $payment->external_reference = "SUA REFERENCIA EXTERNA";

    $payment->save();
    echo '<pre>';
    var_dump($payment);

?>