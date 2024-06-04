<?php 
$config = require_once 'configmp.php';
require_once 'vendor/autoload.php';

use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

MercadoPagoConfig::setAccessToken($config['accesstoken']);
$client = new PaymentClient();

$createRequest = [
    "transaction_amount" => 1.50,
    "description" => "description",
    "external_reference" => uniqid(),
    "notification_url" => "https://seu-dominio.com/notification.php", // Atualize com seu domínio
    "payment_method_id" => "pix",
    "payer" => [
        "email" => "cliente@gmail.com",
    ]
];

try {
    $payment = $client->create($createRequest);
    
    $qrCodeBase64 = $payment->point_of_interaction->transaction_data->qr_code_base64;
    $qrCode = $payment->point_of_interaction->transaction_data->qr_code;
    $paymentId = $payment->id;
    
    echo '<img src="data:image/png;base64,' . $qrCodeBase64 . '" />';
    echo '<p>Código PIX para copiar e colar:</p>';
    echo '<textarea readonly>' . $qrCode . '</textarea>';
    
    echo '<div id="payment-status"></div>';
    echo '<div id="payment-alert" style="display: none; color: green; font-weight: bold;">Pagamento confirmado!</div>';
    
    echo '
    <script>
    function checkPaymentStatus() {
        fetch("checkstatuspayment.php?id=' . $paymentId . '")
            .then(response => response.json())
            .then(data => {
                if (data.status === "approved") {
                    document.getElementById("payment-status").innerHTML = "<p>Pagamento confirmado!</p>";
                    document.getElementById("payment-alert").style.display = "block"; // Mostra o alerta
                    clearInterval(interval); // Para a verificação automática após confirmação
                } else {
                    document.getElementById("payment-status").innerHTML = "<p>Pagamento ainda não confirmado.</p>";
                }
            })
            .catch(error => console.error("Erro:", error));
    }

    // Verificação automática a cada 03 segundos
    var interval = setInterval(checkPaymentStatus, 3000);
    </script>
    ';
    
} catch (Exception $e) {
    echo 'Erro: ' . $e->getMessage();
}
?>
