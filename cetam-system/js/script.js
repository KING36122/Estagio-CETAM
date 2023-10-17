
function adicionarDisciplina() {
    const disciplinaDiv = document.getElementById('disciplinas');
    const novaDisciplina = document.createElement('div');
    novaDisciplina.className = 'disciplina';
    novaDisciplina.innerHTML = `
        <label for="disciplina_nome[]">Disciplina:</label>
        <input type="text" name="disciplina_nome[]" required>
        
        <label for="data_inicio[]">Data de Início:</label>
        <input type="date" name="data_inicio[]" required>
        
        <label for="data_fim[]">Data de Fim:</label>
        <input type="date" name="data_fim[]" required>
        
        <label for="carga_horaria[]">Carga Horária:</label>
        <input type="text" name="carga_horaria[]" required>

       <label for="turno">Turno:</label>
        <select name="turno[]" required class="form-control">
            <option value="" selected>Selecione o turno</option>
            // Adicione as opções de turno aqui usando JavaScript
        </select>
        
        <label for="curso">Curso:</label>
        <select name="curso[]" required class="form-control">
            <option value="" selected>Selecione o curso</option>
            // Opções de curso permanecem as mesmas
        </select>
    `;
    disciplinaDiv.appendChild(novaDisciplina);
}