<?php
header('Content-Type: application/json');

// Estabelecer conexão com o banco de dados
$conn = new mysqli('localhost', 'root', '', 'recargas');

// Verificar conexão
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'error' => 'Connection failed: ' . $conn->connect_error]);
    exit();
}

// Obter os dados JSON da solicitação
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['codigo']) && isset($data['app'])) {
    $codigo = $data['codigo'];
    $app = $data['app'];

    // Inserir informações na tabela CodUsados
    $sqlInsert = "INSERT INTO CodUsados (Codigo, App, FormaPagamento, DataCompra) 
                  VALUES ('$codigo', '$app', 'PIX', NOW())";

    if ($conn->query($sqlInsert) === TRUE) {
        // Excluir da tabela codigos
        $sqlDelete = "DELETE FROM codigos WHERE Codigo = '$codigo' AND App = '$app'";
        if ($conn->query($sqlDelete) === TRUE) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'error' => 'Erro ao excluir registro da tabela codigos: ' . $conn->error]);
        }
    } else {
        echo json_encode(['success' => false, 'error' => 'Erro ao inserir registro na tabela CodUsados: ' . $conn->error]);
    }
} else {
    echo json_encode(['success' => false, 'error' => 'Parâmetros incompletos']);
}

// Fechar a conexão com o banco de dados
$conn->close();
?>
