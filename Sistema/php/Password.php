<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoolmanagerdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

function limpar_dados($dados)
{
    $dados = trim($dados);
    $dados = stripslashes($dados);
    $dados = htmlspecialchars($dados);
    return $dados;
}

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $nova_senha = trim($_POST['nova_senha']);
    $confirmar_senha = trim($_POST['confirmar_senha']);

    // Verifica se os campos foram preenchidos
    if (empty($email) || empty($nova_senha) || empty($confirmar_senha)) {
        echo '<script>alert("Por favor, preencha todos os campos!"); window.location.href = "../Senha.php";</script>';
        exit();
    }

    // Valida se as senhas coincidem
    if ($nova_senha !== $confirmar_senha) {
        echo '<script>alert("As senhas não coincidem!"); window.location.href = "../Senha.php";</script>';
        exit();
    }

    // Atualiza a senha no banco de dados sem hash
    $sql_update = "UPDATE professores SET senha = ? WHERE email = ?";
    $stmt = $conn->prepare($sql_update);
    $stmt->bind_param("ss", $nova_senha, $email);

    if ($stmt->execute() && $stmt->affected_rows > 0) {
        echo '<script>alert("Senha alterada com sucesso!"); window.location.href = "../Login.php";</script>';
    } else {
        echo '<script>alert("Erro ao alterar senha ou email não encontrado!"); window.location.href = "../Senha.php";</script>';
    }

    $stmt->close();
}
