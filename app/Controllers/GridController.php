<?php
namespace App\Controllers;

use App\Config\Database;
use App\Models\GridModel;

class GridController {
    private $gridModel;

    public function __construct() {
        $database = new Database();
        $this->gridModel = new GridModel($database);
    }

    public function index() {
        $grids = $this->gridModel->getAllGrids();
        require_once $_SERVER['DOCUMENT_ROOT']. '/app/Views/games.php';
    }
    public function show_grid() {
        $gridId = $_GET['gridId'];
        $grid = $this->gridModel->getGridById($gridId);
        if ($grid === "grid not found") {
            require_once $_SERVER['DOCUMENT_ROOT']. '/app/Views/404.php';
            return;
        }
        require_once $_SERVER['DOCUMENT_ROOT']. '/app/Views/board.php';
    }
    public function show_saved_grids() {
        $username = $_SESSION['username'];
        $grids = $this->gridModel->getSavedGrids($username);
        print_r($grids);
    }

    public function show_saved_grid($gridId) {
        $username = $_SESSION['username'];
        $grid = $this->gridModel->getSavedGridData($username, $gridId);
        print_r($grid);
    }

    public function show_created_grids() { 
        $username = $_SESSION['username'];
        $grids = $this->gridModel->getCreatedGrids($username);
        print_r($grids);
      }
    
    public function saveGrid($gridId,$gridData) {
        $username = $_SESSION['username'];
        $gridId = $this->gridModel->saveGrid($gridId, $username,$gridData);
        print_r("Grid saved with id: ".$gridId);
    }
}