<?php
    require_once('repository/membrorepository.php');
    $nome = filter_input(INPUT_POST, 'nomeMembro', FILTER_SANITIZE_SPECIAL_CHARS);

    header("location: listagem-de-membros.php?nome={$nome}");
    exit;