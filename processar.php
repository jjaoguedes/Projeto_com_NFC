<?php
header('Content-Type: text/plain');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mensagem = $_POST['mensagem'] ?? '';

    // Faça algo com a mensagem, por exemplo, imprimir no console
    echo 'Mensagem recebida no PHP: ' . $mensagem;
} else {
    echo 'Método de requisição inválido';
}
?>