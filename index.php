<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar dados</title>
</head>
<body>
    <h1>Envio de Dados para o Daemon</h1>
    <form action="queue_handler.php" method="POST">
        <label for="data">Digite o dado:</label>
        <input type="text" id="data" name="data" required>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>
