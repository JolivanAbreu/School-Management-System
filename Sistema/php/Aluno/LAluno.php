<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shoolmanagerdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}

$sql = "SELECT IdAluno, Nome, Email FROM alunos";
$result = $conn->query($sql);
?>

<div class="Visualização">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2>Listagem de <b>Alunos</b></h2>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>
                        <input type="checkbox" id="selectAll">
                    </th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td>
                                <input type="checkbox" id="checkbox<?php echo $row['IdAluno']; ?>" name="options[]" value="<?php echo $row['IdAluno']; ?>">
                            </td>
                            <td><?php echo htmlspecialchars($row['Nome']); ?></td>
                            <td><?php echo htmlspecialchars($row['Email']); ?></td>
                            <td>
                                <a href="editar_aluno.php?id=<?php echo $row['IdAluno']; ?>" class="edit" data-toggle="modal">
                                    <i class="fa-solid fa-pen"></i>
                                </a>
                                <a href="excluir_aluno.php?id=<?php echo $row['IdAluno']; ?>" class="delete" data-toggle="modal">
                                    <i class="fa-solid fa-trash" id="delete"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Nenhum aluno cadastrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php
$conn->close();
?>
