<?php
require_once __DIR__ . '/../models/Doador.php';
require_once __DIR__ . '/../models/DoadorDAO.php';

class DoadorController {
    public function cadastrar($dados) {
        $doador = new Doador($dados['nome'], $dados['email'], $dados['cpf_cnpj'], $dados['telefone'], $dados['cep'], 
                    $dados['endereco'], $dados['cidade'], 
                    $dados['uf'], $dados['tipo'], $dados['senha']);
        $dao = new DoadorDAO();
        if ($dao->inserir($doador)) {
            return ['status' => 'success', 'message' => 'Doador cadastrado com sucesso!'];
        } else {
            return ['status' => 'error', 'message' => 'Erro ao cadastrar doador.'];
        }
    }
}
?>
