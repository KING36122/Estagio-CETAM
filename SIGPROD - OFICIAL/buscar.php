<?php
require_once("config.php");

if (isset($_POST['busca'])) {
    $searchInput = $_POST['busca'];

    // Consulta SQL para pesquisar professores
    $sql = "SELECT * FROM professor  WHERE nome LIKE :search OR sobrenome LIKE :search OR cpf LIKE :search";   
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':search', $searchInput, PDO::PARAM_STR);
    $stmt->execute();
    
    $professores = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Exibir os resultados da pesquisa
    if (count($professores) === 0) {
        echo "<p class='alert alert-danger'>Sem resultados!</p>";
    } else {
        echo "<h1> RESULTADOS ENCONTRADOS</h1>";
        foreach ($professores as $prof) {
            echo "<table class='table table-hover'>";
            echo "<tr>";
           
            echo "<th>CPF:</th>";
            echo "<th>Nome:</th>";
            echo "<th>Sobrenome:</th>";
            echo "<th>Ações</th>";
            echo "</tr>";

            echo "<tr>";
                                    echo "<td>"  . $prof['nome'] . "</td>";
                                    echo "<td>" . $prof['sobrenome'] . "</td>";
                                    echo "<td>" . $prof['cpf']  . "</td>";

                                    echo "<td>";
                                    echo "<button onclick=\"location.href='?page=visualizar_professor&id= {$prof['id_professor']}'\" class='btn btn-success'>Visualizar</button>";

                                    echo "</td>";

                                    echo "</tr>";
                                }
                                echo "</table>";
        }
    }
?>