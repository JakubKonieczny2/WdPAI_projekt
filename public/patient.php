<?php
session_start();
require_once '../php/Appointment.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'patient') {
    header("Location: login.php");
    exit();
}

$appointment = new Appointment();
$availableAppointments = $appointment->getAvailableAppointments();
$reservedAppointments = $appointment->getReservedAppointments($_SESSION['user']['id']);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Strona pacjenta</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <h2>Dostępne wizyty</h2>
        <div class="appointments-list">
            <table>
                <thead>
                    <tr>
                        <th>Lekarz</th>
                        <th>Specjalizacja</th>
                        <th>Data</th>
                        <th>Godzina</th>
                        <th>Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($availableAppointments as $appointment): ?>
                        <tr>
                            <td><?= $appointment['doctor_name'] ?></td>
                            <td><?= $appointment['specialization'] ?></td>
                            <td><?= $appointment['appointment_date'] ?></td>
                            <td><?= $appointment['appointment_time'] ?></td>
                            <td>
                                <form action="book_appointment.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="appointment_id" value="<?= $appointment['id'] ?>">
                                    <button type="submit" class="button book">Umów się</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <h2>Moje zarezerwowane wizyty</h2>
        <div class="appointments-list">
            <table>
                <thead>
                    <tr>
                        <th>Lekarz</th>
                        <th>Specjalizacja</th>
                        <th>Data</th>
                        <th>Godzina</th>
                        <th>Akcje</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($reservedAppointments as $appointment): ?>
                        <tr>
                            <td><?= $appointment['doctor_name'] ?></td>
                            <td><?= $appointment['specialization'] ?></td>
                            <td><?= $appointment['appointment_date'] ?></td>
                            <td><?= $appointment['appointment_time'] ?></td>
                            <td>
                                <form action="cancel_appointment.php" method="POST" style="display:inline;">
                                    <input type="hidden" name="appointment_id" value="<?= $appointment['id'] ?>">
                                    <button type="submit" class="button cancel">Anuluj</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <p><a href="logout.php" class="button">Wyloguj się</a></p>
    </div>
</body>
</html>