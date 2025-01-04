<?php
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
    public function show_grid() {
        $gridId = $_GET['gridId'];
        $grid = $this->gridModel->getGridById($gridId);
        if ($grid === "grid not found") {
            require_once __DIR__ . '/../Views/404.php';
            return;
        }
        print_r($grid);
    }
}