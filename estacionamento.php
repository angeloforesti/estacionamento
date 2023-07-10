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
    $modelo = $_POST['modelo'];
    $placa = $_POST['placa'];
    $situacao = 0;

    // Inserindo os dados do carro no banco de dados
    $sql = "INSERT INTO carros (modelo, placa, situacao) VALUES ('$modelo', '$placa', '$situacao')";

    if ($conn->query($sql) === TRUE) {
        echo "<p>Carro cadastrado com sucesso!</p>";
    } else {
        echo "Erro no cadastro do carro: " . $conn->error;
    }
}

// Consulta para recuperar os carros estacionados
$sql = "SELECT * FROM carros WHERE situacao = 0";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Estacionamento</title>
</head>
<body>
    <h2>Cadastro de Carros</h2>
    <form method="POST" action="estacionamento.php">
        <label for="modelo">Modelo:</label>
        <input type="text" name="modelo" id="modelo" required><br><br>
        
        <label for="placa">Placa:</label>
        <input type="text" name="placa" id="placa" required><br><br>
        
        <input type="submit" value="Cadastrar">
    </form>
    
    <h2>Carros Estacionados</h2>
    <?php
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Modelo</th><th>Placa</th><th>Ação</th></tr>";

        while ($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["modelo"] . "</td><td>" . $row["placa"] . "</td><td><form method='POST' action='sair_carro.php'><input type='hidden' name='carro_id' value='" . $row["id"] . "'><input type='submit' value='Sair'></form></td></tr>";
        }

        echo "</table>";
    } else {
        echo "<p>Nenhum carro estacionado no momento.</p>";
    }
    ?>

</body>
</html>
