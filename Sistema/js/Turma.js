document.addEventListener('DOMContentLoaded', function () {
    const turmaForm = document.getElementById('turmaForm');

    // Se o formulário não existir na página, não faz nada.
    if (!turmaForm) {
        return;
    }

    const selectProfessor = document.getElementById('turmaProfessor');
    const selectDisciplina = document.getElementById('turmaDisciplina');
    // Pega uma referência para o botão de submit
    const submitButton = turmaForm.querySelector('button[type="submit"]');

    // ... (a sua função carregarSelects continua a mesma aqui) ...

    function carregarSelects() {
        // O caminho está correto baseado na sua estrutura de pastas
        fetch('../../php/Turma/LDadosTurma.php')
            .then(response => {
                if (!response.ok) {
                    throw new Error('Erro na requisição: ' + response.statusText);
                }
                return response.json();
            })
            .then(data => {
                // Limpa e popula o select de professores
                selectProfessor.innerHTML = '<option value="">Selecione um Professor</option>';
                data.professores.forEach(professor => {
                    const option = document.createElement('option');
                    option.value = professor.IdProfessor;
                    option.textContent = professor.Nome;
                    selectProfessor.appendChild(option);
                });

                // Limpa e popula o select de disciplinas
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

    // ----> ADICIONE ESTA LINHA PARA DEPURAR <----
    console.log("Adicionando listener ao formulário de turma.");

    // Listener para o envio do formulário
    turmaForm.addEventListener('submit', function (event) {
        event.preventDefault(); // Previne o recarregamento da página

        // ----> PASSO 1: DESABILITAR O BOTÃO E DAR FEEDBACK VISUAL <----
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
                    // Se a turma já existir (ver Solução 2), mostrará a mensagem correta.
                    alert('Erro ao cadastrar turma: ' + data.message);
                }
            })
            .catch(error => {
                console.error('Erro ao enviar o formulário:', error);
                alert('Ocorreu um erro de comunicação. Tente novamente.');
            })
            .finally(() => {
                // ----> PASSO 2: REABILITAR O BOTÃO SEMPRE, NO SUCESSO OU NO ERRO <----
                submitButton.disabled = false;
                submitButton.innerHTML = '<i class="fas fa-plus-circle"></i> Adicionar Turma';
            });
    });
});