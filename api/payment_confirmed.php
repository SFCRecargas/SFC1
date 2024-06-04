<?php
$codigo = $_GET['codigo'];
$app = $_GET['app'];

// Processamento do pagamento no backend
$conn = new mysqli('localhost', 'root', '', 'ecargas');

if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

$sqlInsert = "INSERT INTO codusados (CODIGO, APP, FORMAPAGAMENTO, DATACOMPRA) 
VALUES ('$codigo', '$app', 'PIX', NOW())";
            
if ($conn->query($sqlInsert) === TRUE) {
    $sqlDelete = "DELETE FROM codigos WHERE Codigo = '$codigo' AND App = '$app'";
    if ($conn->query($sqlDelete) === TRUE) {
        echo "<p>Informações de pagamento processadas com sucesso.</p>";
        echo "<p>Código usado: $codigo</p>";
        echo "<p>App: $app</p>";
    } else {
        echo "<p>Erro ao excluir registro da tabela codigos: ". $conn->error. "</p>";
    }
} else {
    echo "<p>Erro ao inserir registro na tabela CodUsados: ". $conn->error. "</p>";
}

$conn->close();
?>