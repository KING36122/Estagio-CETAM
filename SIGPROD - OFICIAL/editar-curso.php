<div class="index-div-principal">
    <div class="index-div-title">
        <p>Curso</p>
    </div>
</div>

<?php
include_once 'config.php';
include "cabecalho.php";

$curso_id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if ($curso_id !== false) {
    $query = "SELECT curso_id, nome_curso, projeto FROM curso WHERE curso_id = $curso_id LIMIT 1";
    $res = $pdo->prepare($query);
    $res->execute();
    $row_usuario = $res->fetch(PDO::FETCH_ASSOC);
} else {
    echo "Erro: curso_id não está definido corretamente.";
}

?>


<form action="?page=salvar-curso" method="post" class="formCadastro">

    <input type="hidden" name="acao" value="editar">
    <input type="hidden" name="curso_id" value="<?php echo $curso_id; ?>">
    <div class="form-group">
        <label>Curso:</label>
        <input type="text" name="nome_curso" value="<?php if (isset($row_usuario['nome_curso'])) {
                                                        echo $row_usuario['nome_curso'];
                                                    } ?>">

        <label>Projeto:</label>
        <input type="text" name="projeto" value="<?php if (isset($row_usuario['projeto'])) {
                                                        echo $row_usuario['projeto'];
                                                    } ?>">

<center>
        <button type="submit" class="btn btn-primary CadProf">Salvar</button>
    </center>
</form>