<?php
require_once 'Database.php';

class User {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function login($email, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function register($firstName, $lastName, $email, $password, $role = 'patient') {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("INSERT INTO users (first_name, last_name, email, password, role) VALUES (?, ?, ?, ?, ?) RETURNING id");
        $stmt->execute([$firstName, $lastName, $email, $hashedPassword, $role]);
        return $stmt->fetchColumn();
    }

    public function getAllUsers() {
        $stmt = $this->db->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function deleteUser($userId) {
    $stmt = $this->db->prepare("DELETE FROM doctors WHERE user_id = ?");
    $stmt->execute([$userId]);
    $stmt = $this->db->prepare("DELETE FROM users WHERE id = ?");
    $stmt->execute([$userId]);
}
}
?>
