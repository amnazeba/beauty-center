<?php

class BaseRoutes {

    protected $service;
    protected $resource;

    public function __construct($service, $resource) {
        $this->service = $service;
        $this->resource = $resource; // npr: "clients"
    }

    public function handleRequest() {
        $method = $_SERVER['REQUEST_METHOD'];

        if (!isset($_GET['action'])) {
            echo json_encode(["error" => "Action not defined"]);
            return;
        }

        $action = $_GET['action'];

        switch ($method) {

            // GET
            case 'GET':
                if ($action === "getAll") {
                    echo json_encode($this->service->getAll());
                } elseif ($action === "getById" && isset($_GET['id'])) {
                    echo json_encode($this->service->getById($_GET['id']));
                }
                break;

            // POST (insert)
            case 'POST':
                if ($action === "insert") {
                    $data = json_decode(file_get_contents("php://input"), true);
                    echo json_encode($this->service->insert($data));
                }
                break;

            // PUT (update)
            case 'PUT':
                if ($action === "update" && isset($_GET['id'])) {
                    $data = json_decode(file_get_contents("php://input"), true);
                    echo json_encode($this->service->update($_GET['id'], $data));
                }
                break;

            // DELETE
            case 'DELETE':
                if ($action === "delete" && isset($_GET['id'])) {
                    echo json_encode($this->service->delete($_GET['id']));
                }
                break;
        }
    }
}
