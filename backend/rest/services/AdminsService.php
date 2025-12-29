<?php
require_once __DIR__ . '/../dao/AdminsDao.php';
require_once 'BaseService.php';

class AdminsService extends BaseService {
    public function __construct() {
        $this->dao = new AdminsDao();
    }

    public function login($username, $password) {
        $admin = $this->dao->checkLogin($username, $password);
        if (!$admin) {
            throw new Exception("Invalid username or password");
        }
        return $admin;
    }

    public function register($username, $password, $full_name, $email) {
        if (empty($username) || empty($password) || empty($email) || empty($full_name)) {
            throw new Exception("All fields are required");
        }
        return $this->dao->createAdmin($username, $password, $full_name, $email);
    }

    public function updateAdmin($admin_id, $full_name, $email) {
        if (empty($full_name) || empty($email)) {
            throw new Exception("Full name and email required");
        }
        return $this->dao->updateAdmin($admin_id, $full_name, $email);
    }
}
?>
