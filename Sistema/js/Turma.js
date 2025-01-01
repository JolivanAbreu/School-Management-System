// Carregar professores e disciplinas ao carregar a página
window.addEventListener('load', function () {
    fetch("CTurmas.php")
        .then(response => response.json())
        .then(data => {
            console.log(data); // Verifique no console os dados carregados

            // Carregar professores
            let professorSelect = document.getElementById("professor");
            data.professores.forEach(professor => {
                let option = document.createElement("option");
                option.value = professor.IdProfessor;
                option.textContent = professor.Nome;
                professorSelect.appendChild(option);
            });

            // Carregar disciplinas
            let disciplinaSelect = document.getElementById("disciplina");
            data.disciplinas.forEach(disciplina => {
                let option = document.createElement("option");
                option.value = disciplina.IdDisciplina;
                option.textContent = disciplina.Nome;
                disciplinaSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Erro ao carregar dados:', error));
});

document.getElementById("form-turma").addEventListener("submit", function (e) {
    e.preventDefault();

    var professorSelect = document.getElementById("professor");
    var selectedProfessor = professorSelect.value;

    var disciplinaSelect = document.getElementById("disciplina");
    var selectedDisciplina = disciplinaSelect.value;

    var dia = document.getElementById("dia").value;
    var horario = document.getElementById("horario").value;

    var turma = {
        professor: selectedProfessor,
        disciplina: selectedDisciplina,
        dia: dia,
        horario: horario
    };

    // Enviar os dados para o backend
    fetch("php/CTurma.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(turma)
    })
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.success) {
                alert("Turma cadastrada com sucesso!");
            } else {
                alert("Erro ao cadastrar turma: " + data.message);
            }
        })
        .catch(error => console.error('Erro ao cadastrar turma:', error));
});