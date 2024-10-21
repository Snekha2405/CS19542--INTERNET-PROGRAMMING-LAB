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
    <title>Payment Portal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: black;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 400px;
            margin: auto;
            background: black;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            color: white;
        }
        label {
            display: block;
            margin: 10px 0 5px;
            color: white;
        }
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #28a745;
            color: white;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #218838;
        }
    </style>
    <script>
        function validateForm(event) {
            const cardName = document.getElementById('card-name').value;
            const cardNumber = document.getElementById('card-number').value;
            const expiryDate = document.getElementById('expiry-date').value;
            const cvv = document.getElementById('cvv').value;

            // Validate Cardholder Name
            if (cardName.trim() === '') {
                alert('Cardholder name is required.');
                event.preventDefault();
                return false;
            }

            // Validate Card Number (must be 16 digits)
            const cardNumberRegex = /^\d{16}$/;
            if (!cardNumberRegex.test(cardNumber)) {
                alert('Card number must be 16 digits.');
                event.preventDefault();
                return false;
            }

            // Validate Expiry Date (MM/YY format)
            const expiryDateRegex = /^(0[1-9]|1[0-2])\/?([0-9]{2})$/;
            if (!expiryDateRegex.test(expiryDate)) {
                alert('Expiry date must be in MM/YY format.');
                event.preventDefault();
                return false;
            }

            // Validate CVV (must be 3 or 4 digits)
            const cvvRegex = /^\d{3,4}$/;
            if (!cvvRegex.test(cvv)) {
                alert('CVV must be 3 or 4 digits.');
                event.preventDefault();
                return false;
            }

            // If all validations pass
            return true;
        }
    </script>
</head>
<body>
    <div class="container">
        <h2>Payment Portal</h2>
        <form id="payment-form" action="process_payment.php" method="POST" onsubmit="return validateForm(event)">
            <label for="card-name">Cardholder Name</label>
            <input type="text" id="card-name" name="card_name" required>

            <label for="card-number">Card Number</label>
            <input type="text" id="card-number" name="card_number" required>

            <label for="expiry-date">Expiry Date (MM/YY)</label>
            <input type="text" id="expiry-date" name="expiry_date" placeholder="MM/YY" required>

            <label for="cvv">CVV</label>
            <input type="text" id="cvv" name="cvv" required>

            <button type="submit">Pay Now</button>
        </form>
    </div>
</body>
</html>