<?php
session_start();
require_once '../php/Appointment.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'doctor') {
    header("Location: login.php");
    exit();
}

$appointment = new Appointment();
$doctorAppointments = $appointment->getDoctorAppointments($_SESSION['user']['id']);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona lekarza</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Moje wizyty</h2>
        <div class="appointments-list">
            <table>
                <thead>
                    <tr>
                        <th>Data</th>
                        <th>Godzina</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($doctorAppointments as $appointment): ?>
                        <tr>
                            <td><?= $appointment['appointment_date'] ?></td>
                            <td><?= $appointment['appointment_time'] ?></td>
                            <td><?= $appointment['status'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <p><a href="add_appointment.php" class="button">Dodaj termin</a></p>
        <p><a href="logout.php" class="button">Wyloguj się</a></p>
    </div>
</body>
</html>