<?php
session_start();
require_once '../php/User.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['user_id'];
    $currentUserId = $_SESSION['user']['id'];

    if ($userId == $currentUserId) {
        $_SESSION['error'] = "Nie możesz usunąć samego siebie!";
        header("Location: admin.php");
        exit();
    }

    $user = new User();
    $user->deleteUser($userId);

    $_SESSION['success'] = "Użytkownik został pomyślnie usunięty.";
    header("Location: admin.php");
    exit();
}
?>
