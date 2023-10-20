<?php

class Usuario{

    public function login($email, $senha){
        global $pdo;

        $sql = "SELECT * FROM administrador WHERE email = :email and senha = :senha";
        $sql = $pdo-> prepare($sql);
        $sql -> bindValue("email", $email);
        $sql -> bindValue("senha", ($senha));
        $sql -> execute();

        if($sql->rowCount()>0){
            $dado = $sql->fetch();
        $_SESSION['adm_id'] = $dado['adm_id'];

        return true;

        }
        else{
            return false;
        }
    }
}
?>