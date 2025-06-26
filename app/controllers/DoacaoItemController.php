<?php
    require_once __DIR__ . '/../../app/models/DoacaoItem.php';
    require_once __DIR__ . '/../../app/models/DoacaoItemDAO.php';

    class DoacaoItemController {
        public function registrar($dados) {
            $doacaoItem = new DoacaoItem($dados['id_doacao'], $dados['id_item'], $dados['quantidade']);
            $dao = new DoacaoItemDAO();

            if($dao->inserir($doacaoItem)) {
                return ['status' => 'success', 'message' => 'Item Registrado para a Doacao com sucesso.'];
            } else {
                return ['status' => 'error', 'message' => 'Erro ao registrar item para doacao.'];
            }
        }
    }
?>