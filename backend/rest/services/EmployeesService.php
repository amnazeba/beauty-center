<?php
require_once 'BaseService.php';
require_once __DIR__ . '/../dao/EmployeesDao.php';

class EmployeesService extends BaseService {
    public function __construct() {
        $this->dao = new EmployeesDao();
    }

    public function getByEmail($email) {
        return $this->dao->getByEmail($email);
    }

    public function getByPosition($position) {
        return $this->dao->getByPosition($position);
    }
}
?>
