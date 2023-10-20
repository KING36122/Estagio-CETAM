<?php
    require 'config.php';
    define("TITULO", "SIGPROD");
	include "cabecalho.php";

if (isset($_SESSION['adm_id']) && !empty($_SESSION['adm_id'])) : ?>

    <!DOCTYPE html>
    <html lang="pt-br">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    </head>
    <body style="background-color: #ebf3ff;">
        <nav class="navbar navbar-expand-lg navbar-dark barra" style="background-color: #1f5574;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">SIGPROD-CETAM</a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse op" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item"> <a class="nav-link" href="home.php">Início</a></li>
                        <li class="nav-item"> <a class="nav-link" href="home.php?page=turnos">Turnos</a></li>
                        <li class="nav-item"> <a class="nav-link" href="home.php?page=cursos">Cursos</a></li>
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
                case 'cadastro-professor':
                    require 'cadastro-professor.php';
                    break;
                case 'visualizar-professor':
                    require 'visualizar-professor.php';
                    break;
                case 'crud-professor':
                    require 'crud-professor.php';
                    break;
                    case 'editar-professor':
                        require 'editar-professor.php';
                        break;
                case 'turnos':
                    require 'listar-turno.php';
                    break;
                case 'editar_turno':
                    require 'editar-turno.php';
                    break;
                case 'salvar_turno':
                    require 'salvar-turno.php';
                    break;
                case 'cursos':
                    require 'listar-curso.php';
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
                        case 'editar-disciplina':
                            require 'editar-disciplina.php';
                            break;
                default:
            ?>
        </div>
        <div class="index-div-principal">
            <div class="index-div-title">
                <p>Professores</p>
            </div>
        </div>
        <div class="tableProf">
            <a href="?page=cadastro-professor">
                <button class='AddProf'>Adicionar Professor</button>
            </a>
            <?php
                $sql = 'select * from professor';
                $res = $pdo->prepare($sql);
                $res->execute();
                if ($res) {
                    $qtd = $res->rowCount();
                    if ($qtd > 0) {
                        echo "<table class='table table-hover' id='table'>";
                            echo "<thead>";
                                echo "<tr>";
                                echo "<th>CPF:</th>";
                                echo "<th>Nome:</th>";
                                echo "<th>Sobrenome:</th>";
                                echo "<th>Ações</th>";
                                echo "</tr>";
                            echo "</thead>";
                        while ($row = $res->fetch(PDO::FETCH_OBJ)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row->cpf) . "</td>";
                            echo "<td>" . htmlspecialchars($row->nome) . "</td>";
                            echo "<td>" . htmlspecialchars($row->sobrenome) . "</td>";
                            echo "<td>";
                            echo "<button onclick=\"location.href='?page=visualizar-professor&id={$row->id_professor}'\" class='btn btn-success'>Visualizar</button>";
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