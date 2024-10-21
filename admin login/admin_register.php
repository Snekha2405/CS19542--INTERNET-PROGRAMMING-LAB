<?php
include('config.php');

// Set admin email and password
$admin_email = 'admin@example.com';
$admin_password = 'admin123';  // This is the plain password

// Hash the password
$hashed_password = password_hash($admin_password, PASSWORD_DEFAULT);

// Insert into the admin table
$query = "INSERT INTO admin (admin_email, admin_password) VALUES (?, ?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss", $admin_email, $hashed_password);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Admin account created successfully!";
} else {
    echo "Failed to create admin account.";
}
?>
