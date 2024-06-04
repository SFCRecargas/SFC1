<?php
// Estabelecer conexão com o banco de dados (substitua 'hostname', 'username', 'password', e 'database' pelos seus dados reais)
$conn = new mysqli('localhost', 'root', '', 'recargas');

// Verificar conexão
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Obter os parâmetros enviados pelo pagamentoTVE.php
if (isset($_GET['id']) && isset($_GET['codigo']) && isset($_GET['app']) && isset($_GET['forma_pagamento']) && isset($_GET['data_pagamento'])) {
    $paymentId = $_GET['id'];
    $codigo = $_GET['codigo'];
    $app = $_GET['app'];
    $formaPagamento = $_GET['forma_pagamento'];
    $dataPagamento = $_GET['data_pagamento'];

    // Preparar a consulta SQL para inserir os detalhes do pagamento na tabela CodUsados
    $sql = "INSERT INTO CodUsados (Codigo, App, FormaPagamento, DataCompra) 
            VALUES ('$codigo', '$app', '$formaPagamento', '$dataPagamento')";

    // Executar a consulta SQL
    if ($conn->query($sql) === TRUE) {
        echo "Registro de pagamento inserido com sucesso na tabela CodUsados.";
    } else {
        echo "Erro ao inserir registro de pagamento: " . $conn->error;
    }
} else {
    echo "Parâmetros incompletos para confirmar o pagamento.";
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
