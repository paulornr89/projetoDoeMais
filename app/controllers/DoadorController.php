<?php
require_once __DIR__ . '/../../app/models/Doador.php';
require_once __DIR__ . '/../../app/models/DoadorDAO.php';
require_once __DIR__ . '/../../app/models/Usuario.php';
require_once __DIR__ . '/../../app/models/UsuarioDAO.php';

class DoadorController {
    public function cadastrar($dados) {
        $usuario = new Usuario($dados['email'], $dados['senha'], 'D');
        $usuarioDao = new UsuarioDAO();
        $id_usuario = $usuarioDao->inserir($usuario);

        if($id_usuario) {
            $doador = new Doador($id_usuario, $dados['nome'], $dados['cpf_cnpj'], $dados['telefone'], $dados['cep'], 
                        $dados['endereco'], $dados['cidade'], $dados['uf'], $dados['tipo']);
            $doadorDao = new DoadorDAO();
            if ($doadorDao->inserir($doador)) {
                return ['status' => 'success', 'message' => 'Doador cadastrado com sucesso!'];
            } else {
                return ['status' => 'error', 'message' => 'Erro ao cadastrar doador.'];
            }
        }
    }
}
?>
