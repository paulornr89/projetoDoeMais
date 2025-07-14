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

    public function atualizar(Doador $doador) {
        $sql = "UPDATE doadores SET telefone = :telefone, cep = :cep, 
                    endereco = :endereco, cidade = :cidade, uf = :uf WHERE id_usuario = :id_usuario";
    
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':id_usuario' => $doador->getIdUsuario(),
            ':telefone' => $doador->getTelefone(),
            ':cep' => $doador->getCep(),
            ':endereco' => $doador->getEndereco(),
            ':cidade' => $doador->getCidade(),
            ':uf' => $doador->getUf()
        ]);
    }

    public function listarDoadores() {
        $sql = "SELECT doa.*, u.imagem FROM doadores doa inner join usuarios u on id = id_usuario ";
        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function consultarPorId($id) {
        $sql = "SELECT * FROM doadores WHERE id_usuario = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
