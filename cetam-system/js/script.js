document.getElementById('adicionarDisciplina').addEventListener('click', function() {
    var disciplinaContainer = document.querySelector('.formularioDisciplina');
    var novaDisciplina = document.querySelector('.disciplina').cloneNode(true);
    disciplinaContainer.appendChild(novaDisciplina);
});