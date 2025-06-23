<?php
require_once __DIR__ . '/../../app/models/Usuario.php';
require_once __DIR__ . '/../../app/models/UsuarioDAO.php';

class UsuarioController {
    public function cadastrar($dados) {
        $doador = new Usuario($dados['email'], $dados['senha'], $dados['tipo']);
        $dao = new UsuarioDAO();
        if ($dao->inserir($doador)) {
            return ['status' => 'success', 'message' => 'Usuario cadastrado com sucesso!'];
        } else {
            return ['status' => 'error', 'message' => 'Erro ao cadastrar usuario.'];
        }
    }
}
?>
