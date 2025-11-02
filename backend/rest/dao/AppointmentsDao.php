<?php
require_once 'BaseDao.php';

class AppointmentsDao extends BaseDao {
    public function __construct() {
        parent::__construct("appointments");
    }

    // Dohvati sve termine po klijentu
    public function getByClientId($client_id) {
        $stmt = $this->connection->prepare("SELECT * FROM appointments WHERE client_id = :client_id");
        $stmt->bindParam(':client_id', $client_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Dohvati sve termine po zaposleniku
    public function getByEmployeeId($employee_id) {
        $stmt = $this->connection->prepare("SELECT * FROM appointments WHERE employee_id = :employee_id");
        $stmt->bindParam(':employee_id', $employee_id);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Kreiraj novi termin
    public function createAppointment($client_id, $employee_id, $service_id, $admin_id, $appointment_date, $status) {
        $stmt = $this->connection->prepare(
            "INSERT INTO appointments (client_id, employee_id, service_id, admin_id, appointment_date, status) 
             VALUES (:client_id, :employee_id, :service_id, :admin_id, :appointment_date, :status)"
        );
        $stmt->bindParam(':client_id', $client_id);
        $stmt->bindParam(':employee_id', $employee_id);
        $stmt->bindParam(':service_id', $service_id);
        $stmt->bindParam(':admin_id', $admin_id);
        $stmt->bindParam(':appointment_date', $appointment_date);
        $stmt->bindParam(':status', $status);

        return $stmt->execute();
    }

    // Update termina
    public function updateAppointment($appointment_id, $client_id, $employee_id, $service_id, $admin_id, $appointment_date, $status) {
        $stmt = $this->connection->prepare(
            "UPDATE appointments 
             SET client_id = :client_id, employee_id = :employee_id, service_id = :service_id, 
                 admin_id = :admin_id, appointment_date = :appointment_date, status = :status 
             WHERE appointment_id = :appointment_id"
        );
        $stmt->bindParam(':client_id', $client_id);
        $stmt->bindParam(':employee_id', $employee_id);
        $stmt->bindParam(':service_id', $service_id);
        $stmt->bindParam(':admin_id', $admin_id);
        $stmt->bindParam(':appointment_date', $appointment_date);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':appointment_id', $appointment_id);

        return $stmt->execute();
    }

    // Delete termina
    public function deleteAppointment($appointment_id) {
        return $this->delete($appointment_id);
    }
}
?>
