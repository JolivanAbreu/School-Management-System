<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "shoolmanagerdb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Erro na conexão: " . $conn->connect_error);
    }

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $data_nascimento = $_POST['data_nascimento'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

    if (empty($nome) || empty($email) || empty($_POST['senha'])) {
        die("Erro: Nome, Email e Senha são obrigatórios.");
    }

    $sql = "INSERT INTO alunos (Nome, Email, CPF, DataNascimento, Telefone, Endereco, Senha) VALUES (?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("sssssss", $nome, $email, $cpf, $data_nascimento, $telefone, $endereco, $senha);

    if ($stmt->execute()) {
        header("Location: ../../System/Aluno/CAlunos.php?status=success_create");
        exit();
    } else {
        echo "Erro ao cadastrar o aluno: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();

} else {
    header("Location: ../../System/Aluno/CAlunos.php");
    exit();
}
?>