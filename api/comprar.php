<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit();
}
require('config.php');

function getNextAvailableCode($app, $conexao) {
    $stmt = $conexao->prepare("SELECT * FROM codigos WHERE APP = ? ORDER BY CODIGO ASC LIMIT 1");
    $stmt->bind_param("s", $app);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Assuming ClienteID is stored in session
$cliente_id = $_SESSION['user_id']; // Verifique se a chave da sessão está correta

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Comprar Código</title>
<link rel="stylesheet" href="styles/style.css" media="all">
</head>
<body>
<header>
    <a href="index.html"><h1>SF&C RECARGAS TVE&MYFAMILY</h1></a>
    <a href="areacliente.php"><button>VOLTAR</button></a>
</header>


<div class='comprar-codigo'>
<h2>Comprar Código de Recarga</h2>
<h4>TVE</h4>
<form action="pagamentoTVE.php" method="post">
    <?php
    $codigo_row = getNextAvailableCode('TVE', $conexao);
    if ($codigo_row) {
        $codigo = $codigo_row['CODIGO'];
        $app = $codigo_row['APP'];
        echo "<input type='hidden' name='codigo' value='$codigo'>";
        echo "<input type='hidden' name='app' value='$app'>";
        echo "<input type='hidden' name='cliente_id' value='$cliente_id'>"; // Verifique se está sendo passado corretamente
        echo "<button type='submit'>Pagar via Pix</button>";
    } else {
        echo "Nenhum código disponível no momento.";
    }
    ?>
</form>

<h4>MyFamily</h4>
<form action="pagamentoMyFamily.php" method="post">
    <?php
    $codigo_row = getNextAvailableCode('MyFamily', $conexao);
    if ($codigo_row) {
        $codigo = $codigo_row['CODIGO'];
        $app = $codigo_row['APP'];
        echo "<input type='hidden' name='codigo' value='$codigo'>";
        echo "<input type='hidden' name='app' value='$app'>";
        echo "<input type='hidden' name='cliente_id' value='$cliente_id'>"; // Verifique se está sendo passado corretamente
        echo "<button type='submit'>Pagar via Pix</button>";
    } else {
        echo "Nenhum código disponível no momento.";
    }
    ?>
</form>
</div>

</body>
</html>
