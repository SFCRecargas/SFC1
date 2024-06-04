<?php
session_start();

if(!isset($_SESSION['useradmin'])) {
    header('Location: loginadmin.php');
    exit;
}

include_once('config.php');

$sql = "SELECT ID, NOME, EMAIL, NOMEUSUARIO FROM cliente";
$result = $conexao->query($sql);

$sqlv = "SELECT CODIGO, APP FROM codigos";
$resultv = $conexao->query($sqlv);

$sqlvendas = "SELECT ID, CODIGO, APP, FORMAPAGAMENTO, DATACOMPRA, CLIENTEID FROM codusados";
$resultvendas = $conexao->query($sqlvendas);

// Incluir o header
require('includes/header.html');
?>
<title>Área do administrador</title>
</head>
<body>
    <header id='header-admin'>
        <a href="index.html"><h1>SF&C RECARGAS TVE&MYFAMILY</h1></a>
        <a href="perfiladmin.php"><button>PERFIL</button></a>
        <a href="sairadmin.php"><button>SAIR</button></a>
    </header>

    <section class='lista-clientes'>
        <h2>CLIENTES</h2>
        <?php
        if ($result->num_rows > 0) {
            echo '<table border="1">';
            echo '<tr><th>ID</th><th>Nome</th><th>Email</th><th>Nome de Usuário</th><th>Ações</th></tr>';
            while($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['ID'] . '</td>';
                echo '<td>' . $row['NOME'] . '</td>';
                echo '<td>' . $row['EMAIL'] . '</td>';
                echo '<td>' . $row['NOMEUSUARIO'] . '</td>';
                echo '<td><a href="excluircliente.php?id=' . $row['ID'] . '" onclick="return confirm(\'Tem certeza que deseja excluir este cliente?\')">Excluir</a></td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo 'Nenhum cliente encontrado.';
        }
        ?>
        <a href="registro.php"><button>ADICIONAR CLIENTE</button></a>
        <a href="registromulti.php"><button>ADICIONAR MÚLTIPLOS CLIENTES</button></a>

    </section>

    <section class='lista-codigos'>
        <h2>CÓDIGOS</h2>
        <?php
        if ($resultv->num_rows > 0) {
            echo '<table border="1">';
            echo '<tr><th>CÓDIGO</th><th>APP</th><th>Ações</th></tr>';
            while($row = $resultv->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['CODIGO'] . '</td>';
                echo '<td>' . $row['APP'] . '</td>';
                echo '<td><a href="excluircodigo.php?codigo=' . $row['CODIGO'] . '" onclick="return confirm(\'Tem certeza que deseja excluir este código?\')">Excluir</a></td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo 'Nenhum código encontrado.';
        }
        ?>
        <a href="registromulticod.php"><button>ADICIONAR MÚLTIPLOS CÓDIGOS</button></a>
    </section>

    <section class='lista-codigos'>
        <h2>VENDAS</h2>
        <?php
        if ($resultvendas->num_rows > 0) {
            echo '<table border="1">';
            echo '<tr><th>ID</th><th>Código</th><th>App</th><th>Forma de pagamento</th><th>Data da compra</th><th>ID Cliente</th></tr>';
            while($row = $resultvendas->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['ID'] . '</td>';
                echo '<td>' . $row['CODIGO'] . '</td>';
                echo '<td>' . $row['APP'] . '</td>';
                echo '<td>' . $row['FORMAPAGAMENTO'] . '</td>';
                echo '<td>' . $row['DATACOMPRA'] . '</td>';
                echo '<td>' . $row['CLIENTEID'] . '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } else {
            echo 'Nenhuma venda encontrada.';
        }
        ?>
        <a href="excluirvendas.php" onclick="return confirm('Tem certeza que deseja excluir todos os registros de vendas?')"><button>EXCLUIR TODAS AS VENDAS</button></a>
    </section>
</body>

<footer id="footer"></footer>
</html>
