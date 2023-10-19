<?php

    session_start();

    date_default_timezone_set("America/Manaus");
    
    $localhost = 'localhost';
    $user = 'root';
    $pass = '';
    $base = 'sigpro_cetam';

    global $pdo;

    try{

        $pdo = new PDO("mysql:dbname=".$base."; host=".$localhost, $user,$pass);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }catch (PDOException $e){
        echo "ERRO: ".$e->getMessage();
        exit;
    }
