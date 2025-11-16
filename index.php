<?php
// index.php

// ======================
// Učitaj konfiguraciju baze
require_once __DIR__ . '/backend/rest/config.php';

// ======================
// Učitaj FlightPHP framework
require_once __DIR__ . '/vendor/mikecao/flight/flight/Flight.php';

// ======================
// Učitaj DAO-e
require_once __DIR__ . '/backend/rest/dao/BaseDao.php';
require_once __DIR__ . '/backend/rest/dao/AdminsDao.php';
require_once __DIR__ . '/backend/rest/dao/AppointmentsDao.php';
require_once __DIR__ . '/backend/rest/dao/ClientsDao.php';
require_once __DIR__ . '/backend/rest/dao/EmployeesDao.php';
require_once __DIR__ . '/backend/rest/dao/ReviewsDao.php';
require_once __DIR__ . '/backend/rest/dao/ServicesDao.php';

// ======================
// Učitaj Servise
require_once __DIR__ . '/backend/rest/services/BaseService.php';
require_once __DIR__ . '/backend/rest/services/AdminsService.php';
require_once __DIR__ . '/backend/rest/services/AppointmentsService.php';
require_once __DIR__ . '/backend/rest/services/ClientsService.php';
require_once __DIR__ . '/backend/rest/services/EmployeesService.php';
require_once __DIR__ . '/backend/rest/services/ReviewsService.php';
require_once __DIR__ . '/backend/rest/services/ServicesService.php';

// ======================
// Inicijalizacija DAO i Service objekata
$adminsService = new AdminsService();
$appointmentsService = new AppointmentsService();
$clientsService = new ClientsService();
$employeesService = new EmployeesService();
$reviewsService = new ReviewsService();
$servicesService = new ServicesService();

// ======================
// Admin rute
Flight::route('GET /index.php/admins', fn() => Flight::json($adminsService->getAll()));
Flight::route('GET /index.php/admins/@id', fn($id) => Flight::json($adminsService->getById($id)));
Flight::route('POST /index.php/admins/login', function() use ($adminsService) {
    $data = Flight::request()->data->getData();
    try {
        $result = $adminsService->login($data['username'], $data['password']);
        Flight::json($result);
    } catch (Exception $e) {
        Flight::json(['error' => $e->getMessage()], 400);
    }
});
Flight::route('POST /index.php/admins/register', function() use ($adminsService) {
    $data = Flight::request()->data->getData();
    try {
        $result = $adminsService->register($data['username'], $data['password'], $data['full_name'], $data['email']);
        Flight::json($result);
    } catch (Exception $e) {
        Flight::json(['error' => $e->getMessage()], 400);
    }
});
Flight::route('PUT /index.php/admins/@id', fn($id) => Flight::json($adminsService->updateAdmin($id, Flight::request()->data->getData()['full_name'], Flight::request()->data->getData()['email'])));

// ======================
// Reviews rute (po client_id)
Flight::route('GET /index.php/reviews/client/@id', fn($id) => Flight::json($reviewsService->getByClientId($id)));

// ======================
// Pokreni Flight
Flight::start();
