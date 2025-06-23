<?php
    class Instituicao {
        private $idUsuario;
        private $razao;
        private $nomeFantasia;
        private $cnpj;
        private $telefone;
        private $cep;
        private $endereco;
        private $cidade;
        private $uf;


        public function __construct($idUsuario, $razao, $nomeFantasia, $cnpj, $telefone, $cep, $endereco, $cidade, $uf) {
            $this->idUsuario = $idUsuario;
            $this->razao = $razao;
            $this->nomeFantasia = $nomeFantasia;
            $this->cnpj = $cnpj;
            $this->telefone = $telefone;
            $this->cep = $cep;
            $this->endereco = $endereco;
            $this->cidade = $cidade;
            $this->uf = $uf;
        }
        
        public function getIdUsuario() {
            return $this->idUsuario;
        }

        public function getRazaoSocial() {
            return $this->razao;
        }
      
        public function getNomeFantasia() {
            return $this->nomeFantasia;
        }

        public function getCnpj() {
            return $this->cnpj;
        }

        public function getTelefone() {
            return $this->telefone;
        }

        public function getCep() {
            return $this->cep;
        }

        public function getEndereco() {
            return $this->endereco;
        }

        public function getCidade() {
            return $this->cidade;
        }

        public function getUf() {
            return $this->uf;
        }
    
        public function setIdUsuario($idUsuario) {
            $this->idUsuario = $idUsuario;
        }

        public function setRazaoSocial($razao) {
            $this->razao = $razao;
        }
        
        public function setNomeFantasia($nomeFantasia) {
            $this->nomeFantasia = $nomeFantasia;
        }
        
        public function setCpf_cnpj($cnpj) {
            $this->cnpj = $cnpj;
        }

        public function setTelefone($telefone) {
            $this->telefone = $telefone;
        }

        public function setCep($cep) {
            $this->cep = $cep;
        }

        public function setEndereco($endereco) {
            $this->endereco = $endereco;
        }

        public function setCidade($cidade) {
            $this->cidade = $cidade;
        }

        public function setUf($uf) {
            $this->uf = $uf;
        }
    }
?>