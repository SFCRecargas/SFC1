<?php
$config = require_once 'configmp.php';
require_once 'vendor/autoload.php';

use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\MercadoPagoConfig;

MercadoPagoConfig::setAccessToken($config['accesstoken']);
$client = new PaymentClient();

$createRequest = [
    "transaction_amount" => 0.30,
    "description" => "description",
    "external_reference" => uniqid(),
    "notification_url" => "https://seu-dominio.com/notification.php", // Atualize com seu domínio
    "payment_method_id" => "pix",
    "payer" => [
        "email" => "cliente@gmail.com",
    ]
];

require('includes/header.html');
session_start(); // Iniciar a sessão
if (!isset($_SESSION['user'])) {
    header('Location: login.php'); // Redirecionar se o usuário não estiver logado
    exit();
}
require_once 'config.php';
$logado = $_SESSION['user'];
$sqlid = "SELECT ID FROM cliente WHERE NOMEUSUARIO = '$logado'";
$resultid = $conexao->query($sqlid);

if ($resultid && $resultid->num_rows > 0) {
    $row = $resultid->fetch_assoc();
    $cliente_id = $row['ID'];
}
?>

<title>Pagamento</title>
</head>
<body class='body-pag'>
    <header>
        <a href="index.html"><h1>SF&C RECARGAS TVE&MYFAMILY</h1></a>
    </header>
    <center>
        <?php 
        try {
            $payment = $client->create($createRequest);
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['codigo']) && isset($_POST['app']) && isset($_POST['cliente_id'])) {
                $codigo = $_POST['codigo'];
                $app = $_POST['app'];
                

                $cliente_id = $row['ID']; // Verifique se está recebendo corretamente

                $qrCodeBase64 = $payment->point_of_interaction->transaction_data->qr_code_base64;
                $qrCode = $payment->point_of_interaction->transaction_data->qr_code;
                $paymentId = $payment->id;

                echo '<div id="qrCodeContainer">';
                echo '<img src="data:image/png;base64,' . $qrCodeBase64 . '" id="qrCode" height=300px />';
                echo '<p>Código PIX:</p>';
                echo '<div id="codigoPixContainer">';
                echo '<textarea readonly id="textarea">' . $qrCode . '</textarea>';
                echo '<button onclick="copiarCodigoPix()">Copiar Código PIX</button>';
                echo '</div>';
                echo '</div>';

                echo '<div id="payment-status"></div>';
                echo '<div id="payment-alert" style="display: none; color: green; font-weight: bold;">Pagamento confirmado!</div>';

                echo '
                <script>
                function copiarCodigoPix() {
                    var textarea = document.getElementById("textarea");
                    textarea.select();
                    document.execCommand("copy");
                    alert("Código PIX copiado com sucesso!");
                }

                function checkPaymentStatus() {
                    fetch("checkstatuspayment.php?id=' . $paymentId . '")
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === "approved") {
                                document.getElementById("payment-status").innerHTML = "<p>Pagamento confirmado!</p>";
                                document.getElementById("payment-alert").style.display = "block"; // Mostra o alerta
                                clearInterval(interval); // Para a verificação automática após confirmação
                                document.getElementById("qrCodeContainer").style.display = "none"; 

                                // Redireciona para a página de processamento do pagamento
                                window.location.href = "processpayment.php?codigo=' . $codigo . '&app=' . $app . '&cliente_id=' . $cliente_id . '";
                            } else {
                                document.getElementById("payment-status").innerHTML = "<p>Pagamento ainda não confirmado.</p>";
                            }
                        })
                        .catch(error => console.error("Erro:", error));
                }

                // Verificação automática a cada 03 segundos
                var interval = setInterval(checkPaymentStatus, 3000); // Verifica a cada 3 segundos
                </script>
                ';
            } else {
                echo 'Requisição inválida.';
            }
        } catch (Exception $e) {
            echo 'Erro: ' . $e->getMessage();
        }
        ?>
    </center>
</body>
</html>
