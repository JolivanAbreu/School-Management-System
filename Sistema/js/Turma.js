// Carregar professores e disciplinas ao carregar a página
document.addEventListener('DOMContentLoaded', () => {
    fetch('./php/Turma/CTurma.php')
        .then(response => response.json())
        .then(data => {
            console.log(data);

            const professorSelect = document.getElementById('professor');
            const disciplinaSelect = document.getElementById('disciplina');

            // Popular professores
            data.professores.forEach(prof => {
                const option = document.createElement('option');
                option.value = prof.id;
                option.textContent = prof.nome;
                professorSelect.appendChild(option);
            });

            // Popular disciplinas
            data.disciplinas.forEach(disc => {
                const option = document.createElement('option');
                option.value = disc.id;
                option.textContent = disc.nome;
                disciplinaSelect.appendChild(option);
            });
        })
        .catch(error => console.error('Erro ao carregar dados:', error));
});

// Fetch turmas via AJAX
document.addEventListener('DOMContentLoaded', () => {
    console.log('Iniciando carregamento das turmas...');
    fetch('./php/Turma/ListarTurmas.php')
        .then(response => {
            console.log('Resposta bruta:', response);
            if (!response.ok) {
                throw new Error(`Erro HTTP: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('Dados JSON recebidos:', data);
            const turmaSelect = document.getElementById('turma');
            if (!Array.isArray(data)) {
                throw new Error('Resposta JSON inválida. Esperado um array.');
            }
            data.forEach(turma => {
                const option = document.createElement('option');
                option.value = turma.id;
                option.textContent = turma.nome;
                turmaSelect.appendChild(option);
            });
            console.log('Carregamento concluído.');
        })
        .catch(error => {
            console.error('Erro capturado:', error);
            alert('Erro ao carregar as turmas. Verifique a conexão com o servidor.');
        });
});


