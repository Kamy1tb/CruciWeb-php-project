<?php
require_once $_SERVER['DOCUMENT_ROOT']. '/cruciweb/app/Models/GridModel.php';

class GridController {
    private $gridModel;

    public function __construct() {
        $database = new Database();
        $this->gridModel = new GridModel($database);
    }

    public function index() {
        $grids = $this->gridModel->getAllGrids();
        require_once $_SERVER['DOCUMENT_ROOT']. '/cruciweb/app/Views/games.php';
    }
    public function show_grid() {
        $gridId = $_GET['gridId'];
        $grid = $this->gridModel->getGridById($gridId);
        if ($grid === "grid not found") {
            require_once $_SERVER['DOCUMENT_ROOT']. '/cruciweb/app/Views/404.php';
            return;
        }
        require_once $_SERVER['DOCUMENT_ROOT']. '/cruciweb/app/Views/board.php';
    }
}