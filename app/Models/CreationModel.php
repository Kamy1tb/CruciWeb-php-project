<?php
// Assurez-vous que Database.php est bien inclus
require_once '../config/Database.php';

class CreationModel {
private $db;

public function __construct(Database $database) {
    // Initialisation de la connexion PDO
    $this->db = $database->getPDO();
}

}

?>