<?php
require_once __DIR__ . '/../models/Item.php';
require_once __DIR__ . '/../models/ItemDAO.php';

class ItemController {
    public function cadastrar($dados) {
        $item = new Item($dados['descricao'], $dados['tipo'], $dados['unidade']);
        $dao = new ItemDAO();
        if ($dao->inserir($item)) {
            return ['status' => 'success', 'message' => 'Doador cadastrado com sucesso!'];
        } else {
            return ['status' => 'error', 'message' => 'Erro ao cadastrar doador.'];
        }
    }
    
    public function listar() {
        $dao = new ItemDAO();
        $itens = $dao->listar();
        return ['status' => 'success', 'data' => $itens];
    }
}
?>
