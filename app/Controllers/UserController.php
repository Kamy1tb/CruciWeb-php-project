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
            $_SESSION['user_id'] = $user['id_user'];
            $_SESSION['username'] = $user['username'];

            // Répondre avec succès

            echo json_encode(['success' => true, 'message' => 'Connexion réussie.']);
        } else {
            // Répondre avec une erreur

            echo json_encode(['success' => false, 'message' => 'Identifiants incorrects.']);
        }
    }

    public function logout() {
        // Détruire la session
        session_destroy();

        // Rediriger vers la page d'accueil
        header('Location: index.php');
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