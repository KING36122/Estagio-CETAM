<?php

if (isset($_POST['email']) && !empty($_POST['email']) && isset($_POST['senha']) &&  !empty($_POST['senha'])){
   require 'config.php';
   require 'usuario_class.php';

$us = new Usuario();

    $email= addslashes($_POST['email']);
    $senha= addslashes ($_POST['senha']); 

 if  ($us->login($email, $senha)==true){
        if(isset($_SESSION['adm_id'])){
            header("Location:home.php"); 
        }
 } else{
    header("Location:index.php");
 }
} else{

    header("Location:index.php");

}
    
?>

