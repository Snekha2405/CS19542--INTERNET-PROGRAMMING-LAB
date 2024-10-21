<?php
$host = 'localhost';  // Usually 'localhost'
$db = 'tourism_management';      // Replace with your actual database name
$user = 'root';       // Database username, 'root' is the default for XAMPP
$pass = '';           // Database password, leave empty if no password for XAMPP

// Create a new connection to MySQL
$conn = new mysqli($host, $user, $pass, $db);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
