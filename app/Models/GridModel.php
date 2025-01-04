<?php
// Assurez-vous que Database.php est bien inclus
require_once '../config/Database.php';

class GridModel {
private $db;

public function __construct(Database $database) {
    // Initialisation de la connexion PDO
    $this->db = $database->getPDO();
}


public function getGridById($id) {
    $stmt = $this->db->prepare("SELECT *FROM grid WHERE id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

public function getAllGrids() {
    $stmt = $this->db->query("SELECT id_grille, id_user, difficulté,nom,description,estimated_time,date FROM grille");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}

?>
