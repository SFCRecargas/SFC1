<?php 
include_once('config.php');
session_start();

// Verificar se o usuário está logado
if(!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Mostrar informações do usuário
$user_id = $_SESSION['user_id'];
$sql = "SELECT ID, NOME, EMAIL, NOMEUSUARIO, SENHA FROM cliente WHERE ID = '$user_id'";
$result = $conexao->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nome_do_usuario = $row['NOME'];
    $email_do_usuario = $row['EMAIL'];
    $nomeusuario = $row['NOMEUSUARIO'];
    $senha = $row['SENHA'];
} else {
    // Tratar erros na execução da consulta ou usuário não encontrado
    echo "Erro ao buscar informações do usuário: " . $conexao->error;
    exit();
}

require('includes/header.html');
?>
<title>Editar perfil - cliente</title>
</head>
<body>

<header id='header-cliente'>
    <a href="index.html"><h1>SF&C RECARGAS TVE&MYFAMILY</h1></a>
    <a href="perfil.php"><button>VOLTAR</button></a>
    <a href="sair.php"><button>SAIR</button></a>
</header>

<center>
    <form class='form-editar' action="editarperfilquery.php" method="post">
        <div>
            <h5>Nome do usuário: </h5>
            <input type="text" id="inputedit" name="nomeedit" value="<?php echo "$nome_do_usuario"; ?>">
        </div>
        <br>
        <div>
            <h5>Email do usuário: </h5>
            <input type="text" id="inputedit" name="emailedit" value="<?php echo "$email_do_usuario"; ?>">
        </div>
        <br>
        <div>
            <h5>Nome de usuário: </h5>
            <input type="text" id="inputedit" name="nomeusuarioedit" value="<?php echo "$nomeusuario"; ?>">
        </div>
        <br>
        <div>
            <h5>Senha: </h5>
            <input type="password" id="inputedit" name="senhaedit" value="<?php echo "$senha"; ?>">
        </div>
        <br>
        <input class="btn-editarperfil" type="submit" value="Salvar">
    </form>
</center>

<footer>
</footer>

</body>
</html>
