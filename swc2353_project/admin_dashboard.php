<?php
session_start();
if (!isset($_SESSION['admin_id'])) {
    header("Location: admin_login.php"); // Redirect to admin login if not logged in
    exit();
}

// Include database connection
include 'db_connect.php';

// Fetch user data
$result = $conn->query("SELECT id, name, email, phone, plan FROM users"); // Adjusted column names

if (!$result) {
    die("Query failed: " . $conn->error); // Handle query error
}

// Handle membership cancellation
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cancel_membership'])) {
    $user_id = intval($_POST['user_id']);
    $delete_result = $conn->query("DELETE FROM users WHERE id = $user_id");

    if ($delete_result) {
        echo "<p class='success-message'>Membership cancelled successfully!</p>";
        // Refresh the user list
        $result = $conn->query("SELECT id, name, email, phone, plan FROM users"); // Adjusted column names
    } else {
        echo "<p class='error-message'>Error cancelling membership: " . $conn->error . "</p>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Olympus Gym</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to your CSS file -->
    <style>
        /* Cancel Button Styles */
        .cancel-btn {
            background-color: #ff4d4d; /* Unique red background color */
            color: #fff; /* White text color */
            padding: 0.75rem 1.5rem; /* Same padding as .btn */
            border: none; /* No border */
            border-radius: 4px; /* Rounded corners */
            cursor: pointer; /* Pointer cursor on hover */
            font-size: 1rem; /* Same font size as .btn */
            transition: background-color 0.3s ease; /* Transition for hover effect */
        }

        .cancel-btn:hover {
            background-color: #ff1a1a; /* Darker red on hover */
        }

        /* Prevent table row hover effect */
        .user-table tr:hover {
            background-color: transparent; /* Reset background color on row hover */
        }
    </style>
</head>
<body>

<!-- Header -->
<header class="header">
    <div class="nav__header section__container">
        <div class="nav__logo">
            <a href="index.html">
                <img src="assets/logo.png" alt="logo" width="150" height="154" />
                OLYMPUS STRENGTH GYM
            </a>
        </div>
        <nav class="nav__menu">
            <ul class="nav__links">
                <li class="link"><a href="index.html">Home</a></li>
                <li class="link"><a href="about.html">About</a></li>
                <li class="link"><a href="classes.html">Classes</a></l>
                <li class="link"><a href="trainers.html">Trainers</a></li>
                <li class="link"><a href="pricing.html">Pricing</a></li>
                <li class="link"><a href="contact.html">Contact Us</a></li>
                <li class="link"><a href="logout.php" class="btn">Log Out</a></li>
            </ul>
        </nav>
    </div>
</header>

<div class="section__container">
    <h1>Admin Dashboard</h1>
    <h2>Manage Users</h2>
    <table class="user-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Plan</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo htmlspecialchars($row['id']); ?></td>
                <td><?php echo htmlspecialchars($row['name']); ?></td>
                <td><?php echo htmlspecialchars($row['email']); ?></td>
                <td><?php echo htmlspecialchars($row['phone']); ?></td>
                <td><?php echo htmlspecialchars($row['plan']); ?></td>
                <td>
                    <form method="POST" action="">
                        <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($row['id']); ?>">
                        <button type="submit" name="cancel_membership" class="btn cancel-btn">Cancel Membership</button>
                    </form>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<!-- Footer -->
<footer class="footer">
    <div class="section__container footer__container">
        <div class="footer__col">
            <div class="footer__logo">
                <p><a href="index.html"><img src="assets/logo.png" alt="logo" width="92" height="90"> OLYMPUS</a></p>
            </div>
            <p>Become the best version of yourself with Olympus Strength Gym. Join us today and experience fitness like never before!</p>
        </div>
        <div class="footer__col">
            <h4>Contact Us</h4>
            <p>Email: info@olympusgym.com</p>
            <p>Phone: +1 (555) 123-4567</p>
        </div>
        <div class="footer__col">
            <h4>Follow Us</h4>
            <p><a href="#">Facebook</a></p>
            <p><a href="#">Instagram</a></p>
            <p><a href="#">Twitter</a></p>
        </div>
    </div>
</footer>

</body>
</html>