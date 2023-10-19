<?php
require 'config.php';

if (isset($_SESSION['adm_id']) && !empty($_SESSION['adm_id'])) : ?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

        <title>SIGPRO-CETAM</title>
    </head>

    <body>
        <nav class="navbar  navbar-expand-lg navbar-dark" style="background-color: #465573;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">SIGPRO-CETAM</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">

                        <li class="nav-item"> <a class="nav-link" href="home.php">Início</a></li>
                        <li class="nav-item"> <a class="nav-link" href="home.php?page=turnos" target="_blank">Turnos</a></li>
                        <li class="nav-item"> <a class="nav-link" href="home.php?page=cursos" target="_blank">Cursos</a></li>
                        <li class="nav-item"> <a class="nav-link" href="#">Meu perfil</a></li>
                        <li class="nav-item"> <a class="nav-link" href="logout.php?page-logout">Sair</a></li>
                    </ul>
                </div>
            </div>
        </nav>


        <div class="container-fluid">
            <?php
            $page = "";
            if (isset($_GET['page']) && !empty($_GET['page'])) {
                $page = addslashes($_GET['page']);
            }

            switch ($page) {

                case 'logout':
                    require 'logout.php';
                    break;

                case 'cadastro_professor':
                    require 'cadastro-professor.php';
                    break;
                case 'visualizar_professor':
                    require 'visualizar_professor.php';
                    break;
                case 'crud_professor':
                    require 'crud-professor.php';
                    break;
                case 'editar_professor':
                    require 'editar-professor.php';
                    break;
                case 'turnos':
                    require 'listar-turno.php';
                    break;
                case 'editar_turno':
                    require 'editar-turno.php';
                    break;
                case 'salvar_turno':
                    require 'salvar_turno.php';
                    break;
                case 'cursos':
                    require 'cadastro-curso.php';
                    break;
                case 'salvar_curso':
                    require 'salvar-curso.php';
                    break;
                case 'edt_curso':
                    require 'editar-curso.php';
                    break;
                case 'disciplina':
                    require 'cadastro-disciplina.php';
                    break;
                case 'editar_disciplina':
                    require 'editar-disciplina.php';
                    break;
                case 'salvar_disciplina':
                    require 'salvar-disciplina.php';
                    break;
                default:
            ?>
                    <div>

                        <a href="?page=cadastro_professor"> <button class='btn float-sm-end' style="background-color: #4C5D73; color: white; margin: 10px;">Adicionar Professor</button> </a>
                        <H1>Professores </H1>
                        <?php
                        $sql = 'select * from professor';

                        $res = $pdo->prepare($sql);
                        $res->execute();

                        if ($res) {
                            $qtd = $res->rowCount();

                            if ($qtd > 0) {
                                echo "<table class='table table-hover'>";
                                echo "<tr>";
                                echo "<th>CPF:</th>";
                                echo "<th>Nome:</th>";
                                echo "<th>Sobrenome:</th>";
                                echo "<th>Ações</th>";
                                echo "</tr>";
                                while ($row = $res->fetch(PDO::FETCH_OBJ)) {
                                    echo "<tr>";
                                    echo "<td>" . htmlspecialchars($row->cpf) . "</td>";
                                    echo "<td>" . htmlspecialchars($row->nome) . "</td>";
                                    echo "<td>" . htmlspecialchars($row->sobrenome) . "</td>";

                                    echo "<td>";
                                    echo "<button onclick=\"location.href='?page=visualizar_professor&id={$row->id_professor}'\" class='btn btn-success'>Visualizar</button>";

                                    echo "</td>";

                                    echo "</tr>";
                                }
                                echo "</table>";
                            } else {
                                echo "<p class='alert alert-danger'>Sem resultados!</p>";
                            }
                        }
                        ?>

                    </div>
            <?php  } ?>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

            <script src="js/script.js"></script>
    </body>

    </html>
<?php
else : header("Location: index.php");
endif;
?>