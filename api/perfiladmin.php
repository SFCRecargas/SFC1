<?php 
include_once('config.php');
session_start();

// Verificar se o usuário está logado
if(!isset($_SESSION['useradmin'])) {
    header('Location: loginadmin.php');
    exit();
}

// Mostrar informações do usuário
$logado = $_SESSION['useradmin'];
$id = $_SESSION['id'];
$sql = "SELECT NOME, EMAIL, CHAVEPIX FROM administrador WHERE ID = '$id'";
$result = $conexao->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nome_do_usuario = $row['NOME'];
    $email_do_usuario = $row['EMAIL'];
    $chavepix_do_usuario = $row['CHAVEPIX'];
} else {
    // Tratar erros na execução da consulta ou usuário não encontrado
    echo "Erro ao buscar informações do usuário: " . $conexao->error;
    exit();
}

require('includes/header.html');
?>

<title>Perfil - administrador</title>
</head>
<header id='header-cliente'>
        <a href="index.html"><h1>SF&C RECARGAS TVE&MYFAMILY</h1></a>
        <a href="admin.php"><button>VOLTAR</button></a>
        <a href="sairadmin.php"><button>SAIR</button></a>
    </header>
<body>
    <section class='perfil-dados'>
    <h1>PERFIL</h1>
        <label for="nome"><h3>Nome do usuário: </h3><?php echo "<p>$nome_do_usuario</p>"; ?></label>
        <label for="nome"><h3>Nome de usuário: </h3><?php echo "<p>$logado</p>"; ?></label>
        <label for="email"><h3>Email do usuário: </h3><?php echo "<p>$email_do_usuario</p>"; ?></label>
        <a href="editarperfiladmin.php"><div class="btn-editarperfil"><button>EDITAR</button></div></a>
        <!-- <a href="excluirperfil.php"><div id="btn-excluirperfil">Excluir Perfil</div></a> -->
</section>
    <footer></footer>
</body>
</html>
