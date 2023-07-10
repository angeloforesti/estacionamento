<?php
// Informações de conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "estacionamento";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $carro_id = $_POST['carro_id'];

    // Excluindo o carro do banco de dados
    $sql = "DELETE FROM carros WHERE id = '$carro_id'";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Carro removido do estacionamento com sucesso!</p>";
        echo "<a href='estacionamento.php'>Voltar</a>";
    } else {
        echo "Erro ao remover o carro do estacionamento: " . $conn->error;
    }
}

// Fechando a conexão com o banco de dados
$conn->close();
?>
