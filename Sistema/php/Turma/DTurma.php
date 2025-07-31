<?php

header("Content-Type: application/json");

header("Access-Control-Allow-Methods: POST");

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $data = json_decode(file_get_contents("php://input"));

    if (!isset($data->id) || empty($data->id)) {
        echo json_encode(["success" => false, "message" => "ID da turma não foi fornecido."]);
        exit();
    }

    $id_turma = $data->id;

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "shoolmanagerdb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        echo json_encode(["success" => false, "message" => "Falha na conexão com o banco de dados: " . $conn->connect_error]);
        exit();
    }

    $sql = "DELETE FROM turmas WHERE IdTurma = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("i", $id_turma);

    if ($stmt->execute()) {
        if ($stmt->affected_rows > 0) {
            echo json_encode(["success" => true, "message" => "Turma deletada com sucesso!"]);
        } else {
            echo json_encode(["success" => false, "message" => "Nenhuma turma encontrada com o ID fornecido."]);
        }
    } else {
        echo json_encode(["success" => false, "message" => "Erro ao executar a exclusão: " . $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(["success" => false, "message" => "Método não permitido."]);
}
