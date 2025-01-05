<?php
// Assurez-vous que Database.php est bien inclus
require_once $_SERVER['DOCUMENT_ROOT'].'/cruciweb/config/Database.php';

class UserModel {
    private $db;
    private $db_admin;
    public function __construct(Database $database) {
        // Initialisation de la connexion PDO
        $this->db = $database->getPDO();
        $this->db_admin = $database->getPDO_admin();
    }

    // Authentifier l'utilisateur
    public function authenticate($username, $password) {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifier le mot de passe avec password_verify pour une sécurité accrue
        if ($user && password_verify($password, $user['password'])) {
            return $user; // Connexion réussie
        }
        return false; // Identifiants incorrects
    }

    public function authenticate_admin($username, $password) {
        $stmt = $this->db_admin->prepare("SELECT * FROM admin WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifier le mot de passe avec password_verify pour une sécurité accrue
        if ($user && password_verify($password, $user['password'])) {
            return $user; // Connexion réussie
        }
        return false; // Identifiants incorrects
    }

    // Créer un nouvel utilisateur
    public function createUser($username,$fullname, $password, $email) {
        // Vérification si l'utilisateur existe déjà
        $stmt = $this->db->prepare("SELECT * FROM user WHERE username = :username");
        $stmt->execute(['username' => $username]);

        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            http_response_code(400); // Bad Request
            echo json_encode(['error' => 'Cet utilisateur existe déjà.']);
            exit; 
        }
        else {
            // Hachage du mot de passe avant de l'enregistrer
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insertion dans la base de données
        $stmt = $this->db->prepare("INSERT INTO user (username,full_name,mail, password) VALUES (:username,:full_name,:mail,:password)");
        $stmt->execute(['username' => $username,'full_name'=> $fullname,'mail'=> $email, 'password' => $hashedPassword]);

        return "Utilisateur créé avec succès.";
        }

        
    }

    public function deleteUser($username) {
        $stmt = $this->db_admin->prepare("DELETE FROM user WHERE username = :username");
        $stmt->execute(['username' => $username]);
        return "Utilisateur supprimé avec succès.";
    }



    public function getAllUsers() {
        $stmt = $this->db->query("SELECT * FROM user");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    }
?>
