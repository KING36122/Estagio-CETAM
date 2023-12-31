

<div class="index-div-principal">
    <div class="index-div-title">
        <p>Turnos</p>
    </div>
</div>

<div class="tableProf">
<!-- Button trigger modal -->
<button type="button" class="AddProf" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Adicionar Turno
</button>

<?php
require_once("config.php");
ob_start();

$sql = 'select * from turno';

$res = $pdo->query($sql);


if ($res) { 
    $qtd = $res->rowCount(); 

    if ($qtd > 0) {
        echo "<table class='table table-hover'>";
        echo "<tr>";
        echo "<th>Turno:</th>";
        echo "<th>Ações</th>";
        echo "</tr>";

        while ($row = $res->fetch(PDO::FETCH_OBJ)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row->turno) . "</td>"; 
            echo "<td>";

            echo "<button style='margin-right:10px;' onclick=\"location.href='?page=editar-turno&id={$row->id_turno}'\" class='btn btn-success'>Editar</button>";
            echo "<button onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='?page=salvar-turno&acao=excluir&id=" . $row->id_turno . "'}\" class='btn btn-danger'>Excluir</button>";
            echo "</td>";
            echo "</tr>";
        }

        echo "</table>";
    }
} else {
    echo "<p class='alert alert-danger'>Sem resultados!</p>";
}
?>


<!-- Modal Cadastrar Turno -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Novo Turno</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <h1>Novo Turno</h1>

<form action="salvar-turno.php" method="post">

    <input type="hidden" name="acao" value="cadastrar">

    <div class="mb-3">
        <label>Turno:</label>
        <input type="text" name="turno" class="form-control">
    </div>
   
        <button type="submit" class="btn btn-primary">Salvar</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
</form>
       
    </div>
  </div>
</div>

