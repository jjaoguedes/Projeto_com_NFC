<!-- exemplo.php -->
<?php
$resposta = 'Resposta do PHP: ' . date('Y-m-d H:i:s');

// Configurar o cabeçalho para permitir a origem (CORS)
header('Access-Control-Allow-Origin: *');
header('Content-Type: text/plain');

// Enviar a resposta ao cliente
echo $resposta;
?>
