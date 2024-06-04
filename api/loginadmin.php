<?php 
session_start();
if(isset($_SESSION['useradmin'])){
header('Location: admin.php');
exit;
}
require('includes/header.html');
?>

<title>Login - Administrador</title>
</head>
<body>
    <header>
        <a href="index.html"><h1>SF&C RECARGAS TVE&MYFAMILY</h1></a>
    </header>

    <form action="logaradmin.php" method="post" class="login">
        <div class="inputs">
            <input type="text" name="usuarioadmin" id="usuarioadmin" placeholder="Nome de usuário do admin" required>
            <input type="password" name="senhaadmin" id="senhaadmin" placeholder="Senha do admin" required>
            <input type="submit" value="Acessar Administração" id="acessar" name="submit">
        </div>
    </form>
</body>

<footer id="footer"></footer>
</html>
