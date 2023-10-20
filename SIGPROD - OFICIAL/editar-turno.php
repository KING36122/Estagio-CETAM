<div class="index-div-principal">
            <div class="index-div-title">
                <p>Turno</p>
            </div>
        </div>

<?php
include_once 'config.php';
include "cabecalho.php";

$id_turno = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

$query = "select * from turno where id_turno = $id_turno LIMIT 1";
$res = $pdo->prepare($query);
$res->execute();
$row_usuario = $res->fetch(PDO::FETCH_ASSOC);

?>

<form action="?page=salvar_turno" method="POST" class="formCadastro">
    <input type="hidden" name="acao" value="editar">
    <input type="hidden" name="id_turno" value="<?php echo $id_turno; ?>">

    <div class="mb-3">
        <label>Turno:</label>
        <input type="text" name="turno" value="<?php if (isset($row_usuario['turno'])) {
                                                    echo $row_usuario['turno'];
                                                } ?>" >
    </div>

    <center>
        <button type="submit" class="btn btn-primary CadProf">Salvar</button>
    </center>
</form>