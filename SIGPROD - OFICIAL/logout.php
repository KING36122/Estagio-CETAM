<?php
session_start();

unset($_SESSION['adm_id']);

header("Location: index.php");
?>