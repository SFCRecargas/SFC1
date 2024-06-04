<?php
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include_once('config.php');

    // Obter os dados do formulário
    $nome = $_POST["nomeedit"];
    $email = $_POST["emailedit"];
    $usuario = $_POST["nomeusuarioedit"];
    $senha = $_POST["senhaedit"];
    $pix = $_POST["pixedit"];
    $id = $_SESSION['id'];

    // Atualizar os dados no banco de dados
    $sql = "UPDATE administrador SET NOME = '$nome', EMAIL = '$email', NOMEUSUARIO = '$usuario', SENHA = '$senha', CHAVEPIX = '$pix' WHERE ID = '$id'";

    if ($conexao->query($sql) === TRUE) {
        echo "Perfil atualizado com sucesso!";
        header('Location: admin.php');
    } else {
        echo "Erro na atualização do perfil: " . $conexao->error;
        header('Location: editarperfiladmin.php');
    }
    $conexao->close();
} else {
    // Redirecionar se o formulário não foi enviado
    header("Location: editarperfilc.php");
    exit();
}
?>
