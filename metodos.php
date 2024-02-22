<?php

class Metodos  {

    public function create(Chamado $chamado){

        try {

            $dtaAtual = $chamado->getdataAtual();
            $status   = $chamado->getStatus();
            $nome     = $chamado->getNome();
            $local    = $chamado->getLocal();
            $desc     = $chamado->getDesc();
            $ip       = $chamado->getIp();
            $coment   = $chamado->getComent();
            $categ    = $chamado->getCateg();
            $upload   = $chamado->getUpload();
            $ultima   = $chamado->getDataUlt();
            
            
            $sql = "INSERT INTO tickets (DataAbertura,statusC,nome,local,descricao,ip,comentario,categoria,upload,ultima_ateracao) VALUES ('$dtaAtual','$status','$nome','$local','$desc','$ip','$coment','$categ','$upload','$ultima')";

            $p_sql = Conexao::getConexao()->prepare($sql);
            
            return $p_sql->execute();

        } catch (PDOException $e) {
            echo "nao foi possivel fazer a inserçao" . "<br>" . $e->getMessage();
        }

    }
    public function read(){
        try {
            $sql = "SELECT idChamado,DataAbertura,statusC,nome,local,descricao,ip,comentario,categoria,upload FROM tickets where statusC not in ('4- Solucionado','5 - Fechado (Sem solução)') order by idchamado desc";
            $result = Conexao::getConexao()->query($sql);
            $lista = $result->fetchAll(PDO::FETCH_ASSOC);
            $f_lista = array();
            foreach ($lista as $l) {
                $f_lista[] = $this->listarChamados($l);
            }
            return $f_lista;
        } catch (PDOException $e) {
            print "Ocorreu um erro ao tentar Buscar Todos." . $e;
        }
    }
    
    public function update(Chamado $chamado){
        try {
            
            $sql = "UPDATE tickets SET
            statusC=:statusC, 
            comentario=:coment,
            ultima_ateracao=:dataA
            
            WHERE idChamado = :id ";

            $p_sql = Conexao::getConexao()->prepare($sql);
            $p_sql->bindValue(":statusC", $chamado->getStatus());
            $p_sql->bindValue(":coment", $chamado->getComent());
            $p_sql->bindValue(":dataA", $chamado->getDataUlt());
            $p_sql->bindValue(":id", $chamado->getIdChamado());
            return $p_sql->execute();
        } catch (PDOException $e) {
            echo "nao foi possivel fazer a ediçao ".$e->getMessage();
        }
    }
    public function delete(Chamado $chamado){

        try {
            $id = $chamado->getIdChamado();
            $sql = "DELETE FROM tickets WHERE idChamado = {$id}";
            $p_sql = Conexao::getConexao()->prepare($sql);
            return $p_sql->execute();
        } catch (PDOException $e) {
            echo "Erro ao Excluir Chamado<br> $e <br>";
        }
    }
    private function listarChamados($row){
         $chamado = new Chamado;
         $chamado->setIdChamado($row['idChamado']);
         $chamado->setdataAtual($row['DataAbertura']);
		 $chamado->setstatus($row['statusC']);
         $chamado->setnome($row['nome']);
         $chamado->setlocal($row['local']);
         $chamado->setdesc($row['descricao']);
         $chamado->setip($row['ip']);
         $chamado->setcoment($row['comentario']);
         $chamado->setCateg($row['categoria']);
		 //$chamado->setdataUlt($row['ultima_ateracao']);
         $chamado->setUpload($row['upload']);
        
         return $chamado;
    }
   
}


   