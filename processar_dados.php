<?php
// Verifica se a requisição é POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Recebe os dados NFC do cliente
  $nfcData = json_decode(file_get_contents('php://input'), true);

  // Verifica se os dados foram recebidos corretamente
  if (isset($nfcData['nfcData'])) {
    // Obtém os dados da tag NFC
    $dadosDaTag = $nfcData['nfcData'];

    // Imprime os dados ou realiza outras operações
    echo "Dados lidos da tag NFC: " . implode(", ", $dadosDaTag);
  } else {
    // Se os dados não foram recebidos corretamente, retorna um erro
    header('HTTP/1.1 400 Bad Request');
    echo json_encode(['error' => 'Dados NFC ausentes na requisição']);
  }
} else {
  // Se a requisição não for POST, retorna um erro
  header('HTTP/1.1 405 Method Not Allowed');
  echo json_encode(['error' => 'Método não permitido']);
}
?>
