<?php

// Prikaz grešaka (za razvoj)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL ^ (E_NOTICE | E_DEPRECATED));

class Config
{
    // Podaci za konekciju na bazu
    public static function DB_NAME() { return 'beautycenter'; }   // ime baze
    public static function DB_PORT() { return 3306; }             // port MySQL-a
    public static function DB_USER() { return 'root'; }           // korisnik
    public static function DB_PASSWORD() { return ''; }           // lozinka
    public static function DB_HOST() { return '127.0.0.1'; }      // host

    // JWT ključ za autentifikaciju
    public static function JWT_SECRET() { return 'your_key_string'; }
}
