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

    public function autenticar($dados) {
        session_start();

        $dao = new UsuarioDAO();
        $usuario = $dao->consultarPorEmail($dados['email']);

        if ($usuario && password_verify($dados['senha'], $usuario->getSenha())) {
            $_SESSION['usuario_id'] = $usuario->getEmail(); // ou ID, se tiver
            $_SESSION['usuario_tipo'] = $usuario->getTipo();
            $_SESSION['id'] = $usuario->getId();
            $_SESSION['imagem'] = $usuario->getImagem();

            // if($usuario->getEmail() == 'paulornr89@gmail.com'){
            //     header('Location: /projetoDoar/public/menuAdmin.php');
            // } else 
            if($usuario->getTipo() == 'D'){
               header('Location: /projetoDoar/public/menuDoador.php');
            } else if($usuario->getTipo() == 'I'){
                header('Location: /projetoDoar/public/menuInstituicao.php');
            }
        } else {
            header('Location: /projetoDoar/public/login.php?erro=1');
        }
        exit;
    }

    public function deletar($id) {
        $dao = new UsuarioDAO();
        if ($dao->deletar($id)) {
            return ['status' => 'success', 'message' => 'Usuário deletado com sucesso!'];
        } else {
            return ['status' => 'error', 'message' => 'Erro ao deletar usuário.'];
        }
    }

    public function consultarPorEmail($email) {
        $dao = new UsuarioDAO();
        $usuario = $dao->consultarPorEmail($email);
        

        if($usuario->getTipo() == 'D') {
            $doadorDao = new DoadorDAO();
            $doador = $doadorDao->consultarPorId($usuario->getId());

            if($doador) {
                return ['status' => 'success', 'response' => $doador];
            } else {
                return ['status' => "error", 'message' => 'Erro ao consultar usuário.'];
            }
        } else {
            $instituicaoDao = new InstituicaoDAO();
            $instituicao = $instituicaoDao->consultarPorId($usuario->getId());

            if($instituicao) {
                return ['status' => 'success', 'response' => $instituicao];
            } else {
                return ['status' => "error", 'message' => 'Erro ao consultar usuário.'];
            }
        }
    }
}
?>
