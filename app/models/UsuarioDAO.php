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

        public function consultarPorEmail($email) {
            $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
            $stmt->execute([':email' => $email]);
            $dados = $stmt->fetch();

            if($dados) {
                return new Usuario($dados['email'], $dados['senha'], $dados['tipo']);
            }

            return null;
        }
    }
?>