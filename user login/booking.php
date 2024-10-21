<?php
session_start(); // Start the session

// Check if user is logged in


// Include database connection
require 'config.php'; // Replace with your actual database connection file

// Check if booking form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id']; // Get the logged-in user's ID
    $full_name = $_POST['full_name'];
    $phone = $_POST['phone'];
    $aadhar = $_POST['aadhar'];
    $num_passengers = $_POST['num_passengers'];
    $price = $_POST['price'];
    $booking_date = $_POST['booking_date'];
    $destination = $_POST['destination'];
    
    // Insert booking details into the database
    $stmt = $conn->prepare("INSERT INTO bookings (user_id, full_name, phone, aadhar, num_passengers, price, booking_date, destination) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("isssisss", $user_id, $full_name, $phone, $aadhar, $num_passengers, $price, $booking_date, $destination);

    if ($stmt->execute()) {
        // Redirect to a success page or display a success message
        header("Location: transactions.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Booking for <?= htmlspecialchars($_GET['destination']) ?></h1>
        <form method="POST" action="">
            <input type="hidden" name="destination" value="<?= htmlspecialchars($_GET['destination']) ?>">
            <input type="hidden" name="price" value="<?= htmlspecialchars($_GET['price']) ?>">
            
            <div class="mb-3">
                <label for="full_name" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="full_name" name="full_name" required>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number</label>
                <input type="tel" class="form-control" id="phone" name="phone" required>
            </div>
            <div class="mb-3">
                <label for="aadhar" class="form-label">Address</label>
                <input type="text" class="form-control" id="aadhar" name="aadhar" required>
            </div>
            <div class="mb-3">
                <label for="num_passengers" class="form-label">Number of Passengers</label>
                <input type="number" class="form-control" id="num_passengers" name="num_passengers" min="1" max="10" required>
            </div>
            <div class="mb-3">
                <label for="booking_date" class="form-label">Booking Date</label>
                <input type="date" class="form-control" id="booking_date" name="booking_date" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Total Price</label>
                <input type="text" class="form-control" id="price" value="<?= htmlspecialchars($_GET['price']) ?>" readonly>
            </div>
            
            <button type="submit" class="btn btn-primary">Submit Booking</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
