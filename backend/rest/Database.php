<?php
require_once __DIR__ . '/config.php';

class Database {
    private $conn;

    public function getConnection() {
        if ($this->conn == null) {
            try {
                $this->conn = new PDO(
                    "mysql:host=" . Config::DB_HOST() . ";dbname=" . Config::DB_NAME() . ";port=" . Config::DB_PORT(),
                    Config::DB_USER(),
                    Config::DB_PASSWORD()
                );
                $this->conn->exec("set names utf8");
            } catch (PDOException $e) {
                echo "Connection error: " . $e->getMessage();
                exit;
            }
        }
        return $this->conn;
    }

    // Staticka metoda za kompatibilnost sa BaseDao
    public static function connect() {
        $db = new Database();
        return $db->getConnection();
    }
}
