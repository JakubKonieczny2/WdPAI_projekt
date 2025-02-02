<?php
require_once 'Database.php';

class Appointment {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function bookAppointment($appointmentId, $patientId) {
        $stmt = $this->db->prepare("UPDATE appointments SET patient_id = ?, status = 'reserved' WHERE id = ?");
        $stmt->execute([$patientId, $appointmentId]);
    }

    public function cancelAppointment($appointmentId) {
        $stmt = $this->db->prepare("UPDATE appointments SET patient_id = NULL, status = 'available' WHERE id = ?");
        $stmt->execute([$appointmentId]);
    }

    public function addAppointment($doctorId, $date, $time) {
        $stmt = $this->db->prepare("INSERT INTO appointments (doctor_id, appointment_date, appointment_time, status) VALUES (?, ?, ?, 'available')");
        $stmt->execute([$doctorId, $date, $time]);
    }

    public function getAvailableAppointments() {
        $stmt = $this->db->query("SELECT a.id, u.first_name || ' ' || u.last_name AS doctor_name, d.specialization, a.appointment_date, a.appointment_time 
                                  FROM appointments a 
                                  JOIN users u ON a.doctor_id = u.id 
                                  JOIN doctors d ON u.id = d.user_id 
                                  WHERE a.status = 'available'");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getReservedAppointments($patientId) {
        $stmt = $this->db->prepare("SELECT a.id, u.first_name || ' ' || u.last_name AS doctor_name, d.specialization, a.appointment_date, a.appointment_time 
                                    FROM appointments a 
                                    JOIN users u ON a.doctor_id = u.id 
                                    JOIN doctors d ON u.id = d.user_id 
                                    WHERE a.patient_id = ?");
        $stmt->execute([$patientId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getDoctorAppointments($doctorId) {
        $stmt = $this->db->prepare("SELECT * FROM appointments WHERE doctor_id = ?");
        $stmt->execute([$doctorId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>