<?php
require_once 'BaseDao.php';

class ClientsDao extends BaseDao {
    public function __construct() {
        parent::__construct("admins");
    }

    // public function getByUsername($username) {
    //     $stmt = $this->connection->prepare("SELECT * FROM admins WHERE username = :username");
    //     $stmt->bindParam(':username', $username);
    //     $stmt->execute();
    //     return $stmt->fetch();
    // }

    public function createAdmin($username, $password, $full_name, $email) {
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

    // public function updateAdmin($admin_id, $full_name, $email) {
    //     $stmt = $this->connection->prepare(
    //         "UPDATE admins SET full_name = :full_name, email = :email WHERE admin_id = :admin_id"
    //     );
    //     $stmt->bindParam(':full_name', $full_name);
    //     $stmt->bindParam(':email', $email);
    //     $stmt->bindParam(':admin_id', $admin_id);
    //     return $stmt->execute();
    // }

    // public function deleteAdmin($admin_id) {
    //     return $this->delete($admin_id);
    // }

    public function createClient($first_name, $last_name, $email, $phone) {
        $stmt = $this->connection->prepare(
            "INSERT INTO clients (first_name, last_name, email, phone) 
             VALUES (:first_name, :last_name, :email, :phone)"
        );
        $stmt->bindParam(':first_name', $first_name);
        $stmt->bindParam(':last_name', $last_name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        return $stmt->execute();
    }


    

    public function checkLogin($username, $password) {
        $admin = $this->getByUsername($username);
        if ($admin && password_verify($password, $admin['password'])) {
            return $admin;
        }
        return false;
    }
}
?>
