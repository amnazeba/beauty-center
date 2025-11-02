<?php
require_once 'BaseDao.php';

class ServicesDao extends BaseDao {
    public function __construct() {
        parent::__construct("services");
    }

    // Dohvati servis po ID-u
    public function getById($service_id) {
        $stmt = $this->connection->prepare("SELECT * FROM services WHERE service_id = :service_id");
        $stmt->bindParam(':service_id', $service_id);
        $stmt->execute();
        return $stmt->fetch();
    }

    // Kreiraj novi servis
    public function createService($name, $description, $duration, $price) {
        $stmt = $this->connection->prepare(
            "INSERT INTO services (name, description, duration, price) 
             VALUES (:name, :description, :duration, :price)"
        );
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':duration', $duration);
        $stmt->bindParam(':price', $price);
        return $stmt->execute();
    }

    // Update servisa
    public function updateService($service_id, $name, $description, $duration, $price) {
        $stmt = $this->connection->prepare(
            "UPDATE services 
             SET name = :name, description = :description, duration = :duration, price = :price 
             WHERE service_id = :service_id"
        );
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':duration', $duration);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':service_id', $service_id);
        return $stmt->execute();
    }

    // Delete servisa
    public function deleteService($service_id) {
        return $this->delete($service_id);
    }
}
?>
