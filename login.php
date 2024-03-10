<?php
session_start();
if (isset($_SESSION['alertMessage'])) {
    echo "<script>alert('" . $_SESSION['alertMessage'] . "');</script>";
    unset($_SESSION['alertMessage']); // Clear the message from session
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<div class="container">
        <h2>Login</h2>
        <form id="loginForm" action="login_process.php" method="post">
            <input type="email" name="email" placeholder="Email"><span id="emailError" class="error"></span>
            <input type="password" name="password" placeholder="Password"><span id="passwordError" class="error"></span>
            <div class="register-user">
               <p> Don't have an account? <a href="register.php">Register</a></p>
            <button type="submit">Login</button>
        </form>
    </div>
    <script src="js/login.js"></script>
</body>
</html>
