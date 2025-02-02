<?php
session_start();
require_once '../php/Appointment.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'doctor') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $doctorId = $_SESSION['user']['id'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    $appointment = new Appointment();
    $appointment->addAppointment($doctorId, $date, $time);

    header("Location: doctor.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dodaj termin</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Dodaj termin wizyty</h2>
        <form method="POST" action="add_appointment.php">
            <div class="form-group">
                <label for="date">Data:</label>
                <input type="date" id="date" name="date" required>
            </div>
            <div class="form-group">
                <label for="time">Godzina:</label>
                <input type="time" id="time" name="time" required>
            </div>
            <button type="submit" class="button">Dodaj termin</button>
        </form>
        <p><a href="doctor.php" class="button">Powrót</a></p>
    </div>
</body>
</html>