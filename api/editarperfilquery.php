<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once('config.php');

    // Obter os dados do formulário
    $nome = $_POST["nomeedit"];
    $email = $_POST["emailedit"];
    $usuario = $_POST["nomeusuarioedit"];
    $senha = $_POST["senhaedit"];
    $id = $_SESSION['user_id']; // Alterar para 'user_id' para ser consistente

    // Atualizar os dados no banco de dados
    $sql = "UPDATE cliente SET NOME = '$nome', EMAIL = '$email', NOMEUSUARIO = '$usuario', SENHA = '$senha' WHERE ID = '$id'";

    if ($conexao->query($sql) === TRUE) {
        // Atualizar o nome de usuário na sessão
        $_SESSION['user'] = $usuario;

        // Redirecionar para a área do cliente
        header('Location: areacliente.php');
        exit();
    } else {
        echo "Erro na atualização do perfil: " . $conexao->error;
        // Redirecionar de volta para a página de edição do perfil
        header('Location: editarperfilc.php');
        exit();
    }
    $conexao->close();
} else {
    // Redirecionar se o formulário não foi enviado
    header("Location: editarperfilc.php");
    exit();
}
?>
