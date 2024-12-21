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


/*if(isset($_POST['logout'])){
    session_destroy(); 
    $home = new UserController();
    $home->index();
}*/



if($action == 'login'){
    $controller = new UserController();
    if (isset($_POST['username'])) {
        
        $controller->login();
    } else {
        $controller->afficher_login();
    }
}
elseif($action == 'signup'){
    $controller = new UserController();
    if (isset($_POST['username'])) {
        $controller->signUp();
    } else {
        $controller->afficher_signup();
    }
}


else{
    session_destroy();
    $home = new LandingController();
    $home->index();
     
}

?>
