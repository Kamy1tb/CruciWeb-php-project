<?php
session_start();

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

// Initialisation de la base de données
$database = new Database();

// Création de l'objet UserModel
$userModel = new UserModel($database);

// Vérifier l'action et gérer les connexions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action']) && $_POST['action'] === 'login') {
        // Traitement de la connexion
        $username = $_POST['username'];
        $password = $_POST['password'];
        $user = $userModel->authenticate($username, $password);

        if ($user) {
            $_SESSION['user'] = $user['username'];
            header('Location: dashboard.php');
            exit();
        } else {
            echo "Nom d'utilisateur ou mot de passe incorrect.";
        }
    } elseif (isset($_POST['action']) && $_POST['action'] === 'register') {
        // Traitement de l'inscription
        $username = $_POST['username'];
        $password = $_POST['password'];
        $message = $userModel->createUser($username, $password);
        echo $message;
    }
}
?>
