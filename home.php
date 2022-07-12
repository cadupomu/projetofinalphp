<?php 
include('config.php'); 
require_once('repository/membrorepository.php');

$nome = filter_input(INPUT_GET, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);

?>
<!doctype html>
<html lang="pt_BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="estilo/estilo.css">
</head>

<body>
    <?php include('navbar.php'); ?>
    <div class="col-10 offset-1 mt-5">
        <div class="p-5 mb-4 bg-light rounded-3">
            <div class="container-fluid py-3">
                <h1 class="display-5 fw-bold">One in a million</h1>
                <p class="col-md-8 fs-4">Fanbase para o grupo sul-coreano TWICE feita por PHP.</p>
            </div>
        </div>
    </div>

    <div class="col-6 offset-3">
            <tbody>
                <?php foreach(fnLocalizaMembroPorNome($nome) as $membro): ?> 
                <tr>  
                <div class="card mb-3" style="max-width: 540px;">
                <div class="row g-0">
                    <div class="col-md-4">
                    <img src="<?= $membro->foto ?>" class="img-fluid rounded-start" alt="...">
                    </div>
                    <div class="col-md-8">
                    <div class="card-body">
                    <h5 class="card-title"><?= $membro->nome ?></h5>
                    <p class="card-text"><?= $membro->datanasc ?></p>
                    <p class="card-text"><?= $membro->posicao ?></p>
                    <p class="card-text"><?= $membro->descricao ?></p>
                    </div>
                    </div>
        <?php endforeach; ?>
    <?php include("rodape.php"); ?>
</body>

</html>