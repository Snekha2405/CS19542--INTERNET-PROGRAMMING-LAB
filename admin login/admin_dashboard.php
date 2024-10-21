<?php 
session_start();
include('config.php');

// Check if admin is logged in
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php");
    exit();
}

// Handle booking deletion
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete_booking_id'])) {
    $booking_id = $_POST['delete_booking_id'];

    // Prepare the delete query
    $delete_query = "DELETE FROM bookings WHERE booking_id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("i", $booking_id);
    if ($stmt->execute()) {
        echo "<div class='alert success'>Booking deleted successfully!</div>";
    } else {
        echo "<div class='alert error'>Error deleting booking!</div>";
    }
}

// Fetch all users
$users_query = "SELECT * FROM users";
$users_result = $conn->query($users_query);

// Fetch all bookings
$bookings_query = "SELECT b.booking_id, u.full_name, b.destination, b.booking_date, b.num_passengers, b.price 
                   FROM bookings b 
                   JOIN users u ON b.user_id = u.user_id";
$bookings_result = $conn->query($bookings_query);

// Handle filtering by package
$filtered_bookings = [];
$show_filtered_table = false; // Flag to control the display of the filtered bookings table
$selected_package = ''; // Variable to hold the selected package name
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['package_name'])) {
    $selected_package = $_POST['package_name'];

    // Fetch bookings for the selected package
    $package_bookings_query = "SELECT b.booking_id, u.full_name, b.destination, b.booking_date, b.num_passengers, b.price 
                               FROM bookings b 
                               JOIN users u ON b.user_id = u.user_id 
                               WHERE b.destination = ?";
    $stmt = $conn->prepare($package_bookings_query);
    $stmt->bind_param("s", $selected_package);
    $stmt->execute();
    $filtered_bookings = $stmt->get_result();
    $show_filtered_table = true; // Set flag to true to show filtered bookings table
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Trip Tales</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        header h2 {
            margin: 0;
        }
        .logout {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.3s;
        }
        .logout:hover {
            background-color: #45a049;
        }
        h3 {
            color: #333;
            border-bottom: 2px solid #4CAF50;
            padding-bottom: 10px;
        }
        .container {
            display: flex;
            flex-direction: column;
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
            overflow: hidden;
        }
        .table-container {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-bottom: 20px;
            padding: 20px;
            display: none; /* Start hidden */
        }
        .table-container.active {
            display: block; /* Show when active */
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
            color: #333;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        form {
            margin-top: 20px;
        }
        select, button {
            padding: 10px;
            margin-right: 10px;
            border-radius: 4px;
            border: 1px solid #ddd;
            transition: border-color 0.3s;
        }
        select:hover, button:hover {
            border-color: #4CAF50;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .cancel-button {
            background-color: #f44336;
            color: white;
        }
        .cancel-button:hover {
            background-color: #e53935;
        }
        .filter-section {
            margin-bottom: 20px;
        }
        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border-radius: 4px;
            display: none;
        }
        .success {
            background-color: #dff0d8;
            color: #3c763d;
        }
        .error {
            background-color: #f2dede;
            color: #a94442;
        }
    </style>
    <script>
        function toggleTable(tableId) {
            const tables = document.querySelectorAll('.table-container');
            tables.forEach(table => {
                if (table.id === tableId) {
                    table.classList.toggle('active'); // Toggle visibility
                } else {
                    table.classList.remove('active'); // Hide other tables
                }
            });
        }

        // Ensure filtered bookings table is hidden initially
        // window.onload = function() {
        //     document.getElementById('filteredBookingsTable').style.display = "none";
        // };
    </script>
</head>
<body>

<header>
    <h2>Admin Dashboard - Trip Tales</h2>
    <a href="admin_logout.php" class="logout">Logout</a>
</header>

<div class="container">
    <div class="filter-section">
        <button onclick="toggleTable('usersTableContainer')"><i class="fas fa-users"></i> View Users Table</button>
        <button onclick="toggleTable('bookingsTableContainer')"><i class="fas fa-book"></i> View Bookings Table</button>
        <button onclick="toggleTable('filterBookingsContainer')"><i class="fas fa-filter"></i> Filter Bookings</button>
    </div>

    <div class="table-container" id="usersTableContainer">
        <h3>Users</h3>
        <table>
            <tr>
                <th>User ID</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Registered On</th>
            </tr>
            <?php while($user = $users_result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $user['user_id']; ?></td>
                    <td><?php echo $user['full_name']; ?></td>
                    <td><?php echo $user['email']; ?></td>
                    <td><?php echo $user['created_at']; ?></td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <div class="table-container" id="bookingsTableContainer">
        <h3>All Bookings</h3>
        <table id="bookingsTable">
            <tr>
                <th>Booking ID</th>
                <th>User Name</th>
                <th>Package Name</th>
                <th>Booking Date</th>
                <th>Passengers</th>
                <th>Total Price</th>
                <th>Action</th>
            </tr>
            <?php while($booking = $bookings_result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $booking['booking_id']; ?></td>
                    <td><?php echo $booking['full_name']; ?></td>
                    <td><?php echo $booking['destination']; ?></td>
                    <td><?php echo $booking['booking_date']; ?></td>
                    <td><?php echo $booking['num_passengers']; ?></td>
                    <td><?php echo $booking['price']; ?></td>
                    <td>
                        <!-- Cancel Booking Button -->
                        <form method="POST" action="">
                            <input type="hidden" name="delete_booking_id" value="<?php echo $booking['booking_id']; ?>">
                            <button type="submit" class="cancel-button">Cancel</button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>
    </div>

    <div class="table" id="filterBookingsContainer">
        <h3>Filter Bookings by Package</h3>
        <form method="POST" action="">
            <select name="package_name">
                <option value="">Select Package</option>
                <option value="Paris">Paris</option>
                <option value="Goa">Goa</option>
                <option value="Himalayas">Himalayas</option>
            </select>
            <button type="submit">Filter</button>
        </form>

        <?php if ($show_filtered_table): ?>
            <h3>Filtered Bookings for <?php echo $selected_package; ?></h3>
            <table id="filteredBookingsTable" style="display: table;">
                <tr>
                    <th>Booking ID</th>
                    <th>User Name</th>
                    <th>Package Name</th>
                    <th>Booking Date</th>
                    <th>Passengers</th>
                    <th>Total Price</th>
                    <th>Action</th>
                </tr>
                <?php if ($filtered_bookings->num_rows > 0): ?>
                    <?php while($filtered_booking = $filtered_bookings->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo $filtered_booking['booking_id']; ?></td>
                            <td><?php echo $filtered_booking['full_name']; ?></td>
                            <td><?php echo $filtered_booking['destination']; ?></td>
                            <td><?php echo $filtered_booking['booking_date']; ?></td>
                            <td><?php echo $filtered_booking['num_passengers']; ?></td>
                            <td><?php echo $filtered_booking['price']; ?></td>
                            <td>
                                <!-- Cancel Booking Button -->
                                <form method="POST" action="">
                                    <input type="hidden" name="delete_booking_id" value="<?php echo $filtered_booking['booking_id']; ?>">
                                    <button type="submit" class="cancel-button">Cancel</button>
                                </form>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <div class="alert error">No bookings found for the selected package!</div>
                <?php endif; ?>
            </table>
        <?php endif; ?>
    </div>
</div>

</body>
</html>
