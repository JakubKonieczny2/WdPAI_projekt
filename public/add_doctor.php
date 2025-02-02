<?php
session_start();
require_once '../php/User.php';
require_once '../php/Doctor.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $specialization = $_POST['specialization'];

    $user = new User();
    $userId = $user->register($firstName, $lastName, $email, $password, 'doctor');

    $doctor = new Doctor();
    $doctor->addDoctor($userId, $specialization);

    header("Location: admin.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj lekarza</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Dodaj lekarza</h2>
        <form method="POST" action="add_doctor.php">
            <div class="form-group">
                <label for="first_name">Imię:</label>
                <input type="text" id="first_name" name="first_name" required>
            </div>
            <div class="form-group">
                <label for="last_name">Nazwisko:</label>
                <input type="text" id="last_name" name="last_name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Hasło:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="specialization">Specjalizacja:</label>
                <input type="text" id="specialization" name="specialization" required>
            </div>
            <button type="submit" class="button">Dodaj lekarza</button>
        </form>
        <p><a href="admin.php" class="button">Powrót</a></p>
    </div>
</body>
</html>