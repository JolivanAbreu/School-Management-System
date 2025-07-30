<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoolmanagerdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Falha na conexão com o banco de dados: " . $conn->connect_error);
}

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];

if (empty($nome)) {
    echo "<script>alert('O nome da disciplina é obrigatório.'); window.history.back();</script>";
    exit();
}

$sql = "INSERT INTO disciplinas (Nome, Descricao) VALUES (?, ?)";

$stmt = $conn->prepare($sql);

if ($stmt === false) {
    echo "<script>alert('Erro ao preparar a consulta: " . $conn->error . "'); window.history.back();</script>";
    exit();
}

$stmt->bind_param("ss", $nome, $descricao);

if ($stmt->execute()) {
    echo "<script>alert('Disciplina cadastrada com sucesso!'); window.location.href = '../../System/Disciplina/CDisciplinas.php';</script>";
} else {
    echo "<script>alert('Erro ao cadastrar disciplina: " . $stmt->error . "'); window.history.back();</script>";
}


$stmt->close();
$conn->close();
