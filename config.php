<?php
    session_start();
    date_default_timezone_set('America/Sao_Paulo');

    if(!isset($_SESSION['login']) || empty(isset($_SESSION['login'])))
    {
        $page = "errorPage.php";
        setcookie('notify', $msg, time() + 10, "/twice/{$page}", 'localhost');
        header("location: {$page}");
        exit;
    }