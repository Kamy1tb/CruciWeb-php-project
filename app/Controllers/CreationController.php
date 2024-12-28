<?php
// Assurez-vous que Database.php est bien inclus
require_once __DIR__ . '/../Models/CreationModel.php';

class CreationController {
    private $creationModel;

    public function __construct() {
        $database = new Database();
        $this->creationModel = new CreationModel($database);
    }

    public function index() {
        require_once __DIR__ . '/../Views/create.php';
    }
   
    

}