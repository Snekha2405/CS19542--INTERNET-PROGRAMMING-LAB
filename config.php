<?php
// Database connection
$host = 'localhost:3306';  // or 'localhost'
$db = 'tourism_management';   // Database name
$user = 'root';       // Default XAMPP username
$pass = '';           // XAMPP root user usually has no password
$charset = 'utf8mb4'; // Charset

// Set up Data Source Name (DSN)
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Enable exceptions for errors
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Set default fetch mode to associative array
    PDO::ATTR_EMULATE_PREPARES   => false,                  // Disable emulated prepared statements
];

try {
    // Create a new PDO instance
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (PDOException $e) {
    // Handle connection errors
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}
?>
