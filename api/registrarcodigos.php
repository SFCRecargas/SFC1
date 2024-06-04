<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include_once('config.php');

    // Obter os valores enviados pelo formulário
    $codigos = $_POST['codigo'];
    $apps = $_POST['app'];

    // Inicializar uma variável para rastrear erros
    $errors = [];

    // Loop através dos códigos e inserir cada um no banco de dados
    foreach ($codigos as $index => $codigo) {
        $app = $apps[$index];

        // Preparar a consulta SQL para evitar injeção de SQL
        $stmt = $conexao->prepare("INSERT INTO codigos (codigo, app) VALUES (?, ?)");
        $stmt->bind_param("ss", $codigo, $app);

        // Executar a consulta e verificar se foi bem-sucedida
        if ($stmt->execute()) {
            echo "Código $codigo registrado com sucesso para o app $app!<br>";
        } else {
            $errors[] = "Erro ao registrar o código $codigo: " . $stmt->error;
        }

        // Fechar a declaração preparada
        $stmt->close();
    }

    // Fechar a conexão com o banco de dados
    $conexao->close();

    // Exibir mensagens de erro, se houver
    if (!empty($errors)) {
        echo "Ocorreram os seguintes erros:<br>";
        foreach ($errors as $error) {
            echo $error . "<br>";
        }
    } else {
        echo "Todos os códigos foram registrados com sucesso!";
        header('Location: admin.php');
    }
} else {
    // Se o formulário não foi enviado, redirecionar para a página do formulário
    header("Location: form.html");
    exit();
}
?>
