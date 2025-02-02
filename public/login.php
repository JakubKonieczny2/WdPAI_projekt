<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../php/Auth.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $auth = new Auth();
    $email = $_POST['email'];
    $password = $_POST['password'];

    echo "Email: $email<br>";
    echo "Hasło: $password<br>";

    $user = $auth->login($email, $password);

    if ($user) {
        echo "Zalogowany użytkownik:<br>";
        print_r($user);

        $_SESSION['user'] = $user;

        if ($user['role'] === 'patient') {
            header("Location: patient.php");
        } elseif ($user['role'] === 'doctor') {
            header("Location: doctor.php");
        } elseif ($user['role'] === 'admin') {
            header("Location: admin.php");
        }
        exit();
    } else {
        $error = "Nieprawidłowy email lub hasło!";
    }
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Logowanie</h2>
        <?php if (isset($error)): ?>
            <div class="error"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Hasło:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit" class="button">Zaloguj się</button>
        </form>
        <p>Nie masz konta? <a href="register.php">Zarejestruj się</a></p>
    </div>
</body>
</html>