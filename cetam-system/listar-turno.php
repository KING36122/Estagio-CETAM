<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Adicionar Turno
</button>

<h1>Turnos Cadastrados</h1>

<?php
require_once("config.php");
ob_start();

// Define a quantidade de registros por página
$limite_resultado = 15; // Ajuste conforme sua necessidade

// Recebe o número da página a ser exibida
$pagina_atual = filter_input(INPUT_GET, "pagina_turno", FILTER_SANITIZE_NUMBER_INT);
$pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;

// Calcula o início da visualização
$inicio = ($pagina - 1) * $limite_resultado;

$sql = 'SELECT * FROM turno LIMIT ' . $inicio . ', ' . $limite_resultado;

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

      echo "<button onclick=\"location.href='?page=editar_turno&id={$row->id_turno}'\" class='btn btn-success'>Editar</button>";
      echo "<button onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='?page=salvar_turno&acao=excluir&id=" . $row->id_turno . "'}\" class='btn btn-danger'>Excluir</button>";
      echo "</td>";
      echo "</tr>";
    }

    echo "</table>";

    // Consulta para contar a quantidade total de registros
    $sql_total = 'SELECT COUNT(id_turno) AS total FROM turno';
    $total_res = $pdo->query($sql_total);
    $total_row = $total_res->fetch(PDO::FETCH_OBJ);
    $total_registros = $total_row->total;

    // Calcula o número de páginas
    $qnt_pagina = ceil($total_registros / $limite_resultado);

    // Define o número máximo de links a serem exibidos
    $maximo_link = 5; // Ajuste conforme sua preferência

    echo "<div class='pagination'>";

    if ($qnt_pagina > 1) {
      echo "<a href='?page=turnos&pagina_turno=1'>Primeira</a> ";

      for ($pagina_anterior = max(1, $pagina - $maximo_link); $pagina_anterior < $pagina; $pagina_anterior++) {
        echo "<a href='?page=turnos&pagina_turno=$pagina_anterior'>$pagina_anterior</a> ";
      }
      echo "$pagina ";
      for ($proxima_pagina = $pagina + 1; $proxima_pagina <= min($pagina + $maximo_link, $qnt_pagina); $proxima_pagina++) {
        echo "<a href='?page=turnos&pagina_turno=$proxima_pagina'>$proxima_pagina</a> ";
      }
      echo "<a href='?page=turnos&pagina_turno=$qnt_pagina'>Última</a> ";
    }

    echo "</div>";
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

          <form action="salvar_turno.php" method="post">

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