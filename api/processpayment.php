<?php
// Iniciar a sessão
session_start();

// Conexão ao banco de dados
require_once('config.php');

// Carregar o autoload do Composer
require 'vendor/autoload.php';

// Adicione esta linha para usar SMTP::DEBUG_SERVER

// Verificar se os parâmetros estão presentes na URL
if (isset($_GET['codigo']) && isset($_GET['app']) && isset($_GET['cliente_id'])) {
    $codigo = $_GET['codigo'];
    $app = $_GET['app'];
    $cliente_id = $_GET['cliente_id'];

    // Verificar se o registro existe na tabela codigos
    $queryCheck = "SELECT * FROM codigos WHERE Codigo = '$codigo' AND App = '$app' LIMIT 1";
    $resultCheck = mysqli_query($conexao, $queryCheck);
    date_default_timezone_set('America/Sao_Paulo');

    if (mysqli_num_rows($resultCheck) > 0) {

        // Registro existe, então podemos inserir na tabela codusados
        $formDataPagamento = 'PIX'; // forma de pagamento
        $dataCompra = date('Y-m-d H:i:s'); // data da compra

        // Verificar se o registro existe na tabela codusados
        $queryCheckCodusados = "SELECT * FROM codusados WHERE Codigo = '$codigo' AND App = '$app' LIMIT 1";
        $resultCheckCodusados = mysqli_query($conexao, $queryCheckCodusados);

        if (mysqli_num_rows($resultCheckCodusados) > 0) {
            // O registro já existe na tabela codusados, então você pode atualizá-lo
            $queryUpdate = "UPDATE codusados SET FormaPagamento = '$formDataPagamento', DataCompra = '$dataCompra', ClienteID = '$cliente_id' WHERE Codigo = '$codigo' AND App = '$app'";
            mysqli_query($conexao, $queryUpdate);
        } else {
            // O registro não existe na tabela codusados, então você pode inseri-lo
            $queryInsert = "INSERT INTO codusados (Codigo, App, FormaPagamento, DataCompra, ClienteID) VALUES ('$codigo', '$app', '$formDataPagamento', '$dataCompra', '$cliente_id')";
            mysqli_query($conexao, $queryInsert);
        }

        // Excluir registro da tabela codigos
        $queryDelete = "DELETE FROM codigos WHERE Codigo = '$codigo' AND App = '$app' LIMIT 1";
        mysqli_query($conexao, $queryDelete);


        // Exibir mensagem de confirmação e o código
        echo "<center>
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Pagamento Confirmado</title>
                <link rel='stylesheet' href='styles/style.css' media='all'>
            </head>
            <body>
                <header>
                    <a href='index.html'><h1>SF&C RECARGAS TVE&MYFAMILY</h1></a>
                </header>
                <div class='confirmacao-pagamento'>
                    <h2>Pagamento Confirmado!</h2>
                    <p>Obrigado pela sua compra.</p>
                    <p>Seu código: <strong>$codigo</strong></p>
                    <p>Aplicativo: <strong>$app</strong></p>
                    <p><string>Guarde bem o código e em caso de perda, entre em contato comigo.</strong></p>
                    <a href='areacliente.php'><button>Voltar para a Área do Cliente</button></a>
                </div>
            </body>
            </html>
        ";
    } else {
        echo "
            <!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Erro</title>
                <link rel='stylesheet' href='styles/style.css' media='all'>
            </head>
            <body>
                <header>
                    <a href='index.html'><h1>SF&C RECARGAS TVE&MYFAMILY</h1></a>
                </header>
                <div class='erro-pagamento'>
                    <h2>Erro na Confirmação do Pagamento</h2>
                    <p>Desculpe, ocorreu um erro ao processar seu pagamento. Por favor, tente novamente.</p>
                    <a href='areacliente.php'><button>Voltar para a Área do Cliente</button></a>
                </div>
            </body>
            </html>
        ";
    }

    mysqli_close($conexao);
} else {
    // Trate o caso em que os parâmetros não estão presentes na URL
    echo "Parâmetros ausentes na URL.";
}
?>
