<?php
require_once 'BaseDao.php';

class AdminsDao extends BaseDao {
    public function __construct() {
        parent::__construct("admins");
    }

    // Dohvati admina po username-u (za login)
    public function getByUsername($username) {
        $stmt = $this->connection->prepare("SELECT * FROM admins WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Kreiraj novog admina
    public function createAdmin($username, $password, $full_name, $email) {
        // password hash
        $hashed = password_hash($password, PASSWORD_BCRYPT);

        $stmt = $this->connection->prepare(
            "INSERT INTO admins (username, password, full_name, email) 
             VALUES (:username, :password, :full_name, :email)"
        );
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed);
        $stmt->bindParam(':full_name', $full_name);
        $stmt->bindParam(':email', $email);

        return $stmt->execute();
    }

    // Update admin podataka
    public function updateAdmin($admin_id, $full_name, $email) {
        $stmt = $this->connection->prepare(
            "UPDATE admins SET full_name = :full_name, email = :email WHERE admin_id = :admin_id"
        );
        $stmt->bindParam(':full_name', $full_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':admin_id', $admin_id);
        return $stmt->execute();
    }

    // Delete admin
    public function deleteAdmin($admin_id) {
        return $this->delete($admin_id);
    }

    // Provjera login-a
    public function checkLogin($username, $password) {
        $admin = $this->getByUsername($username);
        if ($admin && password_verify($password, $admin['password'])) {
            return $admin;
        }
        return false;
    }
}
?>
