<?php
require_once __DIR__ . '/../models/Item.php';
require_once __DIR__ . '/../models/ItemDAO.php';

class ItemController {
    public function cadastrar($dados) {
        $item = new Item($dados['descricao'], $dados['tipo'], $dados['unidade'], $dados['imagem']);
        $dao = new ItemDAO();
        if ($dao->inserir($item)) {
            return ['status' => 'success', 'message' => 'Item cadastrado com sucesso!'];
        } else {
            return ['status' => 'error', 'message' => 'Erro ao cadastrar item.'];
        }
    }
    
    public function listar() {
        $dao = new ItemDAO();
        $itens = $dao->listar();
        return ['status' => 'success', 'data' => $itens];
    }

    public function atualizar($dados) {
        $item = new Item($dados['descricao'], $dados['tipo'], $dados['unidade'], $dados['imagem']);
        $id = $dados['id'];
        $dao = new ItemDAO();
        if ($dao->atualizar($item, $id)) {
            return ['status' => 'success', 'message' => 'Item atualizado com sucesso!'];
        } else {
            return ['status' => 'error', 'message' => 'Erro ao atualizar item.'];
        }
    }

    public function deletar($dados) {
        $id = $dados['id'];
        $dao = new ItemDAO();
        if ($dao->deletar($id)) {
            return ['status' => 'success', 'message' => 'Item deletado com sucesso!'];
        } else {
            return ['status' => 'error', 'message' => 'Erro ao deletar item.'];
        }
    }
}
?>
