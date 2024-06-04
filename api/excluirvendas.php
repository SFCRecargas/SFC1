<?php
include_once('config.php');

// Excluir todos os registros da tabela codusados
$sql = "DELETE FROM codusados";

if($conexao->query($sql) === TRUE) {
    echo "Todos os registros de vendas foram excluídos com sucesso!";
} else {
    echo "Erro ao excluir os registros de vendas: " . $conexao->error;
}

$conexao->close();
header('Location: admin.php'); // Redireciona de volta para a área de administrador
exit();
?>
