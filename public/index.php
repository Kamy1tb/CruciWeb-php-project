<?php
// Autoloader pour charger les classes
spl_autoload_register(function ($class) {
    $path = '../app/';
    $extensions = ['Controllers', 'Models','Views'];

    // Essayer de charger depuis les deux dossiers (controllers et models)
    foreach ($extensions as $ext) {
        if (file_exists($path . $ext . '/' . $class . '.php')) {
            require_once $path . $ext . '/' . $class . '.php';
        }
    }
    // Charger Database.php
    if (file_exists('../config/Database.php')) {
        require_once '../config/Database.php';
    }
});

$routes = [
    'login' => function () {
        $controller = new UserController();
        $controller->login();
    },
    'register' => function () {
        $controller = new AuthController($pdo);
        $controller->register();
    },
];

session_start();
$action = $_GET['action'] ?? '';

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

    case '':
        $home = new LandingController();
        $home->index();
        break;


        default:
        require '../app/Views/404.php';
        break;
}





?>
