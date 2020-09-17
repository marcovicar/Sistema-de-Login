<?php
    session_start(); 
    if(!isset($_SESSION['id_usuario'])){ //verifica se o usuario está logado
        header("location: ../login/index.php");
        exit;
    }


?>

Olá, seja bem vindo!

<a href="../logout/logout.php"> Sair </a>