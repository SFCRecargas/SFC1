<?php 
include_once('config.php');
session_start();

// Verificar se o usuário está logado
if(!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}

// Mostrar informações do usuário
$logado = $_SESSION['user'];
$sql = "SELECT ID, NOME, EMAIL FROM cliente WHERE NOMEUSUARIO = '$logado'";
$result = $conexao->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nome_do_usuario = $row['NOME'];
    $email_do_usuario = $row['EMAIL'];
    $id = $row['ID'];
} else {
    // Tratar erros na execução da consulta ou usuário não encontrado
    echo "Erro ao buscar informações do usuário: " . $conexao->error;
    exit();
}

require('includes/header.html');
?>

<title>Perfil</title>
</head>
<header id='header-cliente'>
        <a href="index.html"><h1>SF&C RECARGAS TVE&MYFAMILY</h1></a>
        <a href="areacliente.php"><button>VOLTAR</button></a>
        <a href="sair.php"><button>SAIR</button></a>
    </header>
<body>
    <section class='perfil-dados'>
    <h1>PERFIL</h1>
        <label for="nome"><h3>Nome do usuário: </h3><?php echo "<p>$nome_do_usuario</p>"; ?></label>
        <label for="nome"><h3>Nome de usuário: </h3><?php echo "<p>$logado</p>"; ?></label>
        <label for="email"><h3>Email do usuário: </h3><?php echo "<p>$email_do_usuario</p>"; ?></label>
        <label for="id"><h3>ID do usuário: </h3><?php echo "<p>$id</p>"; ?></label>
        <a href="editarperfilc.php"><div class="btn-editarperfil"><button>EDITAR</button></div></a>
        <!-- <a href="excluirperfil.php"><div id="btn-excluirperfil">Excluir Perfil</div></a> -->
</section>
    <footer></footer>
</body>
</html>
