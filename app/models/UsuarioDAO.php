<?php
    require_once __DIR__ . '/../../config/connectDB.php';

    class UsuarioDAO {
        private $pdo;
    
        public function __construct() {
            $this->pdo = Database::getConnection();
        }
    
        public function inserir(Usuario $user) {
            $sql = "INSERT INTO usuarios (email, senha, tipo) VALUES (:email, :senha, :tipo)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':email' => $user->getEmail(),
                ':senha' => $user->getSenha(),
                ':tipo' => $user->getTipo()
            ]);

            return $this->pdo->lastInsertId();
        }

        public function atualizar($id, $novoEmail, $novaSenha, $tipo, $imagem) {
            $usuarioAtual = $this->consultarPorId($id);
        
            // Se senha nova for diferente da antiga (comparando com hash), atualiza com novo hash
            if ((!password_verify($novaSenha, $usuarioAtual->getSenha()) && ($novaSenha != ""))) {
                $novaSenha = password_hash($novaSenha, PASSWORD_DEFAULT);
            } else {
                $novaSenha = $usuarioAtual->getSenha(); // mantém a hash antiga
            }
        
            $sql = "UPDATE usuarios SET email = :email, senha = :senha, imagem = :imagem WHERE id = :id";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                ':email' => $novoEmail,
                ':senha' => $novaSenha,
                ':imagem' => $imagem,
                ':id'    => $id
            ]);
        }
        
        public function consultarPorId($id) {
            $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
            $stmt->execute([':id' => $id]);
            $dados = $stmt->fetch();
        
            if ($dados) {
                $usuario = new Usuario($dados['email'], '', $dados['tipo'], $dados['id'], $dados['imagem']);
                $usuario->setSenhaHash($dados['senha']);
                return $usuario;
            }
        
            return null;
        }

        public function deletar($id) {
            $stmt = $this->pdo->prepare("DELETE FROM usuarios WHERE id = :id");
            return $stmt->execute([':id' => $id]);
        }

        public function consultarPorEmail($email) {
            $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
            $stmt->execute([':email' => $email]);
            $dados = $stmt->fetch();

            if($dados) {
                $usuario = new Usuario($dados['email'], '', $dados['tipo'], $dados['id'], $dados['imagem']);
                $usuario->setSenhaHash($dados['senha']);
                return $usuario;
            }

            return null;
        }
    }
?>