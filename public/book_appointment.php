<?php
session_start();
require_once '../php/Appointment.php';

if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'patient') {
    header("Location: login.php");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $appointmentId = $_POST['appointment_id'];
    $patientId = $_SESSION['user']['id'];

    $appointment = new Appointment();
    $appointment->bookAppointment($appointmentId, $patientId);

    header("Location: patient.php");
    exit();
}
?>