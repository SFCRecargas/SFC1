<?php 
session_start();
if(isset($_SESSION['user'])) {
    header('Location: areacliente.php');
    exit();
}
require('includes/header.html');
?>

<title>Login - Cliente</title>
</head>
<body>
    <header>
        <a href="index.html"><h1>SF&C RECARGAS TVE&MYFAMILY</h1></a>
    </header>

    <form action="logar.php" method="post" class="login">
        <div class="inputs">
            <input type="text" name="usuario" id="usuario" placeholder="Nome de usuário" required>
            <input type="password" name="senha" id="senha" placeholder="Senha" required>
            <input type="submit" value="Acessar e fazer recarga" id="acessar" name="submit">
        </div>
    </form>
</body>

<footer id="footer"></footer>
</html>
