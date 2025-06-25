<?php
    require_once __DIR__ . '/../../app/models/Doacao.php';
    require_once __DIR__ . '/../../app/models/DoacaoDAO.php';

    class DoacaoController {
        public function cadastrar($dados) {
            $doacao = new Doacao($dados['id_doador'], $dados['id_instituicao'], $dados['status']);
            $dao = new DoacaoDAO();
            if ($dao->inserir($doacao)) {
                return ['status' => 'success', 'message' => 'Doação cadastrada com sucesso!'];
            } else {
                return ['status' => 'error', 'message' => 'Erro ao cadastrar doação.'];
            }
        }
    }
?>
