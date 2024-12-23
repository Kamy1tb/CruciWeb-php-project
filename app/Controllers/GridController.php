<?php
// Assurez-vous que Database.php est bien inclus
require_once __DIR__ . '/../Models/GridModel.php';

class GridController {
    private $gridModel;

    public function __construct() {
        $database = new Database();
        $this->gridModel = new GridModel($database);
    }

    public function index() {
        $grids = $this->gridModel->getAllGrids();
        require_once __DIR__ . '/../Views/games.php';
    }
   

}