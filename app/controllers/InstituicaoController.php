<?php
require_once __DIR__ . '/../../app/models/Instituicao.php';
require_once __DIR__ . '/../../app/models/InstituicaoDAO.php';
require_once __DIR__ . '/../../app/models/Usuario.php';
require_once __DIR__ . '/../../app/models/UsuarioDAO.php';

class InstituicaoController {
    public function cadastrar($dados) {
        $usuario = new Usuario($dados['email'], $dados['senha'], 'I');
        $usuarioDao = new UsuarioDAO();
        $id_usuario = $usuarioDao->inserir($usuario);

        if($id_usuario) {
            $instituicao = new Instituicao($id_usuario, $dados['razao'], $dados['nome_fantasia'], $dados['cnpj'], $dados['telefone'], $dados['cep'], 
                        $dados['endereco'], $dados['cidade'], $dados['uf']);
            $instituicaoDao = new InstituicaoDAO();
            if ($instituicaoDao->inserir($instituicao)) {
                return ['status' => 'success', 'message' => 'Instituicao cadastrada com sucesso!'];
            } else {
                
                return ['status' => 'error', 'message' => 'Erro ao cadastrar instituicao.'];
            }
        }
    }

    public function listar() {
        $dao = new InstituicaoDAO();
        $instituicoes = $dao->listarInstituicoes();

        return ['status' => 'success', 'data' => $instituicoes];
    }
}
?>
