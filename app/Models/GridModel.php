<?php
// Assurez-vous que Database.php est bien inclus
require_once '../config/Database.php';

class GridModel {
private $db;

public function __construct(Database $database) {
    // Initialisation de la connexion PDO
    $this->db = $database->getPDO();
}


public function getGridById($id_grille) {
    $stmt = $this->db->prepare("SELECT * FROM grille WHERE id_grille = :id_grille");
    $stmt->execute(['id_grille' => $id_grille]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function getAllGrids() {
    $stmt = $this->db->query("SELECT id_grille, id_user, difficulté,nom,description,estimated_time,date FROM grille");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}

?>
