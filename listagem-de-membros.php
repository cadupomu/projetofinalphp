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
    <title>One in a million</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
  </head>
  <body>
    <?php include('navbar.php'); ?>
    <div class="col-6 offset-3">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nome</th>
                    <th>Data de Nascimento</th>
                    <th>Posição</th>
                    <th>Data cadastro</th>
                    <?php if($_SESSION['login']->cargos == "Administrador") {
                       
                       ?>
                    <th colspan="2">Gerenciar</th>
                    <?php } else {
                    "";
                   }
                   ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach(fnLocalizaMembroPorNome($nome) as $membro): ?>
                <tr>
                   <td><?= $membro->id ?></td> 
                   <td><?= $membro->nome ?></td>
                   <td><?= $membro->datanasc ?></td> 
                   <td><?= $membro->posicao ?></td>  
                   <td><?= $membro->created_at ?></td>
                   <?php if($_SESSION['login']->cargos == "Administrador") {
                       
                    ?>
                   <td><a href="#" onclick="gerirUsuario(<?= $membro->id ?>, 'edit');">Editar</a></td> 
                   <td><a href="#" onclick="return confirm('Deseja realmente excluir?') ? gerirUsuario(<?= $membro->id ?>, 'del') : '';">Excluir</a></td>
                   <?php } else {
                    "";
                   }
                   ?>
                </tr>
                <?php endforeach; ?>
            </tbody>
            <?php if(isset($notificacao)) : ?>
            <tfoot>
                <tr>
                    <td colspan="7"><?= $_COOKIE['notify'] ?></td>
                </tr>
            </tfoot>
            <?php endif; ?>
        </table>
    </div>
    <?php include("rodape.php"); ?>
    <script>
        window.post = (data) => {
            return fetch(
                'set-session.php',
                {
                    method: 'POST',
                    headers: {'Content-Type': 'application/json'},
                    body: JSON.stringify(data)
                }
            )
            .then(response => {
                console.log(`Requisição completa! Resposta:`, response);
            });
        }

        function gerirUsuario(id, action) {
            
            post({data : id});

            url = 'excluirMembro.php';
            if(action === 'edit')
                url = 'formulario-edita-membro.php';
            
            window.location.href = url;
        }
    </script>
  </body>
</html>