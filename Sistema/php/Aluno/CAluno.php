<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoolmanagerdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Falha na conexão com o banco de dados."]));
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST["nome"];
    $cpf = $_POST["cpf"];
    $email = $_POST["email"];
    $dataNascimento = $_POST["data_nascimento"];
    $senha = $_POST["senha"];

    $stmt = $conn->prepare("INSERT INTO alunos (Nome, Email, Senha) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nome, $email, $senha);

    if ($stmt->execute()) {
        echo "<script>alert('Aluno $nome cadastrado com sucesso!!'); window.location.href='../../../Sistema/System/Aluno/CAlunos.php';</script>";
    } else {
        echo "<script>alert('Erro ao cadastrar o aluno: " . $stmt->error . "'); window.location.href='../../Sistema/System/Aluno/CAlunos.php';</script>";
    }

    $stmt->close();
}

$conn->close();
?>
