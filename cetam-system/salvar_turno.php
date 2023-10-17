<?php
require_once("config.php");

if (isset($_REQUEST["acao"])) {

    switch ($_REQUEST["acao"]) {
        case 'cadastrar':
            $turno = isset($_POST["turno"]) ? $_POST["turno"] : '';

            if (!empty($turno)) {
                $sql = "insert into turno (turno) values ('{$turno}')";

                $res = $pdo->query($sql);

                if ($res == true) {
                    print "<script>alert('Cadastro realizado com sucesso!!!');</script>";
                    print "<script>location.href='?page=turnos';</script>";
                } else {
                    print "<script>alert('Erro ao realizar cadastro!!!');</script>";
                    print "<script>location.href='?page=turnos';</script>";
                }
            } else {
                print "<script>alert('Preencha todos os campos obrigatórios!');</script>";
                print "<script>location.href='?page=turnos';</script>";
            }
            break;

        case 'editar':
            $id_turno= filter_input(INPUT_POST, "id_turno", FILTER_SANITIZE_NUMBER_INT);
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            // var_dump($dados);

            $dados = array_map('trim', $dados);
      
            if (in_array("", $dados)) {
                $empty_input = true;
                echo "Preencha todos campos!";
            }

            // if (!$empty_input) {
                $sql =   "UPDATE turno SET turno=:turno where id_turno= :id_turno";
                $res = $pdo->prepare($sql);
                $res->bindParam(':turno', $dados['turno'], PDO::PARAM_STR);
                $res->bindParam(':id_turno', $id_turno, PDO::PARAM_INT);
            
            if ($res-> execute()) {
                print "<script>alert('Alterado com Sucesso')</script>";
                print "<script>location.href='?page=turnos';</script>";
            } else {
                print "<script>alert('Erro na execução da consulta SQL: " . print_r($res->errorInfo(), true) . "')</script>";
                print "<script>location.href='?page=turnos';</script>";
            }   
            // }

           break;

        case 'excluir':

            $id_turno=filter_input(INPUT_GET,"id",FILTER_SANITIZE_NUMBER_INT);
            
            $sql = "DELETE FROM turno WHERE id_turno = :id_turno";
            $res = $pdo->prepare($sql);
            $res->bindParam(':id_turno', $id_turno, PDO::PARAM_INT);
        
            if ($res->execute()) {
                echo "Excluído com sucesso!";
                echo "<script>location.href='?page=turnos';</script>";
            } else {
                echo "<script>alert('Erro ao excluir!');</script>";
                echo "<script>location.href='?page=turnos';</script>";
            }


            break;
    }
}
