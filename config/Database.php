<?php
namespace App\Config;
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use PDO;
use PDOException;

// Charger le fichier .env
$dotenv = Dotenv::createImmutable(__DIR__ . '/../'); 
$dotenv->load();
class Database {
    private $host;
    private $dbname;
    private $user ;
    private $password ;
    private $user_admin ;
    private $password_admin ;
    private $pdo;

    public function __construct() {
        $this->host = $_ENV['DB_HOST'];
        $this->dbname = $_ENV['DB_NAME'];
        $this->user = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASSWORD'];
        $this->user_admin = $_ENV['DB_USER_ADMIN'];
        $this->password_admin = $_ENV['DB_PASSWORD_ADMIN'];
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

    private function connect_admin() {
        try {
            $this->pdo = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8",
                $this->user_admin,
                $this->password_admin
            );
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    // Retourne l'instance PDO
    public function getPDO() {
        $this->connect();
        return $this->pdo;
    }
    public function getPDO_admin() {
        $this->connect_admin();
        return $this->pdo;
    }
}
?>
