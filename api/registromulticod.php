<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="shortcut icon" href="img/logotab.png" type="image/x-icon" />
<link rel="stylesheet" href="styles/style.css" media="all" />
<link rel="stylesheet" href="styles/media-query.css" />
<title>Registro - múltiplos códigos</title>
</head>
<body>
    <header>
        <a href="index.html"><h1>SF&C RECARGAS TVE&MYFAMILY</h1></a>
        <a href="admin.php"><button>VOLTAR</button></a>
    </header>

    <div class='adclientes'>
    <h2 class='h2'>Adicionar Múltiplos Códigos</h2><br>
    <form action="registrarcodigos.php" method="post" class='registro'>
        <div id="clientes">
            <div class="cliente">
                <h3>Código 1</h3>
                <label for="codigo[]">Código:</label>
                <input type="text" name="codigo[]" required><br>
                <label for="app[]">App:</label>
                <select class='selecao' name="app[]" required>
                    <option value="TVE">TVE</option>
                    <option value="MyFamily">MyFamily</option>
                </select><br><br>
            </div>
        </div>
        <button type="button" onclick="adicionarCodigo()">Adicionar Outro Código</button><br><br>
        <input type="submit" value="Adicionar CÓDIGOS">
    </form>
    </div>

    <script>
        let clienteCount = 1;

        function adicionarCodigo() {
            clienteCount++;
            const clienteDiv = document.createElement('div');
            clienteDiv.classList.add('cliente');
            clienteDiv.innerHTML = `
                <h3>Código ${clienteCount}</h3>
                <label for="codigo[]">Código:</label>
                <input type="text" name="codigo[]" required><br>
                <label for="app[]">App:</label>
                <select class='selecao' name="app[]" required>
                    <option value="TVE">TVE</option>
                    <option value="MyFamily">MyFamily</option>
                </select><br><br>
            `;
            document.getElementById('clientes').appendChild(clienteDiv);
        }
    </script>
</body>
</html>
