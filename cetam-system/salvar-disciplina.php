<?php
require_once("config.php");

if (isset($_REQUEST["acao"])) {

    switch ($_REQUEST["acao"]) {

        case 'cadastrar':

            $id_professor = filter_input(INPUT_POST, "id_professor", FILTER_SANITIZE_NUMBER_INT);

            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);


            $sql = "INSERT into disciplina (disciplina, dt_inicial, dt_final,carga_horaria,id_professor,id_turno, curso_id) VALUES (:disciplina, :dt_inicial, :dt_final, :carga_horaria,:id_professor,:id_turno, :curso_id)";

            $res = $pdo->prepare($sql);

            $query_disc = "INSERT into disciplina (disciplina, dt_inicial, dt_final,carga_horaria,id_professor,id_turno, curso_id) VALUES (:disciplina, :dt_inicial, :dt_final, :carga_horaria,:id_professor,:id_turno, :curso_id)";
            $res_disc = $pdo->prepare($query_disc);
            $res_disc->bindValue(":disciplina", $dados['disciplina']);
            $res_disc->bindValue(":dt_inicial", $dados['dt_inicial']);
            $res_disc->bindValue(":dt_final", $dados['dt_final']);
            $res_disc->bindValue(":carga_horaria", $dados['carga_horaria']);
            $res_disc->bindValue(":id_professor", $id_professor);
            $res_disc->bindValue(":id_turno", $dados['id_turno']);
            $res_disc->bindValue(":curso_id",  $dados['curso_id']);
            // $res_disc->execute();

            if ($res_disc->execute()) {
                print "<script>alert('Disciplina cadastrada com Sucesso!')</script>";
                print "<script>location.href='?page=visualizar_professor&id=$id_professor';</script>";
            } else {
                print "<script>alert('Erro na execução da consulta SQL: " . print_r($res->errorInfo(), true) . "')</script>";
                print "<script>location.href='?page=visualizar_professor&id=$id_professor';</script>";
            }
            break;

        case 'editar':
            $disc_id = filter_input(INPUT_POST, "disc_id", FILTER_SANITIZE_NUMBER_INT);
            $id_professor = filter_input(INPUT_POST, "id_professor", FILTER_SANITIZE_NUMBER_INT);
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

            if ($disc_id !== false) {

                $sql = "UPDATE disciplina SET disciplina = :disciplina, dt_inicial = :dt_inicial, dt_inicial = :dt_inicial, dt_final = :dt_final, carga_horaria=:carga_horaria,
                    id_professor=:id_professor,id_turno=:id_turno, curso_id=:curso_id WHERE disc_id = :disc_id";

                $res = $pdo->prepare($sql);
                $res->bindParam(":disc_id", $disc_id);
                $res->bindParam(":disciplina", $dados['disciplina']);
                $res->bindParam(":dt_inicial", $dados['dt_inicial']);
                $res->bindParam(":dt_final", $dados['dt_final']);
                $res->bindParam(":carga_horaria", $dados['carga_horaria']);
                $res->bindParam(":id_professor", $id_professor);
                $res->bindParam(":id_turno", $dados['id_turno']);
                $res->bindParam(":curso_id",  $dados['curso_id']);

                if ($res->execute()) {
                    print "<script>alert('Alterado com Sucesso')</script>";
                    print "<script>location.href='?page=visualizar_professor&id=$id_professor';</script>";
                } else {
                    // Imprima informações de erro para depuração
                    echo "Erro na execução da consulta SQL: ";
                    var_dump($res->errorInfo());
                    print "<script>location.href='?page=visualizar_professor&id=$id_professor';</script>";
                }
            } else {
                echo "Erro: disciplina não está definido corretamente.";
            }
            exit();
            break;

            case 'excluir':
                $disc_id=filter_input(INPUT_GET,"id",FILTER_SANITIZE_NUMBER_INT);     
                if (!empty($disc_id)) {
                $sql = "DELETE FROM disciplina WHERE disc_id = :disc_id";
                $res = $pdo->prepare($sql);
                $res->bindParam(':disc_id', $disc_id, PDO::PARAM_INT);
            
                if ($res->execute()) {
                    echo "Excluído com sucesso!";
                  print "<script>location.href='home.php';</script>";
                } else {
                    echo "<script>alert('Erro ao excluir!');</script>";
                    echo "<script>location.href='home.php';</script>";
                }}else {
                    print "<script>alert('Erro: Nenhum usuário encontrado!')</script>";
                }
                exit();
            break;
    }
}
