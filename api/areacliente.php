<?php 
include_once('config.php');
session_start();

// Verificar se o usuário está logado
if(!isset($_SESSION['user_id'])) {
    unset($_SESSION['user']);
    unset($_SESSION['user_id']);
    header('Location: login.php');
    exit();
}

$logado = $_SESSION['user'];
$user_id = $_SESSION['user_id'];
require('includes/header.html');

// Mostrar nome do usuário
$sql = "SELECT NOME FROM cliente WHERE ID = '$user_id'";
$nome_result = $conexao->query($sql);

if ($nome_result && $nome_result->num_rows > 0) {
    $nome_row = $nome_result->fetch_assoc();
    $nome_do_usuario = $nome_row['NOME'];
} else {
    echo "Erro ao buscar o nome do usuário: " . $conexao->error;
    echo "<a href='sair.php'><button>sair e entrar novamente</button></a>";
    
    exit();
}
?>

<title>Cliente</title>
</head>
<body class='body-cliente'>
    <header id='header-cliente'>
        <a href="index.html"><h1>SF&C RECARGAS TVE&MYFAMILY</h1></a>
        <a href="perfil.php"><button>PERFIL</button></a>
        <a href="sair.php"><button>SAIR</button></a>
    </header>
    <h3> <center><label for="nome"><h3>Olá, </h3><?php echo "<p>$nome_do_usuario</p>"; ?></label></h3>
</center>

    <section class=comprar-codigo>
        <a href="comprar.php"><button>COMPRAR CÓDIGO DE RECARGA</button></a>
    </section>
</body>

<footer id="footer"></footer>
</html>
