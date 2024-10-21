<?php
session_start();
include('config.php'); // Include your database connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch user details
$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Update user information
    $full_name = $_POST['full_name'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];

    $update_query = "UPDATE users SET full_name = ?, phone_number = ?, aadhar_number = ? WHERE user_id = ?";
    $update_stmt = $conn->prepare($update_query);
    $update_stmt->bind_param("sssi", $full_name, $phone_number, $address, $user_id);
    $update_stmt->execute();

    header("Location: profile.php"); // Redirect to profile page
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
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

/* Form Label Styles */
label {
    font-weight: bold; /* Bold labels */
    display: block; /* Each label on a new line */
    margin-top: 15px; /* Space above each label */
    color: #333; /* Darker text color */
}

/* Input and Textarea Styles */
input[type="text"], 
textarea {
    width: 100%; /* Full width */
    padding: 10px; /* Inner padding */
    margin-top: 5px; /* Space above the input */
    border: 1px solid #ccc; /* Light gray border */
    border-radius: 4px; /* Rounded corners */
    box-sizing: border-box; /* Include padding in width */
    font-size: 16px; /* Font size */
    color: #333; /* Text color */
}

input[type="text"]:focus, 
textarea:focus {
    border-color: #007BFF; /* Blue border on focus */
    outline: none; /* Remove default outline */
}

/* Button Styles */
button {
    background-color: #007BFF; /* Bootstrap primary color */
    color: white; /* White text color */
    padding: 10px 15px; /* Padding for buttons */
    border: none; /* No border */
    border-radius: 5px; /* Rounded corners */
    cursor: pointer; /* Pointer on hover */
    font-size: 16px; /* Font size */
    transition: background-color 0.3s; /* Smooth background color transition */
    margin-top: 15px; /* Space above button */
    display: block; /* Block-level button */
    width: 100%; /* Full width button */
}

button:hover {
    background-color: #0056b3; /* Darker blue on hover */
}

/* Link Styles */
a {
    display: inline-block; /* Inline block for links */
    margin-top: 15px; /* Space above link */
    color: #007BFF; /* Blue text color */
    text-decoration: none; /* Remove underline */
    font-weight: bold; /* Bold text */
}

a:hover {
    text-decoration: underline; /* Underline on hover */
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

    label {
        font-size: 14px; /* Adjust label size */
    }

    input[type="text"], 
    textarea {
        font-size: 14px; /* Adjust input and textarea size */
    }

    button {
        font-size: 14px; /* Adjust button size */
    }

    a {
        font-size: 14px; /* Adjust link size */
    }
}

        </style>
</head>
<body>
    <div class="container">
        <h1>Edit Profile</h1>
        <form method="POST">
            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" value="<?php echo htmlspecialchars($user['full_name']); ?>" required>
            <label for="phone_number">Phone Number:</label>
            <input type="text" id="phone_number" name="phone_number" value="<?php echo htmlspecialchars($user['phone_number']); ?>" required>
            <label for="address">Address:</label>
            <textarea id="address" name="address" required><?php echo htmlspecialchars($user['aadhar_number']); ?></textarea>
            <button type="submit">Update Profile</button>
        </form>
        <a href="profile.php">Cancel</a> <!-- Link to return to profile -->
    </div>
</body>
</html>
