<?php 
session_start();
if(isset($_POST['submit']) && !empty($_POST['usuario']) && !empty($_POST['senha'])) {
    // Acessar o sistema
    include_once('config.php');
    $usuario = $_POST['usuario'];
    $senha = $_POST['senha'];

    // Query SQL
    $sql = "SELECT ID, NOMEUSUARIO, EMAIL FROM cliente WHERE NOMEUSUARIO = '$usuario' AND SENHA = '$senha'";
    $result = $conexao->query($sql);

    if($result->num_rows < 1) {
        unset($_SESSION['user']);
        unset($_SESSION['senha']);
        header('Location: login.php');
        echo "Credenciais incorretas";
    } else {
        $row = $result->fetch_assoc();
        $_SESSION['email'] = $row['EMAIL'];
        $_SESSION['user_id'] = $row['ID'];
        $_SESSION['user'] = $row['NOMEUSUARIO'];
        $_SESSION['senha'] = $senha;
        header('Location: areacliente.php');
        exit();
    }
} else {
    // Não acessa
    echo "Erro, acesso não autorizado";
    header('Location: login.php');
    exit();
}
?>
