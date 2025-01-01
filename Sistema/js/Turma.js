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
