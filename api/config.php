<?php
$dbHost = 'viaduct.proxy.rlwy.net:51744';
$dbUsername = 'root';
$dbPassword = 'FsymiHVcAUxOFcVroEizdcBkGzKNchml';
$dbName = 'railway';

$conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if($conexao->connect_errno){
    echo "Erro: " . $conexao->connect_error;
} else {
    // echo "Conexão efetuada com sucesso";
}
?>
