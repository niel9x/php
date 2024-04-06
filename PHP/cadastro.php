<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>


<?php
// Verifica se os dados foram enviados pelo formulário
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conecta ao banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "CADASTRO";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }

    // Escapa os dados enviados pelo formulário para evitar SQL Injection
    $usuario = mysqli_real_escape_string($conn, $_POST['Usuario']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $senha = mysqli_real_escape_string($conn, $_POST['password']);

    // Insere os dados na tabela do banco de dados
    $sql = "INSERT INTO USER_REG (USUARIO, EMAIL, PASSWORD) VALUES ('$usuario', '$email', '$senha')";

    if ($conn->query($sql) === TRUE) {
        echo "
        <div class='container'>
        <div class='options'>
            <h1>Registro concluido!<h1>
            <div class='logbtn'>
        <a href='php/login.php'>
            <button class='btn'>Entre já!</button>
        </a>
        </div>
        </div>
        </div> <br>";

        
    } else {
        echo "Erro ao inserir registro: " . $conn->error;
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
}
?>

</body>
</html>