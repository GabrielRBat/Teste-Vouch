<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $dado = $_POST['data']; 

    $queue_key = ftok('/var/www/html/ipc-php/daemon.php', 'b'); 
    $msg_queue = msg_get_queue($queue_key); 

    if (msg_send($msg_queue, 1, $dado, true)) 
    {
        echo "Dado enviado para o daemon com sucesso!";
    } 
    else 
    {
        echo "Erro ao enviar o dado para o daemon.";
    }
} 
else 
{
    echo "Nenhum dado foi enviado.";
}
?>
