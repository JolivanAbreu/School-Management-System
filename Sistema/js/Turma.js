document.addEventListener('DOMContentLoaded', function () {
    const turmaForm = document.getElementById('turmaForm');
    const selectProfessor = document.getElementById('turmaProfessor');
    const selectDisciplina = document.getElementById('turmaDisciplina');

    function carregarSelects() {
        fetch('../../php/Turma/LDadosTurma.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro na requisição: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                selectProfessor.innerHTML = '<option value="">Selecione um Professor</option>';
                data.professores.forEach(professor => {
                    const option = document.createElement('option');
                    option.value = professor.IdProfessor;
                    option.textContent = professor.Nome;
                    selectProfessor.appendChild(option);
                });

                selectDisciplina.innerHTML = '<option value="">Selecione uma Disciplina</option>';
                data.disciplinas.forEach(disciplina => {
                    const option = document.createElement('option');
                    option.value = disciplina.IdDisciplina;
                    option.textContent = disciplina.Nome;
                    selectDisciplina.appendChild(option);
                });
            })
            .catch(error => {
                console.error('Erro ao carregar dados dos selects:', error);
                alert('Não foi possível carregar os dados para os selects. Verifique o console para mais detalhes.');
            });
    }

    carregarSelects();

    if (turmaForm) {
        turmaForm.addEventListener('submit', function (event) {
            event.preventDefault();

            const formData = new FormData(turmaForm);

            fetch('../../php/Turma/CTurma.php', {
                method: 'POST',
                body: formData
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert('Turma cadastrada com sucesso!');
                        turmaForm.reset();
                    } else {
                        alert('Erro ao cadastrar turma: ' + data.message);
                    }
                })
                .catch(error => {
                    console.error('Erro ao enviar o formulário:', error);
                    alert('Ocorreu um erro de comunicação. Tente novamente.');
                });
        });
    }
});