<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoolmanagerdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Falha na conexão com o banco de dados."]));
}

$nome = $_POST['nome'];
$email = $_POST['email'];

$senhaPadrao = password_hash("123456", PASSWORD_DEFAULT);

$sql = "INSERT INTO alunos (Nome, Email, Senha) VALUES (?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sss", $nome, $email, $senhaPadrao);

if ($stmt->execute()) {
    echo "<script>alert('Aluno cadastrado com sucesso!'); window.location.href = '../../System/Aluno/CAlunos.php'</script>";
} else {
    echo "<script>alert('Erro ao cadastrar aluno: " . $stmt->error . "'); window.history.back();</script>";
}

$stmt->close();
$conn->close();
?>
