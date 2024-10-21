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
    <title>Payment Confirmation</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link your external CSS if needed -->
    <style>
        /* General styles */
        body {
            font-family: Arial, sans-serif;
            background-color: black;
            margin: 0;
            padding: 0;
        }

        /* Container for the payment confirmation */
        .confirmation-container {
            width: 90%;
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Headings */
        h2 {
            color: #28a745;
            margin-bottom: 20px;
        }

        p {
            color: #333;
            margin: 10px 0;
        }

        /* Button styles */
        button {
            padding: 10px 20px;
            background-color: red;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            font-size: 16px;
        }

        button:hover {
            background-color: #8B0000;
        }
    </style>
</head>
<body>
    <div class="confirmation-container">
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Retrieve payment information from the form
            $cardName = $_POST['card_name'];
            $cardNumber = $_POST['card_number'];
            $expiryDate = $_POST['expiry_date'];
            $cvv = $_POST['cvv'];

            // Simulate payment processing (you can add validation and logic here)
            // In a real application, you would connect to a payment gateway here

            // For demonstration, let's just display a success message
            echo "<h2>Payment Successful!</h2>";
            echo "<p>Cardholder Name: $cardName</p>";
            echo "<p>Card Number: " . str_repeat('*', strlen($cardNumber) - 4) . substr($cardNumber, -4) . "</p>";
            echo "<p>Expiry Date: $expiryDate</p>";
            echo "<p>CVV: *** (hidden for security)</p>";
            echo "<p>Thank you for your payment!</p>";
        } else {
            echo "<h2>Error: Invalid Request</h2>";
        }
        ?>
        <button onclick="window.location.href='index.php'">Go to Homepage</button>
        <button onclick="window.print()">Download as PDF</button> <!-- Print button -->
    </div>
</body>
</html>