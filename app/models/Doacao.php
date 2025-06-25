<?php
    class Doacao {
        private $idDoador;
        private $idInstituicao;
        private $status;

        public function __construct($idDoador, $idInstituicao, $status) {
            $this->idDoador = $idDoador;
            $this->idInstituicao = $idInstituicao;
            $this->status = $status;
        }

        public function getIdDoador() {
            return $this->idDoador;
        }

        public function getIdInstituicao() {
            return $this->idInstituicao;
        }

        public function getStatus() {
            return $this->status;
        }

        public function setStatus($status) {
            $this->status = $status;
        }
    }
?>