<?php
session_start();
require 'config.php';

$user_id = $_SESSION['user_id'];

// Fetch booking history for the logged-in user
$stmt = $conn->prepare("SELECT * FROM bookings WHERE user_id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* Light gray background */
        }
        h2 {
            margin-bottom: 20px; /* Spacing below the heading */
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <img src="triptales.webp" height="70px" width="70px" alt="logo" />
        <a class="navbar-brand" href="#">TripTales</a>
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
                        <li><a class="dropdown-item" href="#">Booking History</a></li>
                        <li><a class="dropdown-item" href="#">My Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
            </ul>

            <!-- Show Login/Register Button or Account Name based on session -->
            <?php if (isset($_SESSION['user_email'])): ?>
                <span class="navbar-text me-3">Welcome, <?= htmlspecialchars($_SESSION['user_email']); ?>!</span>
                <a href="logout.php" class="btn btn-outline-danger">Logout</a>
            <?php else: ?>
                <button class="btn btn-outline-success" id="loginButton" style="color:black" data-bs-toggle="modal" data-bs-target="#loginModal">Login / Register</button>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <h2>Your Booking History</h2>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Booking ID</th>
                    <th>Destination</th>
                    <th>Booking Date</th>
                    <th>Number of Passengers</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($row['booking_id']) ?></td>
                            <td><?= htmlspecialchars($row['destination']) ?></td>
                            <td><?= htmlspecialchars($row['booking_date']) ?></td>
                            <td><?= htmlspecialchars($row['num_passengers']) ?></td>
                            <td><?= htmlspecialchars($row['price']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No booking history found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<footer class="text-center mt-5 mb-3">
    <p>&copy; <?= date('Y'); ?> TripTales. All rights reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
