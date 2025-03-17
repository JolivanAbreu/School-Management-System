<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoolmanagerdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Falha na conexão com o banco de dados."]));
}

$professoresQuery = "SELECT IdProfessor, Nome FROM Professores";
$professoresResult = $conn->query($professoresQuery);

$disciplinasQuery = "SELECT IdDisciplina, Nome FROM Disciplinas";
$disciplinasResult = $conn->query($disciplinasQuery);


$conn->close();

// Gerar arrays para retorno em JSON
$professores = [];
if ($professoresResult->num_rows > 0) {
    while ($row = $professoresResult->fetch_assoc()) {
        $professores[] = ["id" => $row['IdProfessor'], "nome" => $row['Nome']];
    }
}
// Verificar se há resultados
if ($disciplinasResult->num_rows > 0) {
    while ($row = $disciplinasResult->fetch_assoc()) {
        $disciplinas[] = ["id" => $row['IdDisciplina'], "nome" => $row['Nome']];
    }
} else {
    $disciplinas[] = ["id" => "0", "nome" => "Nenhuma disciplina encontrada"];
}

echo json_encode(["professores" => $professores, "disciplinas" => $disciplinas]);
