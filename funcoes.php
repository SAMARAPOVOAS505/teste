<?php

include_once("conexao.php");
include_once("metodos.php");
include_once("chamados.php");

    $chamado    = new Chamado();
    $chamadodao = new Metodos();

    $array = filter_input_array(INPUT_POST);

    if (isset($_POST['enviar'])) {
            
            $nome = isset($_POST['nome']) ? $_POST['nome']  : "<script>window.alert('digite todos os campos')
            window.location('http://172.16.60.75/chamados/index.php')</script>"; 
            $local = isset($_POST['local']) ? $_POST['local']  : "<script>window.alert('digite todos os campos')
            window.location('http://172.16.60.75/chamados/index.php')</script>"; 
            $categ = isset($_POST['categ']) ? $_POST['categ']  : "<script>window.alert('digite todos os campos')
            window.location('http://172.16.60.75/chamados/index.php')</script>"; 
            $desc = isset($_POST['desc']) ? $_POST['desc']  : "<script>window.alert('digite todos os campos')
            window.location('http://172.16.60.75/chamados/index.php')</script>"; 
            

            date_default_timezone_set('America/Sao_Paulo');
            $dataAtual = date('d/m/Y H:i', time());
            $status    = 'Novo';
            $dataUlt   = date('d/m/Y H:i', time()); 
            $coment    = null;
            


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

            $ipFinal = get_client_ip();

            $extensao = strtolower(substr($_FILES['userfile']['name'], -4));
            $novo_nome = $nome.$extensao;
            $diretorio = "files/";
            
            if (move_uploaded_file($_FILES['userfile']['tmp_name'], $diretorio.$novo_nome) == TRUE) {
                $arquivo = $novo_nome;
            }else {
                $arquivo = "Null";
            }

            $chamado->setdataAtual($dataAtual);
            $chamado->setStatus($status);    
            $chamado->setNome($nome);
            $chamado->setLocal($local);
            $chamado->setCateg($categ);
            $chamado->setComent($coment);
            $chamado->setDesc($desc);
            $chamado->setIp($ipFinal);
            $chamado->setDataUlt($dataUlt);
            $chamado->setUpload($arquivo);
     

        $chamadodao->create($chamado);

        echo '<script>window.alert("CHAMADO ABERTO COM SUCESSO, A EQUIPE DE TI JÁ FOI INFORMADA DE SEU CHAMADO.")
        window.location.href = "http://172.16.60.75/chamados/status.php"</script>';

    }elseif (isset($_POST['editar'])) {
        date_default_timezone_set('America/Sao_Paulo');
        $dataUlt   = date('d/m/Y H:i', time()); 
        $chamado->setComent($array['comentario']);
        $chamado->setStatus($array['status']);
        $chamado->setIdChamado($array['idChamado']);
        $chamado->setDataUlt($dataUlt); 
    
        $chamadodao->update($chamado);
        
        echo '<script>window.alert("Chamado atualizado com sucesso :)")
        window.location.href = "http://172.16.60.75/chamados/listar.php"</script>';

    }elseif (isset($_GET['del'])) {

        $chamado->setIdChamado($_GET['del']);

        $chamadodao->delete($chamado);

        echo '<script>window.alert("Chamado excluido com sucesso :)")
        window.location.href = "http://172.16.60.75/chamados/listar.php"</script>';

    }else {
        echo '<script>window.alert("Nada a declarar  :( ")';

    }

    