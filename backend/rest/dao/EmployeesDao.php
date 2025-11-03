<?php
require_once 'BaseDao.php';

class EmployeesDao extends BaseDao {
    public function __construct() {
        parent::__construct("employees");
    }

    // Dohvati zaposlenika po email-u
    public function getByEmail($email) {
        $stmt = $this->connection->prepare("SELECT * FROM employees WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Dohvati zaposlenika po poziciji (opcionalno)
    public function getByPosition($position) {
        $stmt = $this->connection->prepare("SELECT * FROM employees WHERE position = :position");
        $stmt->bindParam(':position', $position);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    // Kreiraj novog zaposlenika
    public function createEmployee($first_name, $last_name, $position, $skills) {
        $stmt = $this->connection->prepare(
            "INSERT INTO employees (first_name, last_name, position, skills) 
             VALUES (:first_name, :last_name, :position, :skills)"
        );
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':position', $position);
        $stmt->bindParam(':skills', $skills);
        return $stmt->execute();
    }

    // Update zaposlenika
    public function updateEmployee($employee_id, $first_name, $last_name, $position, $skills) {
        $stmt = $this->connection->prepare(
            "UPDATE employees 
             SET first_name = :first_name, last_name = :last_name, position = :position, skills = :skills 
             WHERE employee_id = :employee_id"
        );
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':position', $position);
        $stmt->bindParam(':skills', $skills);
        $stmt->bindParam(':employee_id', $employee_id);
        return $stmt->execute();
    }

    // Delete zaposlenika
    public function deleteEmployee($employee_id) {
        return $this->delete($employee_id);
    }
}
?>
