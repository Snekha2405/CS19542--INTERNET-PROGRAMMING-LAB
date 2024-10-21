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
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        .package-card {
            margin-bottom: 20px;
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
        .fade-in {
            display: none;
        }
    </style>
</head>
<body>
    <!-- Navbar Section -->
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
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
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

    <!-- Content Section -->
    <div class="container mt-5">
        <h1 class="text-center fade-in">Welcome to TripTales</h1>
        <p class="text-center fade-in">Discover amazing travel packages tailored just for you.</p>

        <div class="row mt-4">
            <!-- Package Card for Paris -->
            <div class="col-md-4 package-card fade-in">
                <div class="card">
                    <img src="paris.jpg" class="card-img-top" alt="Paris">
                    <div class="card-body">
                        <h5 class="card-title">Paris: The City of Love</h5>
                        <p class="card-text">Experience the romance of Paris with our all-inclusive package.</p>
                        <a href="paris.php" class="btn btn-primary">Explore More</a>
                    </div>
                </div>
            </div>
            <!-- Package Card for Goa -->
            <div class="col-md-4 package-card fade-in">
                <div class="card">
                    <img src="goa.webp" class="card-img-top" alt="Goa">
                    <div class="card-body">
                        <h5 class="card-title">Goa: The Beach Paradise</h5>
                        <p class="card-text">Relax on the beaches of Goa with our exciting travel package.</p>
                        <a href="goa.php" class="btn btn-primary">Explore More</a>
                    </div>
                </div>
            </div>
            <!-- Package Card for Himalayas -->
            <div class="col-md-4 package-card fade-in">
                <div class="card">
                    <img src="himalayas.webp" class="card-img-top" alt="Himalayas">
                    <div class="card-body">
                        <h5 class="card-title">Himalayas: The Majestic Mountains</h5>
                        <p class="card-text">Embark on an adventure in the Himalayas with breathtaking views.</p>
                        <a href="himalayas.php" class="btn btn-primary">Explore More</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Section -->
    <footer>
        <div class="container">
            <p>&copy; 2024 TripTales. All rights reserved.</p>
            <p>Follow us on:
                <a href="#" target="_blank">Facebook</a> |
                <a href="#" target="_blank">Instagram</a> |
                <a href="#" target="_blank">Twitter</a>
            </p>
        </div>
    </footer>

    <!-- jQuery Animations -->
    <script>
        $(document).ready(function() {
            // Fade in all elements on page load with a delay
            $('.fade-in').each(function(index) {
                $(this).delay(300 * index).fadeIn(1000);
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>
