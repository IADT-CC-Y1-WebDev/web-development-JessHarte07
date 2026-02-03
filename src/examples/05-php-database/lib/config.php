<?php
/**
 * Database Configuration
 *
 * This file contains the database connection settings.
 * In a production environment, these would typically be loaded from environment variables.
 */

// Database connection settings
define('DB_HOST', 'mysql-container');
define('DB_NAME', 'testdb');
define('DB_USER', 'testuser');
define('DB_PASS', 'mysecret');
define('DB_CHARSET', 'utf8mb4');

// Build the DSN (Data Source Name)
define('DB_DSN', 'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET);

// PDO Options for better error handling and security
define('DB_OPTIONS', [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
]);

// Autoloader for classes
spl_autoload_register(function ($class) {
    $classFile = __DIR__ . '/../classes/' . $class . '.php';
    if (file_exists($classFile)) {
        require_once $classFile;
    }
});
