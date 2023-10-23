<div class="index-div-principal">
    <div class="index-div-title">
        <p>Curso</p>
    </div>
</div>

<div class="tableProf">
<!-- Button trigger modal -->
<button type="button" class="AddProf" data-bs-toggle="modal" data-bs-target="#exampleModal">  Adicionar Curso
</button>

<!-- Modal Cadastrar Curso -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">

                <h1 class="modal-title fs-5" id="exampleModalLabel">Novo Turno</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="salvar-curso.php" method="post">
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

    $sql = 'select * from curso';

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
                echo "<button style='margin-right:10px;' onclick=\"location.href='?page=edt-curso&id=" . $row->curso_id . "'\" class='btn btn-success'>Editar</button>";
                echo "<button onclick=\"if(confirm('Tem certeza que deseja excluir?')){location.href='?page=salvar-curso&acao=excluir&id=" . $row->curso_id . "'}\" class='btn btn-danger'>Excluir</button>";
                echo "</td>";

                echo "</tr>";
            }

            echo "</table>";
        }
    } else {
        print "<p class='alert alert-danger'>Sem resultados!</p>";
    }


    ?>