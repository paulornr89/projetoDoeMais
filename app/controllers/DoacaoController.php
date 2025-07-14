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

        public function listar($email) {
            $dao = new DoacaoDAO();
            $doacoes = $dao->listar($email);

            foreach ($doacoes as &$doacao) {
                $doacao['nome'] = $this->nomeParcial($doacao['nome']);
            }

            return ['status' => 'success', 'dados' => $doacoes];
        }

        private function nomeParcial($nomeCompleto) {
            $partes = explode(" ", $nomeCompleto);
            return $partes[0] . (isset($partes[1]) ? ' ' . substr($partes[1], 0, 1) . '.' : '');
        }
    }
?>
