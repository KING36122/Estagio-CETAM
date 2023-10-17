<?php
require_once("config.php");
if (isset($_REQUEST["acao"])) {

    switch ($_REQUEST["acao"]){
        case 'cadastrar':

            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        
            $res = $pdo->prepare("INSERT into professor (cpf,nome, sobrenome, rg) values (:cpf, :nome, :sobrenome, :rg) ");
            $res->bindValue(":cpf", $dados['cpf']);
            $res->bindValue(":nome", $dados['nome']);
            $res->bindValue(":sobrenome", $dados['sobrenome']);
            $res->bindValue(":rg", $dados['rg']);
            $res->execute();

            $id_professor=$pdo->lastInsertId();
            
            $query_disc="INSERT into disciplina (disciplina, dt_inicial, dt_final,carga_horaria,id_professor,id_turno, curso_id) VALUES (:disciplina, :dt_inicial, :dt_final, :carga_horaria,:id_professor,:id_turno, :curso_id)";
            $res_disc = $pdo->prepare($query_disc);
            $res_disc->bindValue(":disciplina", $dados['disciplina']);
            $res_disc->bindValue(":dt_inicial", $dados['dt_inicial']);
            $res_disc->bindValue(":dt_final", $dados['dt_final']);
            $res_disc->bindValue(":carga_horaria", $dados['carga_horaria']);
            $res_disc->bindValue(":id_professor", $id_professor);
            $res_disc->bindValue(":id_turno", $dados['id_turno']);
            $res_disc->bindValue(":curso_id",  $dados['curso_id']);
            $res_disc->execute();
          
            if ($res-> execute()) {
                print "<script>alert('Cadastrado com Sucesso')</script>";
                print "<script>location.href='home.php';</script>";
            } else {
                print "<script>alert('Erro na execução da consulta SQL: " . print_r($res->errorInfo(), true) . "')</script>";
                print "<script>location.href='home.php';</script>";
            }
        exit();    break;
        
        case 'editar':
            $id_professor = filter_input(INPUT_POST, "id_professor", FILTER_SANITIZE_NUMBER_INT);
        $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        $dados = array_map('trim', $dados);
  
        if (in_array("", $dados)) {
            $empty_input = true;
            echo "Preencha todos campos!";
        }

        // if (!$empty_input) {
            $sql =   "UPDATE professor SET cpf=:cpf,nome=:nome,sobrenome=:sobrenome,rg=:rg where id_professor= :id_professor";
            $res = $pdo->prepare($sql);
            $res->bindParam(':cpf', $dados['cpf'], PDO::PARAM_STR);
            $res->bindParam(':nome', $dados['nome'], PDO::PARAM_STR);
            $res->bindParam(':sobrenome', $dados['sobrenome'], PDO::PARAM_STR);
            $res->bindParam(':rg', $dados['rg'], PDO::PARAM_STR);  
            $res->bindParam(':id_professor', $id_professor, PDO::PARAM_INT);  
    
        
        if ($res-> execute()) {
            print "<script>alert('Alterado com Sucesso')</script>";
            print "<script>location.href='home.php';</script>";
        } else {
            print "<script>alert('Erro na execução da consulta SQL: " . print_r($res->errorInfo(), true) . "')</script>";
            print "<script>location.href='home.php';</script>";
        }   
        // }

       break;
       case 'excluir':
        $id_professor=filter_input(INPUT_GET,"id",FILTER_SANITIZE_NUMBER_INT);
       
       $sql = "DELETE FROM professor WHERE id_professor= :id_professor";

       $res = $pdo->prepare($sql);
       $res->bindParam(':id_professor', $id_professor, PDO::PARAM_INT);

       if ( $res-> execute()) {

           print "<script>alert('Excluido com sucesso!')</script>";
           print "<script>location.href= home.php';</script>";
       } else {
           print "<script>alert('Erro ao excluir!')</script>";
           print "<script>location.href=home.php';</script>";
       }

       break;
    } }
