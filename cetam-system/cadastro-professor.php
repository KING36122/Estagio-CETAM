<?php
require_once("config.php");

$res = $pdo->query("SELECT * from turno order by id_turno asc");
$dados_turno = $res->fetchAll(PDO::FETCH_ASSOC);

$res_curso = $pdo->query("SELECT * from curso order by nome_curso asc");
$dados_curso = $res_curso->fetchAll(PDO::FETCH_ASSOC);


?>

<h1>Cadastrar Professor</h1>


<form action="crud-professor.php" method="post">

    <input type="hidden" name="acao" value="cadastrar">

    <div class="mb-3">
        <label>CPF:</label>
        <input type="text" name="cpf" class="form-control">
    </div>
    <div class="mb-3">
        <label>Nome:</label>
        <input type="text" name="nome" class="form-control">
    </div>
    <div class="mb-3">
        <label>Sobrenome:</label>
        <input type="text" name="sobrenome" class="form-control">
    </div>
    <div class="mb-3">
        <label>RG:</label>
        <input type="text" name="rg" class="form-control">
    </div>

    <h2>Disciplinas Ministradas:</h2>

    <div id="disciplinas">

        <label>Disciplina:</label>
        <input type="text" name="disciplina" required>

        <label>Data de Início:</label>
        <input type="date" name="dt_inicial" required>

        <label>Data de Fim:</label>
        <input type="date" name="dt_final" required>


        <label">Carga Horária:</label>
            <input type="text" name="carga_horaria" required>

          
            <label for="turno">Turno:</label>
            <select name="id_turno" required class="form-control">
                <?php for ($i = 0; $i < count($dados_turno); $i++) {
                    $id_turno = $dados_turno[$i]['id_turno'];
                    $turno = $dados_turno[$i]['turno'];
                    echo '<option value="' . $id_turno . '">' . $turno . '</option>';
                } ?>
            </select>

            <br>

            <label for="curso">Curso:</label>
            <select name="curso_id" required class="form-control">
                <?php for ($i = 0; $i < count($dados_curso); $i++) {
                    foreach ($dados_curso[$i] as $key => $value) {
                    }
                    $curso_id = $dados_curso[$i]['curso_id'];
                    $nome_curso = $dados_curso[$i]['nome_curso'];
                    $projeto = $dados_curso[$i]['projeto'];

                    echo '<option value="' . $curso_id . '">' . $nome_curso . ' - ' . $projeto . '</option>';
                } ?>
            </select>
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>

</form>