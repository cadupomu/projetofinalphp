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
            <tbody>
                <?php foreach(fnLocalizaMembroPorNome($nome) as $membros): ?>
                <tr>
                <div class="card" style="width: 18rem;">
               <img src="<?= $membros->foto ?>" class="card-img-top" alt="...">
               <div class="card-body">
                 <h5 class="card-title"><?= $membros->nome ?></h5>
                 <p class="card-text"><?= $membros->descricao ?></p>
                </div>
               <ul class="list-group list-group-flush">
                 <li class="list-group-item"><?= $membros->id ?></li>
                 <li class="list-group-item"><?= $membros->datanasc ?></li>
                 <li class="list-group-item"><?= $membros->posicao ?></li>
               </ul>
               <div class="card-body">
                 <a href="#" onclick="gerirUsuario(<?= $membros->id ?>, 'edit');">Editar</a>
                 <a onclick="return confirm('Deseja realmente excluir?') ? gerirUsuario(<?= $membros->id ?>, 'del') : '';" href="#">Excluir</a>
                </div>
                </div>
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