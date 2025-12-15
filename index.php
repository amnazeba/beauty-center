<?php
// index.php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/vendor/mikecao/flight/flight/Flight.php';

// ========= Config / Database =========
require_once __DIR__ . '/backend/rest/config.php';

// ========= DAO =========
require_once __DIR__ . '/backend/rest/dao/BaseDao.php';
require_once __DIR__ . '/backend/rest/dao/AdminsDao.php';
require_once __DIR__ . '/backend/rest/dao/AppointmentsDao.php';
require_once __DIR__ . '/backend/rest/dao/ClientsDao.php';
require_once __DIR__ . '/backend/rest/dao/EmployeesDao.php';
require_once __DIR__ . '/backend/rest/dao/ReviewsDao.php';
require_once __DIR__ . '/backend/rest/dao/ServicesDao.php';

// ========= Services =========
require_once __DIR__ . '/backend/rest/services/BaseService.php';
require_once __DIR__ . '/backend/rest/services/AdminsService.php';
require_once __DIR__ . '/backend/rest/services/AppointmentsService.php';
require_once __DIR__ . '/backend/rest/services/ClientsService.php';
require_once __DIR__ . '/backend/rest/services/EmployeesService.php';
require_once __DIR__ . '/backend/rest/services/ReviewsService.php';
require_once __DIR__ . '/backend/rest/services/ServicesService.php';

// ========= Middleware & Roles =========
require_once __DIR__ . '/backend/middleware/AuthMiddleware.php';
require_once __DIR__ . '/backend/data/roles.php';

// ========= JWT =========
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// ========= Register services in Flight =========
Flight::register('adminsService', 'AdminsService');
Flight::register('appointmentsService', 'AppointmentsService');
Flight::register('clientsService', 'ClientsService');
Flight::register('employeesService', 'EmployeesService');
Flight::register('reviewsService', 'ReviewsService');
Flight::register('servicesService', 'ServicesService');

// AuthMiddleware register kao string klase
Flight::register('auth_middleware', 'AuthMiddleware');

// ===================================================
// JWT Middleware — applies to ALL routes except login/register
// ===================================================
Flight::route('/*', function() {
    $url = Flight::request()->url;

    // Allow login and register without token
    if (
        strpos($url, '/admins/login') === 0 ||
        strpos($url, '/admins/register') === 0
    ) {
        return TRUE;
    }

    // Verify token for all other routes
    $token = Flight::request()->getHeader("Authentication");
    Flight::auth_middleware()->verifyToken($token);
});

// ========= ROUTES =========
require_once __DIR__ . '/backend/rest/routes/AdminsRoutes.php';
require_once __DIR__ . '/backend/rest/routes/AppointmentRoutes.php';
require_once __DIR__ . '/backend/rest/routes/ClientRoutes.php';
require_once __DIR__ . '/backend/rest/routes/EmployeeRoutes.php';
require_once __DIR__ . '/backend/rest/routes/ReviewRoutes.php';
require_once __DIR__ . '/backend/rest/routes/ServiceRoutes.php';

// ========= START =========
Flight::start();
