<?php
require_once 'BaseService.php';
require_once __DIR__ . '/../dao/AppointmentsDao.php';

class AppointmentsService extends BaseService {
    public function __construct() {
        $this->dao = new AppointmentsDao();
    }

    public function getByClientId($client_id) {
        return $this->dao->getByClientId($client_id);
    }

    public function getByEmployeeId($employee_id) {
        return $this->dao->getByEmployeeId($employee_id);
    }

    public function createAppointment($client_id, $employee_id, $service_id, $admin_id, $appointment_date, $status) {
        if (empty($appointment_date)) {
            throw new Exception("Appointment date required");
        }
        return $this->dao->createAppointment($client_id, $employee_id, $service_id, $admin_id, $appointment_date, $status);
    }

    public function updateAppointment($appointment_id, $client_id, $employee_id, $service_id, $admin_id, $appointment_date, $status) {
        return $this->dao->updateAppointment($appointment_id, $client_id, $employee_id, $service_id, $admin_id, $appointment_date, $status);
    }

    public function deleteAppointment($appointment_id) {
        return $this->dao->deleteAppointment($appointment_id);
    }
}
?>
