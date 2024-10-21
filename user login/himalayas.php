<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Himalayas: The Majestic Mountains</title>
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
        <h1 class="text-center fade-in">Himalayas: The Majestic Mountains</h1>
        <img src="himalayas.webp" class="img-fluid my-4 rounded fade-in" alt="Himalayas">
        <p class="tour-description fade-in">
            The Himalayas, the highest mountain range in the world, offer breathtaking views and adventures. This 10-day tour will take you through the most scenic routes, ancient temples, and vibrant local culture. Experience trekking, river rafting, and the serene beauty of nature in the lap of the Himalayas.
        </p>
        <h3>Details</h3>
        <ul>
            <li><strong>Price:</strong> &#8377;15000</li>
            <li><strong>Booking Date:</strong> 2024-12-02</li>
            <li><strong>Number of Passengers:</strong> 1-4</li>
            <li><strong>Number of Days</strong> 3 days , 4 nights</li>
        </ul>
         
        <h3 class="fade-in">Highlights</h3>
        <ul class="highlight-list fade-in">
            <li>Trekking through picturesque trails.</li>
            <li>Visit sacred temples and monasteries.</li>
            <li>Experience local culture and traditions.</li>
            <li>River rafting in scenic rivers.</li>
            <li>Scenic views of snow-capped peaks.</li>
        </ul>

        <h3 class="fade-in">What's Included</h3>
        <ul class="package-list fade-in">
            <li>Round-trip airfare.</li>
            <li>All meals during the trip.</li>
            <li>Experienced guides for trekking and activities.</li>
            <li>Transportation throughout the trip.</li>
        </ul>

        <p class="mt-4 fade-in">This package is ideal for adventure seekers, nature lovers, and anyone looking to explore the majestic mountains.</p>
        
        <a href="booking.php?destination=Himalayas&price=15000" class="btn btn-primary">Book Now</a>
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

            // Animate scroll to top when Book Now button is clicked
            $('#bookNowBtn').click(function() {
                $('html, body').animate({
                    scrollTop: 0
                }, 'slow', function() {
                    window.location.href = 'booking.php'; // Redirect to booking page after scrolling
                });
            });
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
