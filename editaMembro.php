<?php
    require_once('repository/MembroRepository.php');
    require_once('util/base64.php');
    session_start();

    $id = filter_input(INPUT_POST, 'idMembro', FILTER_SANITIZE_NUMBER_INT);
    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $datanasc = filter_input(INPUT_POST, 'datanasc', FILTER_SANITIZE_SPECIAL_CHARS);
    $posicao = filter_input(INPUT_POST, 'posicao', FILTER_SANITIZE_SPECIAL_CHARS);
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);

    $foto = converterBase64($_FILES['foto']);

    if(fnUpdateMembro($id, $foto, $nome, $datanasc, $posicao, $descricao)) {
        $msg = "Sucesso ao gravar";
    } else {
        $msg = "Falha na gravação";
    }
    
    $_SESSION['id'] = $id;
    $page = "formulario-edita-membro.php";
    setcookie('notify', $msg, time() + 10, "twice/{$page}", 'localhost');
    header("location: {$page}");
    exit;