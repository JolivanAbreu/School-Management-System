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

    $id_aluno = $_POST['id_aluno'];
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cpf = $_POST['cpf'];
    $data_nascimento = $_POST['data_nascimento'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];
    $nova_senha = $_POST['senha'];

    if (empty($id_aluno) || empty($nome) || empty($email)) {
        die("Erro: ID, Nome e Email são obrigatórios.");
    }

    if (!empty($nova_senha)) {
        $senha_hash = password_hash($nova_senha, PASSWORD_DEFAULT);
        $sql = "UPDATE alunos SET Nome = ?, Email = ?, CPF = ?, DataNascimento = ?, Telefone = ?, Endereco = ?, Senha = ? WHERE IdAluno = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssssi", $nome, $email, $cpf, $data_nascimento, $telefone, $endereco, $senha_hash, $id_aluno);
    } else {
        $sql = "UPDATE alunos SET Nome = ?, Email = ?, CPF = ?, DataNascimento = ?, Telefone = ?, Endereco = ? WHERE IdAluno = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssi", $nome, $email, $cpf, $data_nascimento, $telefone, $endereco, $id_aluno);
    }

    if ($stmt->execute()) {
        header("Location: ../../System/Aluno/CAlunos.php?status=success_update");
        exit();
    } else {
        echo "Erro ao atualizar o aluno: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../../System/Aluno/CAlunos.php");
    exit();
}
