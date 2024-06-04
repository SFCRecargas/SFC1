<?php
session_start();

// Verificar se o administrador está logado
if(!isset($_SESSION['useradmin'])) {
    header('Location: loginadmin.php');
    exit;
}

include_once('config.php');

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Preparar e executar a exclusão do cliente
    $stmt = $conexao->prepare("DELETE FROM cliente WHERE ID = ?");
    $stmt->bind_param("i", $id);
    
    if($stmt->execute()) {
        echo "Cliente excluído com sucesso!";
        header('Location: admin.php');
    } else {
        echo "Erro ao excluir cliente: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "ID de cliente não fornecido.";
}
$conexao->close();
?>
