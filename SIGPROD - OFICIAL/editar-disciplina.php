<div class="index-div-principal">
            <div class="index-div-title">
                <p>Disciplina</p>
            </div>
        </div>

<?php
include_once 'config.php';
include "cabecalho.php";

$disc_id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if ($disc_id !== false) {
    $query = "SELECT disc.disc_id, disc.disciplina, disc.dt_inicial, disc.dt_final, disc.carga_horaria, disc.id_professor, disc.id_turno, disc.curso_id, prof.id_professor, prof.cpf, prof.nome, prof.sobrenome, prof.rg, turn.turno, curs.nome_curso, curs.projeto
    FROM disciplina AS disc
    LEFT JOIN turno AS turn ON turn.id_turno = disc.id_turno
    LEFT JOIN professor AS prof ON prof.id_professor = disc.id_professor
    LEFT JOIN curso AS curs ON curs.curso_id = disc.curso_id
    WHERE disc.disc_id = :disc_id
    LIMIT 1";
    $res = $pdo->prepare($query);
    $res->bindParam(':disc_id', $disc_id, PDO::PARAM_INT);
    $res->execute();
    $row_usuario = $res->fetch(PDO::FETCH_ASSOC);
} else {
    echo "Erro: id não está definido corretamente.";
}
$res = $pdo->query("SELECT * from turno order by id_turno asc");
$dados_turno = $res->fetchAll(PDO::FETCH_ASSOC);

$res_curso = $pdo->query("SELECT * from curso order by nome_curso asc");
$dados_curso = $res_curso->fetchAll(PDO::FETCH_ASSOC);
$id_professor=$row_usuario['id_professor'];
?>

<form action="?page=salvar-disciplina" method="post" class="formCadastro">

    <input type="hidden" name="acao" value="editar">
    <input type="hidden" name="disc_id" value="<?php echo $disc_id; ?>">
    <input type="hidden" name="id_professor" value="<?php echo $id_professor; ?>">
    <div class="form-group">
        <label>Disciplina:</label>
        <input type="text" name="disciplina" value="<?php if (isset($row_usuario['disciplina'])) {
                                                        echo $row_usuario['disciplina'];
                                                    } ?>">

        <label>Data de Início:</label>
        <input type="date" name="dt_inicial" value="<?php if (isset($row_usuario['dt_inicial'])) {
                                                        echo $row_usuario['dt_inicial'];
                                                    } ?>">
        <label>Data de Fim:</label>
        <input type="date" name="dt_final" value="<?php if (isset($row_usuario['dt_final'])) {
                                                        echo $row_usuario['dt_final'];
                                                    } ?>">
        <label>Carga horária:</label>
        <input type="text" name="carga_horaria" value="<?php if (isset($row_usuario['carga_horaria'])) {
                                                            echo $row_usuario['carga_horaria'];
                                                        } ?>">
         <label>Turno:</label>
                                                 
            <select name="id_turno" required class="form-control">
                <?php for ($i = 0; $i < count($dados_turno); $i++) {
                    $id_turno = $dados_turno[$i]['id_turno'];
                    $turno = $dados_turno[$i]['turno'];
                    echo '<option value="' . $id_turno . '">' . $turno . '</option>';
                } ?>
            </select>
         <label>Curso:</label>
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
                                                    
            <center>
        <button type="submit" class="btn btn-primary CadProf">Salvar</button>
    </center>
</form>