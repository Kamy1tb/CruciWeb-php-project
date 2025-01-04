<?php
class Database {
    private $host = 'localhost';
    private $dbname = 'cruciweb';
    private $user = 'user';
    private $password = '0000';
    private $pdo;

    public function __construct() {
        $this->connect();
    }

    // Connexion à la base de données
    private function connect() {
        try {
            $this->pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8",
                $this->user,
                $this->password
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    // Retourne l'instance PDO
    public function getPDO() {
        return $this->pdo;
    }
}
?>
