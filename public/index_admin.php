<?php
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

$controller = new UserController();
$controller->afficher_login();



?>