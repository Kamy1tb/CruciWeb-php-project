<?php
namespace App\Controllers;

use App\Config\Database;
use App\Models\CreationModel;

class CreationController {
    private $creationModel;

    public function __construct() {
        $database = new Database();
        $this->creationModel = new CreationModel($database);
    }

    public function index() {
        require_once __DIR__ . '/../Views/create.php';
    }

    public function create() {
        $id_user = $_SESSION['username'];
        $difficulté = $_POST['gridData']['difficulty'];
        $nom = $_POST['gridData']['gridName'];
        $description = $_POST['gridData']['description'];
        $estimated_time = $_POST['gridData']['estimatedTime'];
        $width = $_POST['gridData']['width'];
        $height = $_POST['gridData']['height'];
        $case_noire = $_POST['gridData']['blackSquares'];
        $clues = $_POST['clues'];
        $solution = $_POST['solutions'];
        $date = date('Y-m-d H:i:s');

        $message = $this->creationModel->createGrid($id_user, $difficulté, $nom, $description, $estimated_time, $width, $height, $case_noire, $clues, $solution, $date);
        echo json_encode(['message' => $message]);
    }
   
    

}