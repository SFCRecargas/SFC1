<?php 
include_once('config.php');
session_start();

// Verificar se o usuário está logado
if(!isset($_SESSION['useradmin'])) {
    header('Location: login.php');
    exit();
}

// Mostrar informações do usuário
$logado = $_SESSION['id'];
$sql = "SELECT NOME, EMAIL, SENHA, CHAVEPIX FROM administrador WHERE ID = '$logado'";
$result = $conexao->query($sql);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nome_do_usuario = $row['NOME'];
    $email_do_usuario = $row['EMAIL'];
    $chavepix_do_usuario = $row['CHAVEPIX'];
    $senha = $row['SENHA'];
} else {
    // Tratar erros na execução da consulta ou usuário não encontrado
    echo "Erro ao buscar informações do administrador: " . $conexao->error;
    exit();
}

require('includes/header.html');
?>
<title>Editar perfil - administrador</title>
  </head>
  <body>

  <header id='header-cliente'>
        <a href="index.html"><h1>SF&C RECARGAS TVE&MYFAMILY</h1></a>
        <a href="admin.php"><button>VOLTAR</button></a>
        <a href="sairadmin.php"><button>SAIR</button></a>
    </header>
      
        <form class='form-editar' action="editarperfilqueryadmin.php" method="post">
            <div>
            <h5>Nome do usário: </h5> <input type="text" id="inputedit" name="nomeedit" value="<?php echo "$nome_do_usuario"; ?>">
            </div>
            <br>
            <div>
            <h5>Email do usário: </h5> <input type="text" id="inputedit" name="emailedit" value="<?php echo "$email_do_usuario"; ?>">
            </div>
            <br>
            <div>
            <h5>Nome de usário: </h5> <input type="text" id="inputedit" name="nomeusuarioedit" value="<?php echo "$logado"; ?>">
            </div>
            <br>
            <div>
            <h5>Senha: </h5> <input type="password" id="inputedit" name="senhaedit" value="<?php echo "$senha"; ?>">
            </div>
            <br>
            <div>
            <h5>Chave pix: </h5> <input type="text" id="inputedit" name="pixedit" value="<?php echo "$chavepix_do_usuario"; ?>">
            </div>
            <br>
            <input class="btn-editarperfil" type="submit" value="Salvar">
            </form>
</center>
        </div>
        </div>
      </section>
      </main>

      <footer>
        
    </footer>

    </body>
    </html>