<?php
require_once 'BaseService.php';
require_once __DIR__ . '/../dao/ServicesDao.php';

class ServicesService extends BaseService {
    public function __construct() {
        $this->dao = new ServicesDao();
    }

    public function createService($name, $description, $duration, $price) {
        if ($price <= 0) {
            throw new Exception("Price must be positive");
        }
        return $this->dao->createService($name, $description, $duration, $price);
    }
}
?>


