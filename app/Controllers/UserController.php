<?php
namespace App\Controllers;

use App\Config\Database;
use App\Models\UserModel;

class UserController {
    private $userModel;

    public function __construct() {
        $database = new Database();
        $this->userModel = new UserModel($database);
    }

    public function index() {
        $users = $this->userModel->getAllUsers();
        require_once $_SERVER['DOCUMENT_ROOT']. '/app/Views/users.php';
    }

    public function afficher_login() {
        require_once $_SERVER['DOCUMENT_ROOT']. '/app/Views/login.php';
    }

    public function afficher_signup() {
        require_once $_SERVER['DOCUMENT_ROOT']. '/app/Views/signup.php';
    }

    public function login() {
        $username = $_POST['username'] ;
        $password = $_POST['password'] ;

        $user = $this->userModel->authenticate($username,$password);

        if ($user) {
            $_SESSION['full_name'] = $user['full_name'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['email'] = $user['mail'];


            echo json_encode(['success' => true, 'message' => 'Connexion réussie.']);
        } else {

            http_response_code(401); 
            echo json_encode([
            'error' => true,
            'message' => 'Login ou mot de passe incorrect.'
            ]);
            exit; 
        }
    }

    public function logout() {
        session_unset();
        session_destroy();
        $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, 
        $params["path"], $params["domain"], 
        $params["secure"], $params["httponly"]
    );
    header('Location: /../index.php'); 
        exit();
    }

    public function signUp() {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        
        $this->userModel->createUser($username,$fullname, $password, $email);

        echo json_encode(['success' => true, 'message' => 'Compte créé avec succès.']);
    }


}
?>