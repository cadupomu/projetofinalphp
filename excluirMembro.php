<?php

    require_once('repository/membrorepository.php');
    session_start();

    if(fnDeleteMembro($_SESSION['id'])) {
        $msg = "Sucesso ao apagar";
    } else {
        $msg = "Falha ao apagar";
    }

    unset($_SESSION['id']);

    $page = "listagem-de-membros.php";
    setcookie('notify', $msg, time() + 10, "/twice/{$page}", 'localhost');
    header("location: {$page}");
    exit;