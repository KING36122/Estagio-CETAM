<?php
require_once("config.php");

ob_start();

 if (isset($_REQUEST["acao"])) {

    switch ($_REQUEST["acao"]){
        case 'cadastrar':
            
            $nome_curso = isset($_POST["nome_curso"]) ? $_POST["nome_curso"] : '';
            $projeto = isset($_POST["projeto"]) ? $_POST["projeto"] : '';

            if (!empty($nome_curso) && !empty($projeto)) {
                $sql = "INSERT INTO curso (nome_curso, projeto) VALUES ('{$nome_curso}','{$projeto}')";

                $res = $pdo->query($sql);

                if ($res == true) {
                    print "<script>alert('Cadastro realizado com sucesso!!!');</script>";
                    echo "<script>location.href='?page=cursos';</script>";
                } else {
                    print "<script>alert('Erro ao realizar cadastro!!!');</script>";
                    echo "<script>location.href='?page=cursos';</script>";
                }
            } else {
                print "<script>alert('Preencha todos os campos obrigatórios!');</script>";
                echo "<script>location.href='?page=cursos';</script>";
            }
            break;

        
        case 'editar':
           
           $curso_id= filter_input(INPUT_POST, "curso_id", FILTER_SANITIZE_NUMBER_INT);
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
           

            if ($curso_id !== false) {
            
                $sql = "UPDATE curso SET nome_curso = :nome_curso, projeto = :projeto WHERE curso_id = :curso_id";
                $res = $pdo->prepare($sql);
                $res->bindParam(':nome_curso', $dados['nome_curso'], PDO::PARAM_STR);
                $res->bindParam(':projeto', $dados['projeto'], PDO::PARAM_STR);
                $res->bindParam(':curso_id', $curso_id, PDO::PARAM_INT);
            
                if ($res->execute()) {
                    print "<script>alert('Alterado com Sucesso')</script>";
                     print "<script>location.href='?page=cursos';</script>";
                } else {
                    // Imprima informações de erro para depuração
                    echo "Erro na execução da consulta SQL: ";
                    var_dump($res->errorInfo());
                    print "<scrip>location.href='?page=cursos';</script>";
                }
            } else {
                echo "Erro: curso_id não está definido corretamente.";
            }
            exit();
            
            break;
            
        case 'excluir':
            $curso_id=filter_input(INPUT_GET,"id",FILTER_SANITIZE_NUMBER_INT);
            
            
            $sql = "DELETE FROM curso WHERE curso_id = :curso_id";
            $res = $pdo->prepare($sql);
            $res->bindParam(':curso_id', $curso_id, PDO::PARAM_INT);
        
            if ($res->execute()) {
                echo "Excluído com sucesso!";
                header("Location: ?page=cursos");
            } else {
                echo "<script>alert('Erro ao excluir!');</script>";
                echo "<script>location.href='?page=cursos';</script>";
            }

            break;
    }}
?>




