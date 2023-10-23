<div class="index-div-principal">
    <div class="index-div-title">
        <p>Cursos</p>
    </div>
</div>
<div class="tableProf">
<button class="AddProf" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
    Adicionar Curso
</button>

<!-- Modal Cadastrar Curso -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Novo Curso</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="?page=salvar-curso" method="post">
                    <input type="hidden" name="acao" value="cadastrar">

                    <div class="mb-3">
                        <label>Curso:</label>
                        <input type="text" name="nome_curso" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label>Projeto:</label>
                        <input type="text" name="projeto" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Salvar</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                </form>

            </div>
        </div>
    </div>
</div>
<?php
require_once("config.php");
ob_start();

// Define a quantidade de registros por página
$limite_resultado = 15; // Ajuste conforme sua necessidade

// Recebe o número da página a ser exibida
$pagina_atual = filter_input(INPUT_GET, "pagina_curso", FILTER_SANITIZE_NUMBER_INT);
$pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;

// Calcula o início da visualização
$inicio = ($pagina - 1) * $limite_resultado;

$sql = 'SELECT * FROM curso LIMIT ' . $inicio . ', ' . $limite_resultado;

$res = $pdo->query($sql);
if ($res) {
    $qtd = $res->rowCount();

    if ($qtd > 0) {
        echo "<table class='table table-hover'>";
        echo "<tr>";
        echo "<th>Curso:</th>";
        echo "<th>Projeto:</th>";
        echo "<th>Ações</th>";
        echo "</tr>";

        while ($row = $res->fetch(PDO::FETCH_OBJ)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row->nome_curso) . "</td>"; // Use htmlspecialchars para escapar os dados
            echo "<td>" . htmlspecialchars($row->projeto) . "</td>";

            echo "<td>";
            echo "<button style='margin-right: 10px' onclick=\"location.href='?page=edt-curso&id=" . $row->curso_id . "'\" class='btn btn-success'>Editar</button>";
            echo "<button onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='?page=salvar-curso&acao=excluir&id=" . $row->curso_id . "'}\" class='btn btn-danger'>Excluir</button>";
            echo "</td>";

            echo "</tr>";
        }

        echo "</table>";

        // Consulta para contar a quantidade total de registros
        $sql_total = 'SELECT COUNT(curso_id) AS total FROM curso';
        $total_res = $pdo->query($sql_total);
        $total_row = $total_res->fetch(PDO::FETCH_OBJ);
        $total_registros = $total_row->total;

        // Calcula o número de páginas
        $qnt_pagina = ceil($total_registros / $limite_resultado);

        // Define o número máximo de links a serem exibidos
        $maximo_link = 10; // Ajuste conforme sua preferência

        echo "<div class='pagination'>";

        if ($qnt_pagina > 1) {
            echo "<a href='?page=cursos&pagina_curso=1'>Primeira</a> ";

            for ($pagina_anterior = max(1, $pagina - $maximo_link); $pagina_anterior < $pagina; $pagina_anterior++) {
                echo "<a href='?page=cursos&pagina_curso=$pagina_anterior'>$pagina_anterior</a> ";
            }
            echo "$pagina ";
            for ($proxima_pagina = $pagina + 1; $proxima_pagina <= min($pagina + $maximo_link, $qnt_pagina); $proxima_pagina++) {
                echo "<a href='?page=cursos&pagina_curso=$proxima_pagina'>$proxima_pagina</a> ";
            }
            echo "<a href='?page=cursos&pagina_curso=$qnt_pagina'>Última</a> ";
        }

        echo "</div>";
    }
} else {
    print "<p class='alert alert-danger'>Sem resultados!</p>";
}


?>