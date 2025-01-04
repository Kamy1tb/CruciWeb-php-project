<?php
require __DIR__ . '/../vendor/autoload.php';
use Dotenv\Dotenv;

// Charger le fichier .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../'); // Chemin où se trouve le fichier .env
$dotenv->load();
class Database {
    private $host;
    private $dbname;
    private $user ;
    private $password ;
    private $pdo;

    public function __construct() {
        $this->host = $_ENV['DB_HOST'];
        $this->dbname = $_ENV['DB_NAME'];
        $this->user = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASSWORD'];
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
