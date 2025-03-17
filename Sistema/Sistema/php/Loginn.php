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

// Sessão de login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = limpar_dados($_POST['email']);
    $senha = limpar_dados($_POST['senha']);

    // Verificar se é professor
    $sql_professores = "SELECT * FROM professores WHERE email=? AND senha=?";
    $stmt_professores = $conn->prepare($sql_professores);
    $stmt_professores->bind_param("ss", $email, $senha);
    $stmt_professores->execute();
    $result_professores = $stmt_professores->get_result();

    if ($result_professores->num_rows == 1) {
        $row = $result_professores->fetch_assoc();
        $_SESSION['IdProfessor'] = $row['IdProfessor'];
        $_SESSION['Nome'] = $row['Nome'];
        $_SESSION['tipo'] = 'professores';
        header("Location:../System/Admin.php");
        exit();
    }

    // Verificar se é aluno
    $sql_aluno = "SELECT * FROM alunos WHERE email=? AND senha=?";
    $stmt_aluno = $conn->prepare($sql_aluno);
    $stmt_aluno->bind_param("ss", $email, $senha);
    $stmt_aluno->execute();
    $result_aluno = $stmt_aluno->get_result();

    if ($result_aluno->num_rows == 1) {
        // Caso o login seja de um aluno, exibe uma mensagem de alerta e impede o login
        echo "<script>alert('Acesso negado! Alunos não têm permissão para acessar o sistema.');</script>";
        echo "<script>window.location.href = '../System/School.php';</script>";
        exit();
    }
    
    echo "Login inválido";
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location:../School.php");
    exit();
}
