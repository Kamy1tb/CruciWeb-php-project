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
        if (isset($_SESSION['username'])) {
        $grids_saved = $this->gridModel->getSavedGridsId($_SESSION['username']);
        require_once $_SERVER['DOCUMENT_ROOT']. '/app/Views/games.php';
        } else {
            require_once $_SERVER['DOCUMENT_ROOT']. '/app/Views/games.php';
        }
        
    }
    public function show_grid() {
        $gridId = $_GET['gridId'];
        $grid = $this->gridModel->getGridById($gridId);
    
        // Check if the grid exists
        if ($grid === "grid not found") {
            require_once $_SERVER['DOCUMENT_ROOT'] . '/app/Views/404.php';
            return;
        }
    
        // Check if the user is logged in and retrieve progress if available
        $progress = null; // Default value if no progress exists
        if (isset($_SESSION['username'])) {
            $username = $_SESSION['username'];
            $progress = $this->gridModel->getUserGridProgress($username, $gridId); // Method to fetch progress
        }
    
        // Pass both the grid and progress to the view
        require_once $_SERVER['DOCUMENT_ROOT'] . '/app/Views/board.php';
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