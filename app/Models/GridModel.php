<?php
namespace App\Models;
// Assurez-vous que Database.php est bien inclus
use App\Config\Database;

class GridModel {
private $db;

public function __construct(Database $database) {
    // Initialisation de la connexion PDO
    $this->db = $database->getPDO();
}

public function getGridById($id_grille) {
    $stmt = $this->db->prepare("SELECT * FROM grille WHERE id_grille = :id_grille");
    $stmt->execute(['id_grille' => $id_grille]);
    $grid = $stmt->fetch(\PDO::FETCH_ASSOC);

    // Check if the grid was found
    if (!$grid) {
        // Return an error message or null if no grid was found
        return "grid not found";  // or you can return an error message like 'Grid not found'
    }

    return $grid;
}

public function getAllGrids() {
    $stmt = $this->db->query("SELECT id_grille, id_user, difficulté,nom,description,estimated_time,date FROM grille");
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

public function saveGrid($id_grille,$id_user,$solution) {
    $solution_json = json_encode($solution);
    try {
        // Vérifiez les valeurs avant l'exécution
        print_r($id_grille);  // Affichez la valeur de $id_grille
        print_r($id_user);    // Affichez la valeur de $id_user
        print_r($solution_json);  // Affichez la valeur de $solution_json
        
        // Préparez la requête SQL avec les paramètres liés
        $stmt = $this->db->prepare("
            INSERT INTO sauvegarde (id_grille, id_user, solution) 
            VALUES (:id_grille, :id_user, :solution_json) 
            ON DUPLICATE KEY UPDATE solution = :solution_json;
        ");
    
        // Exécution avec les valeurs liées
        $stmt->execute([
            ':id_grille' => $id_grille, 
            ':id_user' => $id_user, 
            ':solution_json' => $solution_json
        ]);
    
        echo "L'opération a réussi.";
    } catch (\PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
    
    return "Grille sauvegardée avec succès.";
}

public function getSavedGrids($username) {
    $sql = "SELECT g.id_grille,g.id_user,g.difficulté,g.nom,g.description,g.estimated_time,g.date,s.solution 
        FROM sauvegarde s 
        INNER JOIN grille g ON s.id_grille = g.id_grille 
        WHERE s.id_user = :username";
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['username' => $username]);
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

public function getSavedGridData($username, $gridId) {
    $sql = "SELECT g.*,s.solution 
        FROM sauvegarde s 
        INNER JOIN grille g ON s.id_grille = g.id_grille 
        WHERE s.id_user = :username AND s.id_grille = :gridId"; ;
    $stmt = $this->db->prepare($sql);
    $stmt->execute(['username' => $username, 
                            'gridId' => $gridId]);
    return $stmt->fetch(\PDO::FETCH_ASSOC);
}

public function getCreatedGrids($username) {
    $stmt = $this->db->prepare("SELECT * FROM grille WHERE id_user = :username");
    $stmt->execute(['username' => $username]);
    return $stmt->fetchAll(\PDO::FETCH_ASSOC);
}

}
?>
