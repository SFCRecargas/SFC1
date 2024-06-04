<?php 
session_start();
if(isset($_POST['submit']) && !empty($_POST['usuarioadmin']) && !empty($_POST['senhaadmin'])) {
    // Acessar o sistema
    include_once('config.php');
    $usuario = $_POST['usuarioadmin'];
    $senha = $_POST['senhaadmin'];

    // Query SQL
    $sql = "SELECT ID, NOMEUSUARIO FROM administrador WHERE NOMEUSUARIO = '$usuario' AND SENHA = '$senha'";
    $result = $conexao->query($sql);

    if($result && mysqli_num_rows($result) > 0) {
        $row = $result->fetch_assoc();
        $_SESSION['id'] = $row['ID'];
        $_SESSION['useradmin'] = $row['NOMEUSUARIO'];
        $_SESSION['senhaadmin'] = $senha;
        header('Location: admin.php');
    } else {
        unset($_SESSION['useradmin']);
        unset($_SESSION['senhaadmin']);
        echo "Credenciais incorretas";
        header('Location: loginadmin.php');
    }
} else {
    // Não acessa
    echo "Erro, acesso não autorizado";
    header('Location: loginadmin.php');
}
?>
