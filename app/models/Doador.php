<?php
class Doador {
    private $idUsuario;
    private $nome;
    private $cpf_cnpj;
    private $telefone;
    private $cep;
    private $endereco;
    private $cidade;
    private $uf;
    private $tipo;


    public function __construct($idUsuario, $nome, $cpf_cnpj, $telefone, $cep, $endereco, $cidade, $uf, $tipo) {
        $this->idUsuario = $idUsuario;
        $this->nome = $nome;
        $this->cpf_cnpj = $cpf_cnpj;
        $this->telefone = $telefone;
        $this->cep = $cep;
        $this->endereco = $endereco;
        $this->cidade = $cidade;
        $this->uf = $uf;
        $this->tipo = $tipo;
    }
    
    public function getIdUsuario() {
        return $this->idUsuario;
    }
    
    public function getNome() {
        return $this->nome;
    }

    public function getCpf_cnpj() {
        return $this->cpf_cnpj;
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

    public function getTipo() {
        return $this->tipo;
    }
        
    public function setIdUsuario($idUsuario) {
        $this->idUsuario = $idUsuario;
    }
        
    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function setCpf_cnpj($cpf_cnpj) {
        $this->cpf_cnpj = $cpf_cnpj;
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

    public function setTipo($tipo) {
        $this->tipo = $tipo;
    }
}
?>