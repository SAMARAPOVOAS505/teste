<?php
    setcookie('user',false,time() + 3600);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="bulma/css/bulma.min.css">
    <link rel="stylesheet" href="font-awesome/css/font-awesome.min.css">
    <link rel="icon" href="icone.png">
    <title>Login</title>
    <style>
         .box{
            margin-left: 30%;
            margin-top: 4%;
            width: 400px;
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar is-light">
            <h1 style=" color: black; text-transform: capitalize; font-family: Arial; font-size: 30px; margin-left: 45%;">Login</h1>
          </nav>
    </header>
    <div class="box">
        <form action="funcaoLogin.php" method="post">
            <div class="field">
                <p class="control has-icons-left has-icons-right">
                    <input class="input" type="text" name="user" placeholder="Usuário" id="user" required>
                    <span class="icon is-small is-left">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    </span>
                </p>
            </div>
            <div class="field">
                <p class="control has-icons-left">
                    <input class="input" type="password" name="pass" id="pass" placeholder="Senha" required>
                    <span class="icon is-small is-left">
                    <i class="fa fa-lock" aria-hidden="true"></i>
                    </span>
                </p>
            </div>
            <div class="field is-grouped">
                <div class="control">
                   <button type="submit" name="logar" value="logar" class="button is-link">Entrar</button>
                </div>
              </div>
        </form>
    </div>

<script src="js/jquery.js"></script>
</body>
</html>