<?php
header('Content-Type: application/json; charset=utf-8');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoolmanagerdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    echo json_encode(["success" => false, "message" => "Falha na conexão com o banco de dados.", "error" => $conn->connect_error]);
    exit;
}

$query = "SELECT IdTurma, Nome FROM Turmas";
$result = $conn->query($query);

if (!$result) {
    echo json_encode(["success" => false, "message" => "Erro ao buscar turmas.", "error" => $conn->error]);
    exit;
}

$turmas = [];
while ($row = $result->fetch_assoc()) {
    $turmas[] = ["id" => $row['IdTurma'], "nome" => $row['Nome']];
}

$conn->close();

echo json_encode($turmas);
