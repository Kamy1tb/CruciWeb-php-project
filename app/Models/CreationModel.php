<?php
// Assurez-vous que Database.php est bien inclus
require_once $_SERVER['DOCUMENT_ROOT']. '/cruciweb/config/Database.php';

class CreationModel {
private $db;

public function __construct(Database $database) {
    // Initialisation de la connexion PDO
    $this->db = $database->getPDO();
}

public function createGrid($id_user, $difficulté, $nom, $description, $estimated_time, $width, $height, $case_noire, $clues,$solutions,$date) {
    // Insertion dans la base de données
    $stmt = $this->db->prepare("INSERT INTO grille (id_user, difficulté, nom, description, estimated_time, width, height, case_noire, clues, solutions, date) VALUES (:id_user, :difficulte, :nom, :description, :estimated_time, :width, :height, :case_noire, :clues, :solutions, :date)");
    $case_noire_json = json_encode($case_noire);
    $clues_json = json_encode($clues);
    $solutions_json = json_encode($solutions);
    $hashed_solutions = json_decode($solutions_json, true);
    foreach ($hashed_solutions as $key => $value) {
        $hashed_solutions[$key] = hash('sha256', $value);
    }
    $hashed_solutions = json_encode($hashed_solutions);

    $stmt->execute([
        ':id_user' => $id_user,
        ':difficulte' => $difficulté,
        ':nom' => $nom,
        ':description' => $description,
        ':estimated_time' => $estimated_time,
        ':width' => $width,
        ':height' => $height,
        ':case_noire' => $case_noire_json,
        ':clues' => $clues_json,
        ':solutions' => $hashed_solutions,
        ':date' => $date
    ]);
    

    return "Grille créée avec succès.";

}

}
?>