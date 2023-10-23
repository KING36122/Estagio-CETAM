<div class="index-div-principal">
            <div class="index-div-title">
                <p>Dados</p>
            </div>
        </div>

<?php
include_once 'config.php';
include "cabecalho.php";

$id_professor = filter_input(INPUT_GET, "id", FILTER_SANITIZE_NUMBER_INT);

if (empty($id_professor)) {
    echo "<p class='alert alert-danger'>Erro!</p>";
    exit();
}

$sql = 'SELECT id_professor,cpf, nome, sobrenome, rg FROM professor WHERE id_professor = :id_professor LIMIT 1';
$res = $pdo->prepare($sql);
$res->bindParam(':id_professor', $id_professor, PDO::PARAM_INT); 
$res->execute();
$row_usuario = $res->fetch(PDO::FETCH_ASSOC);
?>

<form action="?page=crud-professor" method="POST" class="formCadastro">
    <input type="hidden" name="acao" value="editar">
    <input type="hidden" name="id_professor" value="<?php echo $id_professor; ?>">

    <div class="mb-3">
        <label>CPF:</label>
        <input type="text" name="cpf" value="<?php if (isset($row_usuario['cpf'])) {
                                                    echo $row_usuario['cpf'];
                                                } ?>" >
    </div>
    <div class="mb-3">
        <label>Nome:</label>
        <input type="text" name="nome" value="<?php if (isset($row_usuario['nome'])) {
                                                    echo $row_usuario['nome'];
                                                } ?>" >
    </div>
    <div class="mb-3">
        <label>Sobrenome:</label>
        <input type="text" name="sobrenome" value="<?php if (isset($row_usuario['sobrenome'])) {
                                                    echo $row_usuario['sobrenome'];
                                                } ?>" >
    </div>
    <div class="mb-3">
        <label>RG:</label>
        <input type="text" name="rg" value="<?php if (isset($row_usuario['rg'])) {
                                                    echo $row_usuario['rg'];
                                                } ?>" >
    </div>

    <center>
        <button type="submit" class="btn btn-primary CadProf">Salvar</button>
    </center>
</form>