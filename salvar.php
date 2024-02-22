<?php

 
    require_once('conexao.php');
    if (isset($_POST['enviar'])) {
            $nome = isset($_POST['nome']) ? $_POST['nome']  : "<script>window.alert('digite todos os campos')
            window.location('http://172.16.60.75/chamados/index.php')</script>"; 
            $local = isset($_POST['local']) ? $_POST['local']  : "<script>window.alert('digite todos os campos')
            window.location('http://172.16.60.75/chamados/index.php')</script>"; 
            $categ = isset($_POST['categ']) ? $_POST['categ']  : "<script>window.alert('digite todos os campos')
            window.location('http://172.16.60.75/chamados/index.php')</script>"; 
            $desc = isset($_POST['desc']) ? $_POST['desc']  : "<script>window.alert('digite todos os campos')
            window.location('http://172.16.60.75/chamados/index.php')</script>"; 
            
            function get_client_ip() {
                $ipaddress = '';
                if (isset($_SERVER['HTTP_CLIENT_IP']))
                    $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
                else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
                    $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
                else if(isset($_SERVER['HTTP_X_FORWARDED']))
                    $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
                else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
                    $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
                else if(isset($_SERVER['HTTP_FORWARDED']))
                    $ipaddress = $_SERVER['HTTP_FORWARDED'];
                else if(isset($_SERVER['REMOTE_ADDR']))
                    $ipaddress = $_SERVER['REMOTE_ADDR'];
                else
                    $ipaddress = 'UNKNOWN';
                return $ipaddress;
            }
            //echo get_client_ip();
            
            $ipFinal = get_client_ip();
            $nome1   = strip_tags($nome);
            $local1  = strip_tags($local);
            $categ1  = strip_tags($categ);
            $desc1   = strip_tags($desc);
                    
            $Newnome    = filter_var($nome1, FILTER_SANITIZE_STRING);
            $Newlocal   = filter_var($local1, FILTER_SANITIZE_STRING);
            $Newcateg   = filter_var($categ1, FILTER_SANITIZE_STRING);
            $Newdescri  = filter_var($desc1, FILTER_SANITIZE_STRING);

            try {

            $consulta = "INSERT INTO tickets (DataAbertura,status,nome,local,descricao,ip,comentario,categoria,ultima_ateracao) VALUES (now(),1,'$Newnome','$Newlocal','$Newdescri','$ipFinal',null,'$Newcateg',now())";
                $sql = $conn->prepare($consulta);
                $sql->execute();

                echo '<script>window.alert("Chamado solicitado com sucesso :)")
                window.location.href = "http://172.16.60.75/chamados/index.php"</script>';

            } catch (PDOException $e) {
                echo $consulta . "<br>" . $e->getMessage();
            }
    }

    echo "<script>window.location.href ='http://172.16.60.75/chamados/index.php'</script>";

