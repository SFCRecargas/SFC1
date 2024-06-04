<?php
include_once('config.php');

if(isset($_GET['codigo'])) {
    $codigo = $_GET['codigo'];

    // Excluir o código do banco de dados
    $sql = "DELETE FROM codigos WHERE CODIGO = '$codigo'";

    if($conexao->query($sql) === TRUE) {
        echo "Código excluído com sucesso!";
    } else {
        echo "Erro ao excluir o código: " . $conexao->error;
    }

    $conexao->close();
    header('Location: admin.php'); // Redireciona de volta para a área de administrador
    exit();
} else {
    echo "Código não especificado.";
    header('Location: admin.php');
    exit();
}
?>
