<?php
    session_start();

    require_once('repository/loginrepository.php');

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $senha = filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_SPECIAL_CHARS);
    $usuario = filter_input(INPUT_POST, 'usuario', FILTER_SANITIZE_NUMBER_INT);

    if(fnAddUser($email, $senha, $usuario)) {
            $msg = "Sucesso ao gravar";
        } else {
            $msg = "Falha na gravação";
        }

    $page = "cadastrar.php";
    setcookie('notify', $msg, time() + 10, "twice/{$page}", 'localhost');
    header("location: {$page}");
    exit;