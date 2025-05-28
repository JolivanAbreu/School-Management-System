// VISUALIZAÇÃO DAS TURMAS
$(document).ready(function () {
    // Activate tooltip
    $('[data-toggle="tooltip"]').tooltip();

    // Select/Deselect checkboxes
    var checkbox = $('table tbody input[type="checkbox"]');
    $("#selectAll").click(function () {
        if (this.checked) {
            checkbox.each(function () {
                this.checked = true;
            });
        } else {
            checkbox.each(function () {
                this.checked = false;
            });
        }
    });
    checkbox.click(function () {
        if (!this.checked) {
            $("#selectAll").prop("checked", false);
        }
    });
});

// VISUALIZAÇÃO DE PROFESSORES E DISCIPLINAS
document.addEventListener("DOMContentLoaded", function() {
    fetch("../../php/Turma/get_professores_disciplinas.php")
        .then(response => response.json())
        .then(data => {
            const professorSelect = document.getElementById("turmaProfessor");
            const disciplinaSelect = document.getElementById("turmaDisciplina");

            // Preencher professores
            data.professores.forEach(prof => {
                const option = document.createElement("option");
                option.value = prof.IdProfessor;
                option.text = prof.Nome;
                professorSelect.appendChild(option);
            });

            // Preencher disciplinas
            data.disciplinas.forEach(disc => {
                const option = document.createElement("option");
                option.value = disc.IdDisciplina;
                option.text = disc.Nome;
                disciplinaSelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error("Erro ao carregar dados:", error);
        });
});
