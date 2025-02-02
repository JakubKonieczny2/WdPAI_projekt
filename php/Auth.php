<?php
require_once 'Database.php';
require_once 'User.php';

class Auth {
    private $user;

    public function __construct() {
        $this->user = new User();
    }

    public function login($email, $password) {
        $user = $this->user->login($email, $password);

        if ($user) {
            return $user;
        }
        return false;
    }

    public function register($firstName, $lastName, $email, $password, $role = 'patient') {
        $this->user->register($firstName, $lastName, $email, $password, $role);
    }

    public function logout() {
        session_start();
        session_destroy();
    }
}
?>