<?php
require_once("config.php");
	include "cabecalho.php";

$res = $pdo->query("SELECT * from turno order by id_turno asc");
$dados_turno = $res->fetchAll(PDO::FETCH_ASSOC);

$res_curso = $pdo->query("SELECT * from curso order by nome_curso asc");
$dados_curso = $res_curso->fetchAll(PDO::FETCH_ASSOC);


?>

        <div class="index-div-principal">
            <div class="index-div-title">
                <p>Cadastrar Professores</p>
            </div>
        </div>


<form action="crud-professor.php" method="post" class="formCadastro">

    <input type="hidden" name="acao" value="cadastrar">
    <div class="info">
        <div class="mb-3">
            <label>Nome:</label>
            <input style="margin-right: 10px;" class="dados" type="text" name="nome" class="form-control" placeholder="Digite o Primeiro Nome - ex: João" required>
        </div>
        <div class="mb-3">
            <label>Sobrenome:</label>
            <input class="dados" type="text" name="sobrenome" class="form-control" placeholder="Digite o Sobrenome - ex: Silva" required>
        </div>
    </div>
    <div class="info">
        <div class="mb-3">
            <label>RG:</label>
            <input style="margin-right: 10px;" class="dados" type="text" name="rg" class="form-control" placeholder="Digite o RG - ex: 12345678 " required>
        </div>
        <div class="mb-3">
            <label>CPF:</label>
            <input class="dados" type="text" name="cpf" class="form-control" placeholder="Digite o CPF - ex: 12345678900" required>
        </div>
    </div>

    <div class="index-div-principal">
        <div class="index-div-title-Disc">
            <p>Disciplinas Ministradas</p>
        </div>
    </div>

    <div id="disciplinas">

    <div class="info">
        <div class="mb-3">
            <label>Disciplina:</label>
            <input style="margin-right: 10px;" class="dados" type="text" name="disciplina" placeholder="Digite o Nome da Disciplina " required>
        </div>
        <div class="mb-3">
            <label>Carga Horária (h):</label>
            <input class="dados" type="text" name="carga_horaria" placeholder="Digite a Carga Horária - ex: 120" required>
        </div>
    </div>
        <div class="info">
            <div class="mb-3">
                <label>Data de Início:</label>
                <input style="margin-right: 10px;" class="dados" type="date" name="dt_inicial" required>
            </div>
            <div class="mb-3">
                <label>Data de Fim:</label>
                <input class="dados" type="date" name="dt_final" required>
            </div>
        </div>
        <div class="info">
            <div class="mb-3">
                <label for="turno">Turno:</label>
                <select style="margin-right: 10px;" class="dados" name="id_turno" required class="form-control">
                <option value="" hidden>Selecione uma opção</option>
                    <?php for ($i = 0; $i < count($dados_turno); $i++) {
                        $id_turno = $dados_turno[$i]['id_turno'];
                        $turno = $dados_turno[$i]['turno'];
                        echo '<option value="' . $id_turno . '">' . $turno . '</option>';
                    } ?>
                </select>
            </div>
            <div class="mb-3">
                <label for="curso">Curso:</label>
                <select class="dados" name="curso_id" required class="form-control">
                <option value="" hidden>Selecione uma opção</option>
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
    </div>
    <center>
        <button type="submit" class="btn btn-primary CadProf">Salvar</button>
    </center>
</form>