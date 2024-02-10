<?php

$hostname = "localhost"; // endereço do banco de dados
$database = "site1";
$user = "root";
$password = "";

$mysqli = new mysqli($hostname, $user, $password, $database);
if ($mysqli->connect_errno) {
    echo "Falha ao conectar: (" . $mysqli->connect_connect_errno . ")" . $mysqli->connect_error;
}
//else
//  echo "Conectado!";

$conn = new mysqli($hostname, $user, $password, $database);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $mensagem = isset($_POST["mensagem"]) ? $_POST["mensagem"] : null;
    // Verificar se todos os campos obrigatórios estão preenchidos
    if ($mensagem !== null) {
        // imprimir no console
        echo 'Mensagem recebida no PHP: ' . $mensagem;
         // Montar a consulta SQL
        $sql = $conn->prepare("SELECT * FROM site1 WHERE codigo = ?");
        $sql->bind_param("s", $mensagem);

         // Executar a consulta SQL
        if ($sql->execute()) {
        // Obter resultados
            $result = $sql->get_result();

        // Verificar se há linhas retornadas
        if ($result->num_rows > 0) {
             $data = array();
            echo "<table border='1'>";

                while ($row = $result->fetch_assoc()) {
                    $data[] = array(
            'Nome_laboratorio' => $row['Nome_laboratorio'],
            'item' => $row['item'],
            'codigo' => $row['codigo']
        );
                }

                echo "</table>";
        } else {
            echo "Código não é igual à mensagem.";
        }
    } else {
        echo "Erro ao consultar dados: " . $sql->error;
    }

    // Fechar a declaração preparada
    $sql->close();
    } else {
        echo "Por favor, preencha todos os campos obrigatórios.";
    }
} else {
    echo 'Método de requisição inválido';
}
 // Converte o array para JSON
    $json_data = json_encode($data);

    // Imprime o JSON
    echo $json_data;
// Fechar a conexão com o banco de dados
$conn->close();
?>
