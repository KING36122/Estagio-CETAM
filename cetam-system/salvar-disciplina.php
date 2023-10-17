<?php
require_once("config.php");

if (isset($_REQUEST["acao"])) {

    switch ($_REQUEST["acao"]) {

        case 'cadastrar':

            $id_professor = filter_input(INPUT_POST, "id_professor", FILTER_SANITIZE_NUMBER_INT);
         
            $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
            var_dump($dados);


            $sql = "INSERT into disciplina (disciplina, dt_inicial, dt_final,carga_horaria,id_professor,id_turno, curso_id) VALUES (:disciplina, :dt_inicial, :dt_final, :carga_horaria,:id_professor,:id_turno, :curso_id)";

            $res = $pdo->prepare($sql);
            
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
    }
}
