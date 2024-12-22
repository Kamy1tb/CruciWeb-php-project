<?php
// Assurez-vous que Database.php est bien inclus
require_once __DIR__ . '/../Models/GridModel.php';

class GridController {
    private $gridModel;

    public function __construct() {
        $database = new Database();
        $this->gridModel = new UserModel($database);
    }

    public function index() {
        $users = $this->gridModel->getAllUsers();
        require_once __DIR__ . '/../Views/users.php';
    }
   

}