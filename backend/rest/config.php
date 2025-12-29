<?php

// Prikaz grešaka 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL ^ (E_NOTICE | E_DEPRECATED));

class Config
{
    // === INFINITYFREE DATABASE SETTINGS ===
    public static function DB_NAME() {
        return 'if0_40782210_beautycenter';
    }

    public static function DB_PORT() {
        return 3306;
    }

    public static function DB_USER() {
        return 'if0_40782210';
    }

    public static function DB_PASSWORD() {
        return '6zZFbmuJN9l';
    }

    public static function DB_HOST() {
        return 'sql112.infinityfree.com';
    }

    // JWT secret (može ostati bilo šta)
    public static function JWT_SECRET() {
        return 'your_key_string';
    }
}
