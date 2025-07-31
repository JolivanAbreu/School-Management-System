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

    $id_turma = $_POST['id_turma'];
    $nome = $_POST['nome'];
    $professor_id = $_POST['professor_id'];
    $disciplina_id = $_POST['disciplina_id'];


    if (empty($id_turma) || empty($nome) || empty($professor_id) || empty($disciplina_id)) {
        die("Erro: Dados incompletos.");
    }

    $sql = "UPDATE turmas SET Nome = ?, IdProfessor = ?, IdDisciplina = ? WHERE IdTurma = ?";

    $stmt = $conn->prepare($sql);

    $stmt->bind_param("siii", $nome, $professor_id, $disciplina_id, $id_turma);

    if ($stmt->execute()) {
        header("Location: ../../System/Turma/CTurmas.php?status=success_update");
        exit();
    } else {
        echo "Erro ao atualizar a turma: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../../System/Turma/CTurmas.php");
    exit();
}
