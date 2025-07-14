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

        public function listar($email) {
            $sql = "SELECT nome, status, TO_CHAR(doa.criado_em, 'DD/MM/YYYY') as dataRecebida FROM doacoes doa INNER JOIN doadores ON id_usuario = id_doador inner join usuarios u on id_instituicao = u.id where u.email = :email ORDER BY doa.criado_em DESC";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':email' => $email]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } 

    }
?>