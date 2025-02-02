<?php
require_once 'Database.php';

class Doctor {
    private $db;

    public function __construct() {
        $this->db = (new Database())->getConnection();
    }

    public function addDoctor($userId, $specialization) {
        $stmt = $this->db->prepare("INSERT INTO doctors (user_id, specialization) VALUES (?, ?)");
        $stmt->execute([$userId, $specialization]);
    }

    public function getAvailableAppointments() {
        $stmt = $this->db->query("SELECT * FROM available_appointments");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>