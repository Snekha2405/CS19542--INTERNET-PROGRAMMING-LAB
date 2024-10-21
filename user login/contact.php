
<?php
session_start();

// Check if user is logged in, otherwise redirect to login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tourism Management System - TripTales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        .container {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        
        .container {
            max-width: 800px;
            margin: auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        h1 {
            text-align: center;
            color: #333;
        }
        p {
            line-height: 1.6;
            color: #555;
            margin-bottom: 15px;
        }
        .logo {
            display: block;
            margin: 0 auto 20px;
            max-width: 150px; /* Adjust according to your logo size */
        }
        h2 {
            color: #007BFF; /* Bootstrap primary color */
            margin-top: 20px;
        }
        .mission, .values, .get-in-touch {
            margin: 20px 0;
            padding: 15px;
            border-left: 4px solid #007BFF; /* Blue left border for section emphasis */
            background: #e7f1ff; /* Light blue background */
        }
        footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
            text-align: center;
        }
        footer a {
            color: #FFD700;
        }
        footer a:hover {
            color: #FF8C00;
        }
    </style>
</head>
<body>

<header>
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
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="" role="button" data-bs-toggle="dropdown" aria-expanded="false">
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
</header>

<div class="container">
    <img src="triptales.webp" alt="Trip Tales Logo" class="logo"> <!-- Add your logo here -->

    <h1>About Us</h1>
    <p>Welcome to Trip Tales, your premier online platform for unforgettable travel experiences! We specialize in curating exceptional travel packages that cater to every type of traveler, ensuring that you explore the world's most stunning destinations, including the enchanting city of <strong>Paris</strong>, the serene beaches of <strong>Goa</strong>, and the breathtaking landscapes of the <strong>Himalayas</strong>.</p>
    
    <div class="mission">
        <h2>Our Mission</h2>
        <p>At Trip Tales, our mission is to simplify travel planning by providing a seamless, user-friendly platform where travelers can easily access, explore, and book their dream vacations. We believe that every journey tells a story, and our goal is to help you create beautiful memories that last a lifetime. We are committed to transparency, offering real-time availability and pricing, so you can make informed decisions while booking your travel packages.</p>
    </div>
    
    <div class="values">
        <h2>Our Values</h2>
        <p>We pride ourselves on upholding core values such as customer satisfaction, integrity, and cultural preservation. Our dedicated team of travel enthusiasts is passionate about providing exceptional service, ensuring that every customer has a delightful experience from the moment they visit our site to the time they return from their travels. We strive to foster connections between travelers and local cultures, supporting sustainable tourism and local artisans.</p>
    </div>

    <div class="get-in-touch">
        <h2>Get in Touch</h2>
        <p>If you have any questions, feedback, or inquiries about our travel packages, please don't hesitate to reach out. Our customer support team is here to assist you in making your travel dreams come true! You can contact us through our website's contact form or email us directly at support@triptales.com.</p>
    </div>
</div>

<footer>
        <div class="container-fluid">
            <p>&copy; 2024 TripTales. All rights reserved.</p>
            <p>Follow us on:
                <a href="#" target="_blank">Facebook</a> |
                <a href="#" target="_blank">Instagram</a> |
                <a href="#" target="_blank">Twitter</a>
            </p>
        </div>
    </footer>
</body>
</html>
