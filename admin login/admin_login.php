<?php
session_start();
include('config.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $admin_email = $_POST['admin_email'];
    $admin_password = $_POST['admin_password'];

    // Prepare and execute a query to check admin credentials
    $query = "SELECT * FROM admin WHERE admin_email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $admin_email);
    $stmt->execute();
    $result = $stmt->get_result();
    $admin = $result->fetch_assoc();

    // Verify the password
    if ($admin && password_verify($admin_password, $admin['admin_password'])) {
        // Set session and redirect to admin dashboard
        $_SESSION['admin_id'] = $admin['admin_id'];
        header("Location: admin_dashboard.php");
        exit();
    } else {
        // Invalid login
        $error_message = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Trip Tales</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .login-container {
            width: 300px;
            margin: 100px auto;
            padding: 20px;
            border: 1px solid #ddd;
            background-color: #f9f9f9;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .login-container h2 { text-align: center; }
        .login-container input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            box-sizing: border-box;
        }
        .login-container button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            cursor: pointer;
        }
        .login-container button:hover { background-color: #218838; }
        .error { color: red; text-align: center; }
    </style>
</head>
<body>

<div class="login-container">
    <h2>Admin Login</h2>

    <?php if (!empty($error_message)): ?>
        <div class="error"><?php echo $error_message; ?></div>
    <?php endif; ?>

    <form method="POST" action="">
        <input type="email" name="admin_email" placeholder="Admin Email" required>
        <input type="password" name="admin_password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
</div>

</body>
</html>
