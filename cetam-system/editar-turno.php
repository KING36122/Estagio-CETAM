<h1>Editar Turno</h1>
<?php

// ob_start();
require_once("config.php");

$id_turno = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

$query = "select * from turno where id_turno = $id_turno LIMIT 1";
$res = $pdo->prepare($query);
$res->execute();
$row_usuario = $res->fetch(PDO::FETCH_ASSOC);

?>

<form action="?page=salvar_turno" method="POST">
    <input type="hidden" name="acao" value="editar">
    <input type="hidden" name="id_turno" value="<?php echo $id_turno; ?>">

    <div class="mb-3">
        <label>Turno:</label>
        <input type="text" name="turno" value="<?php if (isset($row_usuario['turno'])) {
                                                    echo $row_usuario['turno'];
                                                } ?>" >
    </div>

    <button type="submit" class="btn btn-primary">Salvar</button>
</form>