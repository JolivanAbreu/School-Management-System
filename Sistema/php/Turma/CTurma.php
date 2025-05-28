<?php
header("Content-Type: application/json");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoolmanagerdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["success" => false, "message" => "Falha na conexão com o banco de dados."]));
}

// Lista de professores
$resultProf = $conn->query("SELECT IdProfessor, Nome FROM professores");
$professores = [];
while ($row = $resultProf->fetch_assoc()) {
    $professores[] = $row;
}

// Lista de disciplinas
$resultDisc = $conn->query("SELECT IdDisciplina, Nome FROM disciplinas");
$disciplinas = [];
while ($row = $resultDisc->fetch_assoc()) {
    $disciplinas[] = $row;
}

// Retorno em JSON
echo json_encode([
    'professores' => $professores,
    'disciplinas' => $disciplinas
]);

$conn->close();
