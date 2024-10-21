<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Goa: The Beach Paradise</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
        }
        h1, h3 {
            color: #343a40;
        }
        .container {
            background-color: white;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        .btn-primary {
            background-color: #ff6f61;
            border-color: #ff6f61;
        }
        .btn-primary:hover {
            background-color: #ff4a33;
        }
        .highlight-list, .package-list {
            list-style-type: none;
            padding-left: 0;
        }
        .highlight-list li::before, .package-list li::before {
            content: "✔";
            color: #ff6f61;
            font-weight: bold;
            margin-right: 8px;
        }
        .tour-description {
            line-height: 1.7;
        }
        .fade-in {
            display: none;
        }
        footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
            text-align: center;
            position: relative;
            bottom: 0;
            width: 100%;
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
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact Us</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Accounts
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="booking_history.php">Booking History</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="#">Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <?php if (isset($_SESSION['user_email'])): ?>
                    <span class="navbar-text me-3">Welcome, <?= htmlspecialchars($_SESSION['user_email']); ?>!</span>
                    <a href="logout.php" class="btn btn-outline-danger">Logout</a>
                <?php else: ?>
                    <button class="btn btn-outline-success btn-warning" data-bs-toggle="modal" data-bs-target="#loginModal">Login / Register</button>
                <?php endif; ?>
        </div>
    </nav>

    <!-- Content Section -->
    <div class="container mt-5">
        <h1 class="text-center fade-in">Goa: The Beach Paradise</h1>
        <img src="goa.webp" class="img-fluid my-4 rounded fade-in" alt="Goa">
        <p class="tour-description fade-in">
            Discover the vibrant culture and stunning beaches of Goa. This 5-day tour includes relaxing on pristine shores, exploring local markets, and enjoying the lively nightlife. Experience the perfect blend of adventure and relaxation in this tropical paradise.
        </p>
        <h3>Details</h3>
        <ul>
            <li><strong>Price:</strong> &#8377;12000</li>
            <li><strong>Booking Date:</strong> 2024-12-02</li>
            <li><strong>Number of Passengers:</strong> 1-4</li>
            <li><strong>Number of Days:</strong> 5 days, 4 nights</li>
        </ul>
         
        <h3 class="fade-in">Highlights</h3>
        <ul class="highlight-list fade-in">
            <li>Relaxing on beautiful beaches.</li>
            <li>Exploring vibrant local markets.</li>
            <li>Experiencing Goa's famous nightlife.</li>
            <li>Visiting historical sites and churches.</li>
            <li>Enjoying water sports and beach activities.</li>
        </ul>

        <h3 class="fade-in">What's Included</h3>
        <ul class="package-list fade-in">
            <li>Round-trip airfare.</li>
            <li>Daily breakfast and dinner.</li>
            <li>Guided tours and activities.</li>
            <li>Transportation during the trip.</li>
        </ul>

        <p class="mt-4 fade-in">This package is perfect for beach lovers and those looking to unwind in a beautiful setting.</p>
        
        <a href="booking.php?destination=Goa&price=12000" class="btn btn-primary">Book Now</a>
    </div>

    <!-- Footer Section -->
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

    <!-- jQuery Animations -->
    <script>
        $(document).ready(function() {
            // Fade in all elements on page load with a delay
            $('.fade-in').each(function(index) {
                $(this).delay(300 * index).fadeIn(1000);
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
