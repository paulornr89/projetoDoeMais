<?php
require_once __DIR__ . '/../../config/connectDB.php';

class DoadorDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    public function inserir(Doador $doador) {
        $sql = "INSERT INTO doadores (id_usuario, nome, cpf_cnpj, telefone, cep, endereco, cidade, uf, tipo) VALUES (:id_usuario, :nome, :cpf_cnpj, :telefone, :cep, :endereco, :cidade, :uf, :tipo)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id_usuario' => $doador->getIdUsuario(),
            ':nome' => $doador->getNome(),
            ':cpf_cnpj' => $doador->getCpf_cnpj(),
            ':telefone' => $doador->getTelefone(),
            ':cep' => $doador->getCep(),
            ':endereco' => $doador->getEndereco(),
            ':cidade' => $doador->getCidade(),
            ':uf' => $doador->getUf(),
            ':tipo' => $doador->getTipo()
        ]);
    }

    public function listarDoadores() {
        $sql = "SELECT * FROM doadores";
        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
