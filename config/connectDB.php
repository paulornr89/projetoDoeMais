<?php
class Database {
    private static $pdo;

    public static function getConnection() {
        if (!self::$pdo) {
            $servidor = "localhost";
            $porta = 5432;
            $dbname = "projetoDoar";
            $usuario = "postgres";
            $senha = "im0rtaltr32";

            try {
                self::$pdo = new PDO("pgsql:host=$servidor;port=$porta;dbname=$dbname", $usuario, $senha);
                self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // Opcional: remover a linha abaixo para não poluir com "Conexão bem-sucedida!"
                // echo "Conexão bem-sucedida!";
            } catch (PDOException $e) {
                die('Não foi possível conectar: ' . $e->getMessage());
            }
        }
        return self::$pdo;
    }
}
?>
