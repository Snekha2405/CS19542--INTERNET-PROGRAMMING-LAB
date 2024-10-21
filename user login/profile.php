<?php
session_start();
include('config.php'); // Include your database connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

// Fetch user details from the database
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    echo "User not found.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>User Profile</title>
   <style>
    /* General Styles */
body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4; /* Light gray background */
    margin: 0;
    padding: 0;
}

/* Container Styles */
.container {
    max-width: 600px; /* Limit width */
    margin: 50px auto; /* Center the container */
    background: #ffffff; /* White background for the container */
    border-radius: 8px; /* Rounded corners */
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    padding: 20px; /* Inner padding */
}

/* Heading Styles */
h1 {
    text-align: center; /* Center the heading */
    color: #333; /* Darker text color */
}

/* Paragraph Styles */
p {
    font-size: 16px; /* Font size */
    line-height: 1.5; /* Line height for readability */
    margin: 15px 0; /* Margin for spacing */
    color: #555; /* Medium gray text color */
}

/* Link Styles */
a {
    display: inline-block; /* Inline block for links */
    margin: 10px 5px; /* Spacing between links */
    padding: 10px 15px; /* Padding for buttons */
    background-color: #007BFF; /* Bootstrap primary color */
    color: white; /* White text color */
    text-decoration: none; /* Remove underline */
    border-radius: 5px; /* Rounded corners */
    transition: background-color 0.3s; /* Smooth background color transition */
}

a:hover {
    background-color: #0056b3; /* Darker blue on hover */
}

/* Responsive Design */
@media (max-width: 600px) {
    .container {
        margin: 20px; /* Reduced margin on smaller screens */
        padding: 15px; /* Reduced padding on smaller screens */
    }

    h1 {
        font-size: 24px; /* Adjust heading size */
    }

    p {
        font-size: 14px; /* Adjust paragraph size */
    }
}

    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <img src="triptales.webp" height="70px" width="70px" alt="logo" />
            <a class="navbar-brand bg-warning ms-3" href="#">TripTales</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact Us</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Accounts
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="booking_history.php">Booking History</a></li>
                            <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                            
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                        </ul>
                    </li>
                </ul>

                <!-- Show Login/Register Button or Account Name based on session -->
                <?php if (isset($_SESSION['user_email'])): ?>
                    <span class="navbar-text me-3">Welcome, <?= $_SESSION['user_email']; ?>!</span>
                    <a href="logout.php" class="btn btn-outline-danger">Logout</a>
                <?php else: ?>
                    <button class="btn btn-outline-success btn-warning" id="loginButton" style="color:black" data-bs-toggle="modal" data-bs-target="#loginModal">Login / Register</button>
                <?php endif; ?>
            </div>
        </div>
    </nav>
    <div class="container">
        <h1>User Profile</h1>
        <p><strong>Full Name:</strong> <?php echo htmlspecialchars($user['full_name']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user['email']); ?></p>
        <p><strong>Phone Number:</strong> <?php echo htmlspecialchars($user['phone_number']); ?></p>
        <p><strong>Address:</strong> <?php echo htmlspecialchars($user['aadhar_number']); ?></p>
        
        <a href="edit_profile.php">Edit Profile</a> <!-- Link to edit profile page -->
        <a href="logout.php">Logout</a> <!-- Logout link -->
    </div>
</body>
</html>
