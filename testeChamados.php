<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bulma/css/bulma.min.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <title>teste</title>
</head>
<body>
    <table class="">
    <th>nome</th>
        <?php
            require_once('conexao.php');

            //$stmt = $conn->prepare('SELECT nome from dbo.tickets');

            $consulta = $pdo->query("SELECT nome from dbo.tickets");


            while ($linha = $consulta->fetch(PDO::FETCH_ASSOC)) {
                
                echo "Nome: {$linha['nome']} - ";
            }
            
        ?>
    </table>
</body>
</html>