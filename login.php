<!DOCTYPE html>
<html>
<head>
    <title>Tela de Login</title>
</head>
<body>
    <h2>Login</h2>
    <form method="POST" action="login.php">
        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required><br><br>
        
        <label for="senha">Senha:</label>
        <input type="password" name="senha" id="senha" required><br><br>
        
        <input type="submit" value="Entrar">
    </form>

    <?php
    // Informações de conexão com o banco de dados
    $serverName = "localhost";
    $userName  = "root";
    $passwordDb = "";
    $dbName = "estacionamento";


    // Conexão com o banco de dados
    $conn = new mysqli($serverName, $userName, $passwordDb, $dbName);
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nome = $_POST['nome'];
        $senha = $_POST['senha'];

        // Consulta para verificar as credenciais de login
        $sql = "SELECT * FROM cad_admin WHERE nome = '$nome' AND senha = '$senha'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            // Credenciais corretas, redirecionar para a página estacionamento.php
            header("Location: estacionamento.php");
            exit();
        } else {
            echo "<p>Credenciais inválidas. Tente novamente.</p>";
        }
    }

    // Fechando a conexão com o banco de dados
    $conn->close();
    ?>
</body>
</html>
