<?php
namespace App\Models;
use App\Config\Database;



class UserModel {
    private $db;
    public function __construct(Database $database) {
        $this->db = $database->getPDO();
    }

    public function authenticate($username, $password) {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(\PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false; 
    }


    public function createUser($username,$fullname, $password, $email) {
        $stmt = $this->db->prepare("SELECT * FROM user WHERE username = :username");
        $stmt->execute(['username' => $username]);

        if ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
            http_response_code(400); 
            echo json_encode(['error' => 'Cet utilisateur existe déjà.']);
            exit; 
        }
        else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $this->db->prepare("INSERT INTO user (username,full_name,mail, password) VALUES (:username,:full_name,:mail,:password)");
        $stmt->execute(['username' => $username,'full_name'=> $fullname,'mail'=> $email, 'password' => $hashedPassword]);

        return "Utilisateur créé avec succès.";
        }        
    }

    public function getAllUsers() {
        $stmt = $this->db->query("SELECT * FROM user");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }
    }
?>
