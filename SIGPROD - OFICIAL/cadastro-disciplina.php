<?php
require_once("config.php");

$res = $pdo->query("SELECT * from turno order by id_turno asc");
$dados_turno = $res->fetchAll(PDO::FETCH_ASSOC);

$res_curso = $pdo->query("SELECT * from curso order by nome_curso asc");
$dados_curso = $res_curso->fetchAll(PDO::FETCH_ASSOC);


?>

<form action="salvar-disciplina.php" method="post">
    <input type="hidden" name="acao" value="cadastrar">
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