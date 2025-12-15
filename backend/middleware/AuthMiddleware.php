<?php
// backend/middleware/AuthMiddleware.php

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class AuthMiddleware {

    // =====================
    // Provjera JWT tokena
    // =====================
    public function verifyToken($token) {
        if (!$token) {
            Flight::halt(401, "Missing authentication header");
        }

        try {
            // Dekodiranje tokena koristeći tajni ključ iz Config.php
            $decoded = JWT::decode($token, new Key(Config::JWT_SECRET(), 'HS256'));

            // Spremi korisnika i token u Flight za kasniju upotrebu
            Flight::set('user', $decoded->user);
            Flight::set('jwt_token', $token);

            return TRUE;
        } catch (\Exception $e) {
            Flight::halt(401, "Invalid or expired token: " . $e->getMessage());
        }
    }

    // =====================
    // Provjera jedne role
    // =====================
    public function authorizeRole($requiredRole) {
        $user = Flight::get('user');
        if (!isset($user->role) || $user->role !== $requiredRole) {
            Flight::halt(403, 'Access denied: insufficient privileges');
        }
    }

    // =====================
    // Provjera više rola
    // =====================
    public function authorizeRoles($roles) {
        $user = Flight::get('user');
        if (!isset($user->role) || !in_array($user->role, $roles)) {
            Flight::halt(403, 'Forbidden: role not allowed');
        }
    }

    // =====================
    // Provjera permisija
    // =====================
    public function authorizePermission($permission) {
        $user = Flight::get('user');
        if (!isset($user->permissions) || !in_array($permission, $user->permissions)) {
            Flight::halt(403, 'Access denied: permission missing');
        }
    }
}
