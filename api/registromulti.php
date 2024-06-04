<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="shortcut icon" href="img/logotab.png" type="image/x-icon" />
<link rel="stylesheet" href="styles/style.css" media="all" />
<link rel="stylesheet" href="styles/media-query.css" />
<title>Registro - múltiplos clientes</title>
</head>
<body>
    <header>
        <a href="index.html"><h1>SF&C RECARGAS TVE&MYFAMILY</h1></a>
        <a href="admin.php"><button>VOLTAR</button></a>
    </header>

    <div class='adclientes'>
    <h2 class='h2'>Adicionar Múltiplos Clientes</h2><br>
    <form action="adicionarclientes.php" method="post" class='registro'>
        <div id="clientes">
            <div class="cliente">
                <h3>Cliente 1</h3>
                <label for="nome[]">Nome:</label>
                <input type="text" name="nome[]" required><br>
                <label for="email[]">Email:</label>
                <input type="email" name="email[]" required><br>
                <label for="nomeusuario[]">Nome de Usuário:</label>
                <input type="text" name="nomeusuario[]" required><br>
                <label for="senha[]">Senha:</label>
                <input type="password" name="senha[]" required><br><br>
            </div>
        </div>
        <button type="button" onclick="adicionarCliente()">Adicionar Outro Cliente</button><br><br>
        <input type="submit" value="Adicionar Clientes">
    </form>
    </div>

    <script>
        let clienteCount = 1;

        function adicionarCliente() {
            clienteCount++;
            const clienteDiv = document.createElement('div');
            clienteDiv.classList.add('cliente');
            clienteDiv.innerHTML = `
                <h3>Cliente ${clienteCount}</h3>
                <label for="nome[]">Nome:</label>
                <input type="text" name="nome[]" required><br>
                <label for="email[]">Email:</label>
                <input type="email" name="email[]" required><br>
                <label for="nomeusuario[]">Nome de Usuário:</label>
                <input type="text" name="nomeusuario[]" required><br>
                <label for="senha[]">Senha:</label>
                <input type="password" name="senha[]" required><br><br>
            `;
            document.getElementById('clientes').appendChild(clienteDiv);
        }
    </script>
</body>
</html>
