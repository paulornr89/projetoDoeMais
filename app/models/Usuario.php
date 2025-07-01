<?php
    class Usuario {
        private $email;
        private $senha;
        private $tipo;
        private $id;

        public function __construct($email, $senha, $tipo, $id = null) {
            $this->email = $email;
            $this->setSenha($senha);
            $this->tipo = $tipo;
            $this->id = $id;
        }

        public function getEmail() {
            return $this->email;
        }

        public function getSenha() {
            return $this->senha;
        }

        public function getTipo() {
            return $this->tipo;
        }

        public function getId() {
            return $this->id;
        }

        public function setEmail($email) {
            $this->email = $email;
        }
        
        public function setSenha($senha) {
            $this->senha = password_hash($senha, PASSWORD_DEFAULT);
        }
        
        public function setSenhaHash($hash) {
            $this->senha = $hash;
        }
        
        public function setId($id) {
            $this->id = $id;
        }
    }
?>