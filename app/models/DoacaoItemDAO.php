<?php
    require_once __DIR__ . '/../../config/connectDB.php';

    class DoacaoItemDAO {
        private $pdo;

        public function __construct() {
            $this->pdo = Database::getConnection();
        }

        public function inserir(DoacaoItem $doacaoItem) {
            $sql = "INSERT INTO doacoes_itens (id_doacao, id_item, quantidade) VALUES (:id_item, :id_doacao, :quantidade)";
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute([
                ':id_item' => $doacaoItem->getIdItem(),
                ':id_doacao' => $doacaoItem->getIdDoacao(),
                ':quantidade' => $doacaoItem->getQuantidade()
            ]);
        }
    }
?>