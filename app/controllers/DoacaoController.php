<?php
    require_once __DIR__ . '/../../app/models/Doacao.php';
    require_once __DIR__ . '/../../app/models/DoacaoDAO.php';

    class DoacaoController {
        public function cadastrar($dados) {
            $doacao = new Doacao($dados['id_doador'], $dados['id_instituicao'], $dados['status']);
            $dao = new DoacaoDAO();
            $idDoacao = $dao->inserir($doacao);
            if ($idDoacao) {
                return ['status' => 'success', 'message' => 'Doacao cadastrada com sucesso!', 'id' => $idDoacao];
            } else {
                return ['status' => 'error', 'message' => 'Erro ao cadastrar doacao.'];
            }
        }
    }
?>
