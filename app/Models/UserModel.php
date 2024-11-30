<?php
// Assurez-vous que Database.php est bien inclus
require_once '../config/Database.php';

class UserModel {
    private $db;

    public function __construct(Database $database) {
        // Initialisation de la connexion PDO
        $this->db = $database->getPDO();
    }

    // Authentifier l'utilisateur
    public function authenticate($username, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifier le mot de passe avec password_verify pour une sécurité accrue
        if ($user && password_verify($password, $user['password'])) {
            return $user; // Connexion réussie
        }
        return false; // Identifiants incorrects
    }

    // Créer un nouvel utilisateur
    public function createUser($username, $password) {
        // Vérification si l'utilisateur existe déjà
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        if ($stmt->fetch(PDO::FETCH_ASSOC)) {
            return "L'utilisateur existe déjà.";
        }

        // Hachage du mot de passe avant de l'enregistrer
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Insertion dans la base de données
        $stmt = $this->db->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->execute(['username' => $username, 'password' => $hashedPassword]);

        return "Utilisateur créé avec succès.";
    }
}
?>
