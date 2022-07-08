<?php

    require_once('repository/membrorepository.php');
    require_once('util/base64.php');

    $nome = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    $datanasc = filter_input(INPUT_POST, 'datanasc', FILTER_SANITIZE_SPECIAL_CHARS);
    $posicao = filter_input(INPUT_POST, 'posicao', FILTER_SANITIZE_SPECIAL_CHARS);
    $descricao = filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_SPECIAL_CHARS);

    $foto = converterBase64($_FILES['foto']);

    if(empty($nome) || empty($datanasc) || empty($posicao) || empty($descricao)) {
        $msg = "Preencher todos os campos primeiro.";
    } else {
        if(fnAddMembro($foto, $nome, $datanasc, $posicao, $descricao)) {
            $msg = "Sucesso ao gravar";
        } else {
            $msg = "Falha na gravação";
        }
    }
    
    $page = "formulario-cadastro-membro.php";
    setcookie('notify', $msg, time() + 10, "twice/{$page}", 'localhost');
    header("location: {$page}");
    exit;