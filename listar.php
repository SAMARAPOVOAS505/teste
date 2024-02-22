<?php 

    if (!isset($_COOKIE) && !isset($_SESSION)  || $_COOKIE['user'] == false && $_SESSION['user'] == false) {
        echo "Você apenas pode abrir chamados ou não esta logado :)";
        echo '<script>window.alert("Você apenas pode abrir chamados :)")
        window.location.href = "http://172.16.60.75/chamados/index.php"</script>';
    }else {
        //print_r($_COOKIE);
    }
    require_once('conexao.php');
    require_once('metodos.php');
    require_once('chamados.php');

    $chamadodao = new Metodos();
    header("Refresh:60");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
      <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
      <link rel="icon" href="icone.png">
    <title>Chamados abertos</title>
    <style>
        body{
            background-color: #0E1012;
            
        }
        h1{
            text-align: center; 
            color: #eceaeac7;
            text-transform: capitalize; 
            font-family: Arial; 
            font-size: 30px; 
            margin-left: 35%;
            
        }
        nav {
            background-color: #2b2b2bdc;
            
        }
        .row {
            padding: 10px;
        }
        table{
            color: #eceaeac7;
        }
    </style>
</head>
<body>
    <header>
          <nav class="navbar navbar-light">
          <h1 class="display-6">CHAMADOS ABERTOS</h1>

          </nav>
    </header>
    <div class="container">

    
        <br>
        <div class="table-responsive">
        <table class="table table-sm" style="color: #eceaeac7;">
            <thead style="background-color: #1D72C4;">
                <tr>
                    <th>ID</th>
                    <th>Data da Abertura</th>
                    <th>Status</th>
                    <th>Nome</th>
                    <th>Localização</th>
                    <th>Descrição</th>
                    <th>IP</th>
                    <th>Comentário</th>
                    <th>Categoria</th> 
                    <th>Anexo</th>
                    <!-- <th>Ultima Atualização</th> -->
                    
                    <th>Açoes</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($chamadodao->read() as $chamado) :  ?>
                        <tr>
                                <td><?= $chamado->getIdChamado() ?></td>
                                <td><?= $chamado->getdataAtual() ?></td>
                                <td><?= $chamado->getstatus() ?></td>
                                <td><?= $chamado->getnome() ?></td>
                                <td><?= $chamado->getlocal()?></td>
                                <td><?= $chamado->getdesc() ?></td>
                                <td><?= $chamado->getip() ?></td>
                                <td><?= $chamado->getcoment()?></td>
                                <td><?= $chamado->getCateg() ?></td>
                                <td><?php if ($chamado->getUpload() == "Null") : ?>
                                        
                                        <?php  else :  ?>
                                            <a href="files/<?= $chamado->getUpload()?>" download="<?= $chamado->getUpload()?>"><i class="fa fa-download" aria-hidden="true"></i></a>
                                        <?php endif ?>
                                </td>   
                                
                                <td class="text-center">
                                    <button class="btn  btn-warning btn-sm" id="editarModal" data-toggle="modal" data-target="#editar><?= $chamado->getIdChamado() ?>">
                                        Atualizar
                                    </button>
                                </td>
                        </tr>
                        <!-- MODAL -->
                        <div class="modal fade" id="editar><?= $chamado->getIdChamado() ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="funcoes.php" method="POST">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Comentário</label>
                                                    <input type="text" name="comentario" value="<?= $chamado->getComent() ?>" class="form-control" required = "campo obrigatorio!" />
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <label>Status</label>
                                                        <select name="status" class="form-control">
                                                        <?php if ($chamado->getStatus() == 1 ) : ?>
                                                                <option value="1 - Novo">1 - Novo</option>
                                                                <option selected value="2 - Em Atendimento">2 - Em Atendimento</option>
                                                                <option value="3 - Em Análise (Pendente)">3 - Em Análise (Pendente)</option>
                                                                <option  value="4- Solucionado">4 - Solucionado</option>
                                                                <option value="5 - Fechado (Sem solução)">5 - Fechado (Sem solução)</option>
                                                            <?php else : ?>
                                                                <option value="1 - Novo">1 - Novo</option>
                                                                <option selected value="2 - Em Atendimento">2 - Em Atendimento</option>
                                                                <option value="3 - Em Análise (Pendente)">3 - Em Análise (Pendente)</option>
                                                                <option  value="4- Solucionado">4 - Solucionado</option>
                                                                <option value="5 - Fechado (Sem solução)">5 - Fechado (Sem solução)</option>
                                                            <?php endif ?>
                                                        </select>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-2">
                                                    <br>
                                                    <input type="hidden" name="idChamado" value="<?= $chamado->getIdChamado() ?>" />
                                                    <button class="btn btn-primary" type="submit" name="editar">Editar</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php endforeach ?>
            </tbody>
        </table>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
        $(".modal fade").hide();
        $("#editarModal").click(function(){
        $(".modal fade").modal("show"); 
        });
    });
    </script>

    
</body>
</html>