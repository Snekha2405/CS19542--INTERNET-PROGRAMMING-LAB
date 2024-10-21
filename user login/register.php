<?php
session_start();
include 'config.php'; // Assuming this connects to your MySQL database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password for security
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Insert user details into the database
    $query = "INSERT INTO users (full_name, email, password, phone_number, aadhar_number) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("sssss", $full_name, $email, $password, $phone, $address);

    if ($stmt->execute()) {
        // Get the inserted user_id and set session
        $user_id = $conn->insert_id;
        $_SESSION['user_id'] = $user_id;
        $_SESSION['user_email'] = $email;
        header("Location: index.php"); // Redirect to the homepage after registration
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
