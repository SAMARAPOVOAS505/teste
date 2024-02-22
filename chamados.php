<?php

    class Chamado  
    {
		private $idChamado;
		private $dataAtual;
		private $status;
        private $nome;
        private $local;
        private $desc;
        private $ip;
        private $coment;
        private $categ;
		private $dataUlt;
		private $LastID;
		private $chave;
		private $upload;

		
		public function getIdChamado() {
			return $this->idChamado;
		}
	
		public function setIdChamado($idChamado) {
			$this->idChamado = $idChamado;
		}

		public function getNome() {
			return $this->nome;
		}

		public function setNome($nome) {
			$this->nome = $nome;
		}

		public function getLocal() {
			return $this->local;
		}

		public function setLocal($local) {
			$this->local = $local;
		}

		public function getDesc() {
			return $this->desc;
		}

		public function setDesc($desc) {
			$this->desc = $desc;
		}

		public function getIp() {
			return $this->ip;
		}

		public function setIp($ip) {
			$this->ip = $ip;
		}

		public function getComent() {
			return $this->coment;
		}

		public function setComent($coment) {
			$this->coment = $coment;
		}

		public function getCateg() {
			return $this->categ;
		}

		public function setCateg($categ) {
			$this->categ = $categ;
		}

		public function getdataAtual() {
			return $this->dataAtual;
		}
	
		public function setdataAtual($dataAtual) {
			$this->dataAtual = $dataAtual;
		}
	
		public function getStatus() {
			return $this->status;
		}
	
		public function setStatus($status) {
			$this->status = $status;
		}

		public function getDataUlt() {
			return $this->dataUlt;
		}
	
		public function setDataUlt($dataUlt) {
			$this->dataUlt = $dataUlt;
		}

		public function getLastID() {
			return $this->LastID;
		}
	
		public function setLastID($LastID) {
			$this->LastID = $LastID;
		}

		public function getChave() {
			return $this->chave;
		}

		public function setChave($chave) {
			$this->chave = $chave;
		}

		public function getUpload() {
			return $this->upload;
		}
	
		public function setUpload($upload) {
			$this->upload = $upload;
		}
		

    }
    