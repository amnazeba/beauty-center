<?php
require_once __DIR__ . '/../dao/AdminsDao.php';
require_once __DIR__ . '/BaseService.php';

class AdminsService extends BaseService {
    public function __construct() {
        $this->dao = new AdminsDao(); 
    }



    // Login logika
    public function login($username, $password) {
        $admin = $this->dao->checkLogin($username, $password);
        if (!$admin) {
            throw new Exception("Invalid username or password");
        }
        return $admin;
    }

    // Kreiranje admina s dodatnim provjerama
    public function register($username, $password, $full_name, $email) {
        if (empty($username) || empty($password) || empty($email)) {
            throw new Exception("All fields are required");
        }
        return $this->dao->createAdmin($username, $password, $full_name, $email);
    }

    public function updateAdmin($admin_id, $full_name, $email) {
        return $this->dao->updateAdmin($admin_id, $full_name, $email);
    }
}
?>
