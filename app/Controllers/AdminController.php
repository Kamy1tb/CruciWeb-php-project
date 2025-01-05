<?php
namespace App\Controllers;

use App\Models\AdminModel;
use App\Config\Database;

class AdminController 
{
   private $AdminModel;
    public function __construct() {
        $database = new Database();
        $this->AdminModel = new AdminModel($database);
    }
    public function index()
    {
        $users = $this->AdminModel->getAllUsers();
        $grids = $this->AdminModel->getAllGrids();
        require_once __DIR__ . '/../Views/admin/index.php';
    }

    public function delete_user($id_user){
        $this->AdminModel->deleteUser($id_user);
    }
    public function delete_grid($id_grid){
        $this->AdminModel->deleteGrid($id_grid);
    }
}