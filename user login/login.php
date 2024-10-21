<?php
// Start the session
session_start();

// Database connection
$host = 'localhost';
$user = 'root';  // DB username
$password = '';  // DB password
$dbname = 'tourism_management';  // DB name

$conn = new mysqli($host, $user, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Prepare the SQL query to prevent SQL injection
    $sql = "SELECT user_id, email, password FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);  // "s" stands for string type
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $row['password'])) {
            // Store the user's ID and email in the session
            $_SESSION['user_id'] = $row['user_id'];
            $_SESSION['user_email'] = $row['email'];

            // Redirect to the home page
            header("Location: index.php");
            exit();
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "Email not found!";
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>
