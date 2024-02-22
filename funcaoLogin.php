<?php

include_once("conexao.php");

session_start();

    if (isset($_POST['logar'])) {

        $user = isset($_POST['user']) ? $_POST['user']  : "<script>window.alert('digite todos os campos')
        window.location('http://172.16.60.75/chamados/login.php')</script>"; 
    
        $pass = isset($_POST['pass']) ? $_POST['pass']  : "<script>window.alert('digite todos os campos')
        window.location('http://172.16.60.75/chamados/login.php')</script>"; 

        $sql = "SELECT tipo from login where usuario = ? and senha = MD5(?)";

        $p_sql = Conexao::getConexao()->prepare($sql);
        $p_sql->bindValue(1, $user);
        $p_sql->bindValue(2,$pass);
        $p_sql->execute(); 
        $result = $p_sql->setFetchMode(PDO::FETCH_ASSOC);
        $dados  = $p_sql->fetchAll();
        $count  = count($dados);
        
            if ($count == 1) {

                setcookie('user',true,time() + 3600);
                
                $_SESSION['user'] = true; 
                
                /*echo 'voce esta logado';
                echo '<br>';
                echo 'seus dados';
                echo '<br>';
                print_r($_COOKIE);*/

             echo '<script>window.alert("Bem vindo :)")
            window.location.href = "http://172.16.60.75/chamados/listar.php"</script>';
        }else {
            
            setcookie('user', false, time()-3600);
            $_SESSION['user'] = false;

            echo '<script>window.alert("Você apenas pode abrir chamados ou não esta logado :)")
            window.location.href = "http://172.16.60.75/chamados/index.php"</script>';
        }     
    }else {

        echo '<script>window.alert("Você nao efetuou o login :/")
            //window.location.href = "http://172.16.60.75/chamados/index.php"</script>';
    }