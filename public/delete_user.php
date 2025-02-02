<?php
session_start();
require_once '../php/User.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'];

    $user = new User();
    $user->deleteUser($userId);

    header("Location: admin.php");
    exit();
}
?>