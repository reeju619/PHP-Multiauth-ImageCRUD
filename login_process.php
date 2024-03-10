<?php
session_start();
include_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

        // Verify password
        if (password_verify($password, $user['password'])) {
            // Set session variables
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_type'] = $user['user_type'];

            // Redirect based on user type
            if ($user['user_type'] === 'User') {
                header("Location: home.php"); // Redirect users to home.php
                exit();
            } else {
                header("Location: dashboard.php"); // Redirect all other roles to dashboard.php
                exit();
            }
        } else {
            echo "<script>alert('Please enter correct details.'); window.location.href='login.php';</script>";
        }
    } else {
        echo "<script>alert('Please enter correct details.'); window.location.href='login.php';</script>";
    }

    mysqli_close($conn);
}
?>
