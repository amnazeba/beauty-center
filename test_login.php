<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/backend/rest/services/AdminsService.php';
require_once __DIR__ . '/backend/middleware/AuthMiddleware.php';


$adminsService = new AdminsService();

// Test admin podaci (u memoriji)
$testAdminUsername = 'admin';
$testAdminPassword = '123456'; // lozinka za test

// hash iste lozinke 
$hashedPassword = password_hash($testAdminPassword, PASSWORD_DEFAULT);

// Simuliramo login funkciju
try {
    
    $loginResult = $adminsService->login($testAdminUsername, $testAdminPassword);
    echo "Login uspješan!\n";
    print_r($loginResult);
} catch(Exception $e) {
    echo "Login failed: " . $e->getMessage() . "\n";
}
