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
    $grid = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the grid was found
    if (!$grid) {
        // Return an error message or null if no grid was found
        return "grid not found";  // or you can return an error message like 'Grid not found'
    }

    return $grid;
}

public function getAllGrids() {
    $stmt = $this->db->query("SELECT id_grille, id_user, difficulté,nom,description,estimated_time,date FROM grille");
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
}

?>
