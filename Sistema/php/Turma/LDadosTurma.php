<?php

header("Content-Type: application/json");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoolmanagerdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die(json_encode(["error" => "Falha na conexão com o banco de dados: " . $conn->connect_error]));
}

$professores = [];
$disciplinas = [];

$sql_professores = "SELECT IdProfessor, Nome FROM professores ORDER BY Nome ASC";
$result_professores = $conn->query($sql_professores);

if ($result_professores) {
    while ($row = $result_professores->fetch_assoc()) {
        $professores[] = $row;
    }
}

$sql_disciplinas = "SELECT IdDisciplina, Nome FROM disciplinas ORDER BY Nome ASC";
$result_disciplinas = $conn->query($sql_disciplinas);

if ($result_disciplinas) {
    while ($row = $result_disciplinas->fetch_assoc()) {
        $disciplinas[] = $row;
    }
}

$data = [
    "professores" => $professores,
    "disciplinas" => $disciplinas
];

echo json_encode($data);

$conn->close();
