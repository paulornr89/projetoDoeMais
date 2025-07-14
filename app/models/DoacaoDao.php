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
            $sql = "
                SELECT di.id_doacao, nome, status, TO_CHAR(doa.criado_em, 'DD/MM/YYYY') as dataRecebida, string_agg(concat(i.descricao,' - ',di.quantidade), ',') as itemQuantidade
                FROM doacoes doa 
                INNER JOIN doadores ON id_usuario = id_doador 
                INNER JOIN usuarios u ON id_instituicao = u.id 
                INNER JOIN doacoes_itens di ON doa.id = di.id_doacao 
                INNER JOIN itens i ON di.id_item = i.id
                WHERE u.email = :email 
                GROUP BY di.id_doacao, nome, status, TO_CHAR(doa.criado_em, 'DD/MM/YYYY') 
                ORDER BY dataRecebida DESC
            ";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([':email' => $email]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } 

    }
?>