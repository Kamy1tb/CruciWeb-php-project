<?php
// Autoloader pour charger les classes
spl_autoload_register(function ($class) {
    $path = 'app/';
    $extensions = ['Controllers', 'Models','Views'];

    // Essayer de charger depuis les deux dossiers (controllers et models)
    foreach ($extensions as $ext) {
        if (file_exists($path . $ext . '/' . $class . '.php')) {
            require_once $path . $ext . '/' . $class . '.php';
        }
    }
    // Charger Database.php
    if (file_exists('config/Database.php')) {
        require_once 'config/Database.php';
    }
});

require_once __DIR__ . '/vendor/autoload.php';
use App\Controllers\LandingController;
use App\Controllers\AdminController;
use App\Controllers\UserController;
use App\Controllers\GridController;
use App\Controllers\CreationController;

session_start();
$action = $_GET['action'] ?? '';

if (isset($_SESSION["username"]) && $_SESSION['username'] == 'admin_cruciweb') {
    switch ($action) {
        case '':
            $controller = new AdminController();
            $controller->index();
            break;
        case 'logout':
            $controller = new UserController();
            $controller->logout();
            $action = '';
            break;
        case 'delete_user':
            $controller = new AdminController();
            $controller->delete_user($_GET['username']);
            break;
    }

}
else{
switch ($action) {
    case 'login':
        $controller = new UserController();
            if (isset($_POST['username'])) {
        
            $controller->login();
            } else {
            $controller->afficher_login();
                 }       
                 break;
    case 'signup':
        $controller = new UserController();
        if (isset($_POST['username'])) {
            $controller->signUp();
        } else {
            $controller->afficher_signup();
        }
        break;

    case 'logout':
        $controller = new UserController();
        $controller->logout();
        $action = '';
        break;

    case 'grids':
        if (isset($_GET['gridId'])) {
            $controller = new GridController();
            $controller->show_grid();
        } else {
            $controller = new GridController();
            $controller->index();
        }
        break;

    case 'created':
        $controller = new GridController();
        $controller->show_created_grids();
        break;

    case 'saved':
        if (isset($_SESSION['username'])) {
        if (isset($_GET['gridId'])) {
            $controller = new GridController();
            $controller->show_saved_grid($_GET['gridId']);
        } else {
            $controller = new GridController();
            $controller->show_saved_grids();
        }
    } else {
        $controller = new UserController();
        $controller->afficher_login();
    }

        break;

    case 'create':
        if (isset($_SESSION['username'])) {

            if(isset($_POST['gridData'])) {
                // Décoder le JSON en tableau associatif
                
                $controller = new CreationController();
                $controller->create();
                break;
            } else {
                $controller = new CreationController();
                $controller->index();
                break;
            }

        } else {
            $controller = new UserController();
            $controller->afficher_login();
            break;
        }

    case '':
        $home = new LandingController();
        $home->index();
        break;


        default:
        require ($_SERVER['DOCUMENT_ROOT'].'/cruciweb/app/Views/404.php');
        break;
}

}



?>
