<H1>Dados Pessoais </H1>

<?php
include_once 'config.php';

//visualizar professor
$id = $_GET['id'];

if (empty($id)) {
    echo "<p class='alert alert-danger'>Erro!</p>";
    exit();
}

$sql = 'SELECT id_professor, cpf, nome, sobrenome, rg FROM professor WHERE id_professor = :id LIMIT 1';
$res = $pdo->prepare($sql);
$res->bindParam(':id', $id, PDO::PARAM_INT);
$res->execute();

if (($res) and ($res->rowCount() != 0)) {
    $row = $res->fetch(PDO::FETCH_ASSOC);

    echo "<table class='table table-hover'>";
    echo " <thead>";
    echo "<tr>";
    echo "<th>CPF:</th>";
    echo "<th>RG:</th>";
    echo "<th>Nome:</th>";
    echo "<th>Sobrenome:</th>";
    echo "<th>Ações</th>";
    echo "</thead>";
    echo "</tr>";
    echo "<tr>";
    echo "<td>" . $row['cpf'] . "</td>";
    echo "<td>" . $row['rg'] . "</td>";
    echo "<td>" . $row['nome'] . "</td>";
    echo "<td>" . $row['sobrenome'] . "</td>";

    echo "<td>";
    echo "<button onclick=\"location.href='?page=editar_professor&id={$row['id_professor']}'\" class='btn btn-success'>Editar</button>";

    echo "<button onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='?page=crud_professor&acao=excluir&id=".$row['id_professor']."'}\" class='btn btn-danger'>Excluir</button>";
    echo "</td>";

    echo "</tr>";
    echo "</table>";
} else {
    echo "<p class='alert alert-danger'>Sem resultados!</p>";
}
?>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Adicionar Disciplina
</button>

<h1>Disciplinas Ministradas</h1>
<?php
include_once 'config.php';

$professor_id = $_GET['id'];
if (empty($id)) {
    echo "<p class='alert alert-danger'>Erro!</p>";
    exit();
}

$sql = 'SELECT prof.id_professor, disc.disc_id, disc.disciplina, disc.dt_inicial, disc.dt_final, disc.carga_horaria, disc.id_professor, disc.id_turno, disc.curso_id, turn.turno, curs.nome_curso, curs.projeto
FROM professor AS prof
LEFT JOIN disciplina AS disc ON disc.id_professor = prof.id_professor
LEFT JOIN turno AS turn ON turn.id_turno = disc.id_turno
LEFT JOIN curso AS curs ON curs.curso_id = disc.curso_id
WHERE prof.id_professor = :professor_id
ORDER BY disc.dt_inicial DESC';
$res = $pdo->prepare($sql);
$res->bindParam(':professor_id', $professor_id, PDO::PARAM_INT);
$res->execute();
$id_professor=$row['id_professor'];
if (($res) and ($res->rowCount() != 0)) {
    while ($row = $res->fetch(PDO::FETCH_ASSOC)) {
        $id=$row['disc_id'];
        echo "<table class='table table-hover'>";

        echo " <thead>";
        echo "<tr>";
        echo "<th>Disciplina:</th>";
        echo "<th>Início:</th>";
        echo "<th>Fim:</th>";
        echo "<th>Carga_horária:</th>";
        echo "<th>Turno:</th>";
        echo "<th>Curso:</th>";
        echo "<th>Projeto:</th>";
        echo "<th>Ações</th>";
        echo "</tr>";
        echo " </thead>";
        echo " <tbody>";
        echo "<tr>";
        echo "<td>" . $row['disciplina'] . "</td>";
        echo "<td>" . $row['dt_inicial'] . "</td>";
        echo "<td>" . $row['dt_final'] . "</td>";
        echo "<td>" . $row['carga_horaria'] . "</td>";
        echo "<td>" . $row['turno'] . "</td>";
        echo "<td>" . $row['nome_curso'] . "</td>";
        echo "<td>" . $row['projeto'] . "</td>";
        echo "<td>";
        echo "<button onclick=\"location.href='?page=editar_disciplina&id={$row['disc_id']}'\" class='btn btn-success'>Editar</button>";

        echo "<button onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='?page=salvar_disciplina&acao=excluir&id={$row['disc_id']}'}else{false;}\" class='btn btn-danger'>Excluir</button>";

        echo "</td>";

        echo "</tr>";
        echo "</tbody>";
    }
    echo "</table>";
} else {
    echo "<p class='alert alert-danger'>Sem resultados!</p>";
}

?>

<!-- Modal Cadastrar Disciplina -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Adicionar Disciplina</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php
                require_once("config.php");
                $id_professor = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

                $res = $pdo->query("SELECT * from turno order by turno asc");
                $dados_turno = $res->fetchAll(PDO::FETCH_ASSOC);

                $res_curso = $pdo->query("SELECT * from curso order by nome_curso asc");
                $dados_curso = $res_curso->fetchAll(PDO::FETCH_ASSOC);
                ?>

                <form action="salvar_disciplina" method="post">
                    <input type="hidden" name="acao" value="cadastrar">
                    <input type="hidden" name="id_professor" value="<?php echo $id_professor; ?>">

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
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </form>

            </div>
        </div>
    </div>