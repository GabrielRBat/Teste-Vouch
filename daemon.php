<?php
$queue_key = ftok('/var/www/html/ipc-php/daemon.php', 'b');
$msg_queue = msg_get_queue($queue_key);

$dsn = 'mysql:host=localhost;dbname=Banco_Teste;charset=utf8mb4';
$usuario = 'root'; 
$senha = '';        

try 
{
    $pdo = new PDO($dsn, $usuario, $senha, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} 
catch (PDOException $e) 
{
    error_log("Erro na conexão com o banco: " . $e->getMessage());
    exit("Erro ao conectar ao banco.\n");
}

while (true) 
{
    $message = '';
    $type = 1;
    $max_size = 1024;

    if (msg_receive($msg_queue, $type, $received_type, $max_size, $message)) 
    {
        echo "Mensagem recebida: $message\n";

        $stmt = $pdo->prepare("INSERT INTO dados (dado) VALUES (:mensagem)");
        $stmt->bindParam(':mensagem', $message);

        if ($stmt->execute()) 
        {
            echo "Dado inserido com sucesso no banco!\n";
            error_log("Dado inserido no banco: $message");
        } 
        else 
        {
            echo "Erro ao inserir no banco!\n";
            error_log("Erro ao inserir no banco: $message");
        }
    }
    sleep(1);
}
?>
