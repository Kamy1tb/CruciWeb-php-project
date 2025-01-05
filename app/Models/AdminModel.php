<?php
namespace App\Models;
// Assurez-vous que Database.php est bien inclus
use App\Config\Database;
class AdminModel {
    private $db_admin;
    public function __construct(Database $database) {
        // Initialisation de la connexion PDO
        $this->db_admin = $database->getPDO_admin();
    }
    public function getAllUsers() {
        $stmt = $this->db_admin->query("SELECT * FROM user");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function getAllGrids(){
        $stmt = $this->db_admin->query("SELECT * FROM grille");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    public function deleteUser($username) {
        $stmt = $this->db_admin->prepare("DELETE FROM user WHERE username = :username");
        $stmt->execute(['username' => $username]);
        return "Utilisateur supprimé avec succès.";
    }
}

?>