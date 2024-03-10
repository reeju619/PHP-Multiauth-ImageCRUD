<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['user_type'] !== 'User') {
    header("Location: login.php");
    exit();
}

// Define the welcome message
$welcomeMessage = "Welcome, User"; // Since this page is only for 'User' type, we can hardcode the role
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="css/home.css">
</head>
<body>
<div class="container">
    <h2>Welcome, User</h2>
    <!-- Home page content goes here -->

    <!-- Logout Button -->
    <form action="logout.php" method="post">
        <button type="submit" name="logout">Logout</button>
    </form>
</div>
</body>
</html>
