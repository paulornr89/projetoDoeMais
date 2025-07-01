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

    public function listar() {
        $dao = new DoadorDAO();
        $doadores = $dao->listarDoadores();

        foreach ($doadores as &$doador) {
            $doador['cpf_cnpj'] = $this->mascararCpf($doador['cpf_cnpj']);
            $doador['telefone'] = $this->mascararTelefone($doador['telefone']);
            $doador['nome'] = $this->nomeParcial($doador['nome']);
            $doador['endereco'] = $this->enderecoParcial($doador['endereco']);
            $doador['cep'] = $this->mascararCep($doador['cep']);
        }

        return ['status' => 'success', 'data' => $doadores];
    }

    public function atualizar($dados) {
        $usuarioDao = new UsuarioDAO();
        $usuarioAtualizado = $usuarioDao->atualizar($dados['id_usuario'], $dados['email'], $dados['senha'], 'D');
    
        $doador = new Doador($dados['id_usuario'], $dados['nome'], $dados['cpf_cnpj'], $dados['telefone'],
            $dados['cep'], $dados['endereco'], $dados['cidade'], $dados['uf'], $dados['tipo']);    
        $doadorDao = new DoadorDAO();
        $doadorAtualizado = $doadorDao->atualizar($doador);
    
        if ($usuarioAtualizado && $doadorAtualizado) {
            return ['status' => 'success', 'message' => 'Doador e usuário atualizados com sucesso!'];
        } else {
            return ['status' => 'error', 'message' => 'Erro ao atualizar dados.'];
        }
    }

    // private function mascararEmail($email) {
    //     $parte = explode("@", $email);
    //     $prefixo = substr($parte[0], 0, 3) . '***';
    //     return $prefixo . '@' . $parte[1];
    // }
    
    private function mascararTelefone($telefone) {
        return '(**) *****-' . substr(preg_replace('/[^0-9]/', '', $telefone), -4);
    }
    
    private function nomeParcial($nomeCompleto) {
        $partes = explode(" ", $nomeCompleto);
        return $partes[0] . (isset($partes[1]) ? ' ' . substr($partes[1], 0, 1) . '.' : '');
    }
    
    private function enderecoParcial($endereco) {
        $partes = explode(" ", $endereco);
        return $partes[0] . (isset($partes[1]) ? ' ' . substr($partes[1], 0, 1) . '.' : '');
    }

    private function mascararCep($cep) {
        return substr($cep, 0, 3) . '**-***';
    }

    private function mascararCpf($cpf) {
        return '***.' . substr($cpf, 3, 3) . '.***-**';
    }
}
?>
