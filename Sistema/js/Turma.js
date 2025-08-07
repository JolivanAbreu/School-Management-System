document.addEventListener('DOMContentLoaded', function () {
    const turmaForm = document.getElementById('turmaForm');

    if (!turmaForm) {
        return;
    }

    const selectProfessor = document.getElementById('turmaProfessor');
    const selectDisciplina = document.getElementById('turmaDisciplina');
    const submitButton = turmaForm.querySelector('button[type="submit"]');

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

    console.log("Adicionando listener ao formulário de turma.");

    turmaForm.addEventListener('submit', function (event) {
        event.preventDefault();

        submitButton.disabled = true;
        submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Cadastrando...';

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
            })
            .finally(() => {
                submitButton.disabled = false;
                submitButton.innerHTML = '<i class="fas fa-plus-circle"></i> Adicionar Turma';
            });
    });
});

document.addEventListener('DOMContentLoaded', function () {

    const deleteLinks = document.querySelectorAll('a.delete');

    deleteLinks.forEach(link => {
        link.addEventListener('click', function (event) {
            event.preventDefault();

            const turmaId = this.getAttribute('data-id');

            if (confirm('Tem a certeza de que deseja deletar esta turma?')) {

                fetch('../../php/Turma/DTurma.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({ id: turmaId })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert(data.message);
                            this.closest('tr').remove();
                        } else {
                            alert('Erro ao deletar: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Erro na requisição fetch:', error);
                        alert('Ocorreu um erro de comunicação com o servidor. Verifique o console (F12).');
                    });
            }
        });
    });

});