<?php
class Item {
    private $descricao;
    private $tipo;
    private $unidade;
    private $imagem;


    public function __construct($descricao, $tipo, $unidade, $imagem = null) {
        $this->descricao = $descricao;
        $this->tipo = $tipo;
        $this->unidade = $unidade;
        $this->imagem = $imagem;
    }
    
    public function getDescricao() {
        return $this->descricao;
    }

    public function getTipo() {
        return $this->tipo;
    }

    public function getUnidade() {
        return $this->unidade;
    }

    public function getImagem() {
        return $this->imagem;
    }
        
    public function setDescricao($descricao) {
        $this->descricao = $descricao;
    }

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }

    public function setUnidade($unidade) {
        $this->unidade = $unidade;
    } 

    public function setImagem($imagem) {
        $this->imagem = $imagem;
    } 
}
?>