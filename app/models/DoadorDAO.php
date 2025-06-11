<?php
require_once __DIR__ . '/../../config/connectDB.php';

class DoadorDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    public function inserir(Doador $user) {
        $sql = "INSERT INTO doadores (nome, email, cpf_cnpj, telefone, cep, endereco, cidade, uf, tipo, senha) VALUES (:nome, :email, :cpf_cnpj, :telefone, :cep, :endereco, :cidade, :uf, :tipo, :senha)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':nome' => $user->getNome(),
            ':email' => $user->getEmail(),
            ':cpf_cnpj' => $user->getCpf_cnpj(),
            ':telefone' => $user->getTelefone(),
            ':cep' => $user->getCep(),
            ':endereco' => $user->getEndereco(),
            ':cidade' => $user->getCidade(),
            ':uf' => $user->getUf(),
            ':tipo' => $user->getTipo(),
            ':senha' => $user->getSenha()
        ]);
    }
}
?>
