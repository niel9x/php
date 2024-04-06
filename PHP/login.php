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
session_start();

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
    $usuario = mysqli_real_escape_string($conn, $_POST['Usuario']); // Aqui usei o nome 'Usuario' que corresponde ao atributo 'name' do campo de entrada no HTML
    $senha = mysqli_real_escape_string($conn, $_POST['password']); // Aqui usei o nome 'password' que corresponde ao atributo 'name' do campo de entrada no HTML

    // Consulta o banco de dados para verificar as credenciais do usuário
    $sql = "SELECT * FROM USER_REG WHERE USUARIO='$usuario' AND PASSWORD='$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        // As credenciais são válidas, o usuário pode ser autenticado
        $_SESSION['username'] = $usuario;
        echo "quem leu é gay!"; // Redireciona para a página de dashboard após o login
    } else {
        echo "
        <div class='container'>
            <div class='options'>
                <h1>Credenciais inválidas. <br>Por favor, tente novamente.<h1>
            </div>
        </div>
        ";
    }

    // Fecha a conexão com o banco de dados
    $conn->close();
}
?>
    

</body>
</html>