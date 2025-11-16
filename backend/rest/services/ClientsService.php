<?php
require_once 'BaseService.php';
require_once __DIR__ . '/../dao/ClientsDao.php';

class ClientsService extends BaseService {
    protected $dao;
    public function __construct() {
        $this->dao = new ClientsDao();
    }

    // Get all clients
    public function getAllClients() {
        return $this->dao->getAll();
    }

    // Get client by ID
    public function getClientById($client_id) {
        return $this->dao->getById($client_id);
    }

    // Create a new client (with basic validation)
    public function createClient($newClient) {
        if (empty($newClient["first_name"]) || empty($newClient["last_name"])) {
            throw new Exception("First name and last name are required.");
        }

        if (!filter_var($newClient["email"], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Invalid email format.");
        }

        return $this->dao->createClient($newClient["first_name"], $newClient["last_name"], $newClient["email"], $newClient["phone"]);
    }

    // Update client information
    public function updateClient($client_id, $first_name, $last_name, $email, $phone) {
        return $this->dao->updateClient($client_id, $first_name, $last_name, $email, $phone);
    }

    // Delete a client
    public function deleteClient($client_id) {
        return $this->dao->delete($client_id);
    }
}
?>
