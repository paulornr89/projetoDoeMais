<?php
    class DoacaoItem {
        private $id_item;
        private $id_doacao;
        private $quantidade;

        public function __construct($id_item, $id_doacao, $quantidade) {
            $this->id_item = $id_item;
            $this->id_doacao = $id_doacao;
            $this->quantidade = $quantidade;            
        }

        public function getIdItem() {
            return $this->id_item;
        }

        public function getIdDoacao() {
            return $this->id_doacao;
        }

        public function getQuantidade() {
            return $this->quantidade;
        }
    }
?>