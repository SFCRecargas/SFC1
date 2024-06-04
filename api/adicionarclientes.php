<?php
session_start();

// Verificar se o administrador está logado
if(!isset($_SESSION['useradmin'])) {
    header('Location: loginadmin.php');
    exit;
}

include_once('config.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomes = $_POST['nome'];
    $emails = $_POST['email'];
    $nomesusuario = $_POST['nomeusuario'];
    $senhas = $_POST['senha'];

    // Verificar se todos os campos foram preenchidos
    if (count($nomes) > 0 && count($emails) > 0 && count($nomesusuario) > 0 && count($senhas) > 0) {
        $errors = [];

        // Preparar a consulta SQL
        $stmt = $conexao->prepare("INSERT INTO cliente (NOME, EMAIL, NOMEUSUARIO, SENHA) VALUES (?, ?, ?, ?)");

        for ($i = 0; $i < count($nomes); $i++) {
            $nome = $nomes[$i];
            $email = $emails[$i];
            $nomeusuario = $nomesusuario[$i];
            $senha = $senhas[$i]; // Usar hash seguro para senha

            // Bind dos parâmetros e execução da consulta
            $stmt->bind_param("ssss", $nome, $email, $nomeusuario, $senha);

            if (!$stmt->execute()) {
                $errors[] = "Erro ao adicionar cliente $nome: " . $stmt->error;
            }
        }

        // Fechar a declaração
        $stmt->close();

        if (empty($errors)) {
            echo "Todos os clientes foram adicionados com sucesso!";
            header('Location: admin.php');
        } else {
            echo "Ocorreram os seguintes erros:<br>";
            foreach ($errors as $error) {
                echo $error . "<br>";
            }
        }
    } else {
        echo "Por favor, preencha todos os campos.";
    }
} else {
    header('Location: admin.php');
    exit();
}

$conexao->close();
?>
