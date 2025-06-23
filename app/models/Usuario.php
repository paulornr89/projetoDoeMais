<?php
    class Usuario {
        private $email;
        private $senha;
        private $tipo;

        public function __construct($email, $senha, $tipo) {
            $this->email = $email;
            $this->setSenha($senha);
            $this->tipo = $tipo;
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

        public function setEmail($email) {
            $this->email = $email;
        }

        public function setSenha($senha) {
            $this->senha = password_hash($senha, PASSWORD_DEFAULT);
        }
    }
?>