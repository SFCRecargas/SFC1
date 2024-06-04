<?php 
if(isset($_POST['submit'])){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    include_once('config.php');

    $result = mysqli_query($conexao, "INSERT INTO cliente (NOME, EMAIL, NOMEUSUARIO, SENHA) VALUES ('$nome', '$email', '$usuario', '$senha')");

    if($result == false){
        echo "<h4>Houve um problema no cadastro!</h4>";
    } else {
      echo "<h4>Cadastro realizado com sucesso! Faça login para continuar.</h4>";
      header("Refresh: 5; url=login.php");
    }
}
require('includes/header.html');
?>

<title>Registro - Cliente</title>
</head>
<body>
    <header class='header-registro'>
        <a href="index.html"><h1>SF&C RECARGAS TVE&MYFAMILY</h1></a>
        <a href="admin.php"><button>VOLTAR</button></a>
        <a href="sairadmin.php"><button>SAIR</button></a>
    </header>

    <form action="registro.php" method="post" class="login">
        <div class="inputs">
            <input type="text" name="nome" id="nome" placeholder="Nome" required>
            <input type="email" name="email" id="email" placeholder="E-mail" required>
            <input type="text" name="usuario" id="usuario" placeholder="Nome de usuário" required>
            <input type="password" name="senha" id="senha" placeholder="Senha" required>
            <input type="submit" value="REGISTRAR" id="acessar" name="submit">
        </div>
    </form>
</body>

<footer id="footer"></footer>
</html>
