<?php
require_once __DIR__ . '/../Models/UserModel.php';

class UserController {
    private $userModel;

    public function __construct() {
        $database = new Database();
        $this->userModel = new UserModel($database);
    }

    public function index() {
        $users = $this->userModel->getAllUsers();
        require_once __DIR__ . '/../Views/users.php';
    }

    public function afficher_login() {
        require_once __DIR__ . '/../Views/login.php';
    }

    public function afficher_signup() {
        require_once __DIR__ . '/../Views/signup.php';
    }

    public function login() {
        // Récupérer les données POST
        $username = $_POST['username'] ;
        $password = $_POST['password'] ;

        // Vérifier si l'utilisateur existe
        $user = $this->userModel->authenticate($username,$password);

        if ($user) {
            // Créer une session
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['mail'];

            // Répondre avec succès

            echo json_encode(['success' => true, 'message' => 'Connexion réussie.']);
        } else {
            // Répondre avec une erreur

            http_response_code(401); // Code HTTP 401 Unauthorized
            echo json_encode([
            'error' => true,
            'message' => 'Login ou mot de passe incorrect.'
            ]);
            exit; // Arrêter l'exécution
        }
    }

    public function logout() {
        session_unset();
        // Détruire la session
        session_destroy();
        $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, 
        $params["path"], $params["domain"], 
        $params["secure"], $params["httponly"]
    );
    header('Location: ../public/index.php'); 
        exit();
    }

    public function signUp() {
        // Récupérer les données POST
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];
        $fullname = $_POST['fullname'];

        // Créer un nouvel utilisateur
        $this->userModel->createUser($username,$fullname, $password, $email);

        // Répondre avec succès
        echo json_encode(['success' => true, 'message' => 'Compte créé avec succès.']);
    }


}
?>