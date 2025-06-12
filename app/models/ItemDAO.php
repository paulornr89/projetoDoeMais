<?php
require_once __DIR__ . '/../../config/connectDB.php';

class ItemDAO {
    private $pdo;

    public function __construct() {
        $this->pdo = Database::getConnection();
    }

    public function inserir(Item $item) {
        $sql = "INSERT INTO itens (descricao, tipo, unidade) VALUES (:descricao, :tipo, :unidade)";
        $stmt = $this->pdo->prepare($sql);
        return $stmt->execute([
            ':descricao' => $item->getDescricao(),
            ':tipo' => $item->getTipo(),
            ':unidade' => $item->getUnidade()
        ]);
    }

    public function listar() {
        $sql = "SELECT * FROM itens";
        $stmt = $this->pdo->query($sql);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } 
}
?>
