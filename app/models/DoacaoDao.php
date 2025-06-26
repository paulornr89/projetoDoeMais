<?php
    require_once __DIR__ . '/../../config/connectDB.php';

    class DoacaoDao  {
        private $pdo;

        public function __construct() {
            $this->pdo = Database::getConnection();
        }

        public function inserir(Doacao $doacao) {
            $sql = "INSERT INTO doacoes (id_doador, id_instituicao, status) VALUES (:id_doador, :id_instituicao, :status)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':id_doador' => $doacao->getIdDoador(),
                ':id_instituicao' => $doacao->getIdInstituicao(),
                ':status' => $doacao->getStatus()
             ]);
             
             return $this->pdo->lastInsertId();
        }
    }
?>