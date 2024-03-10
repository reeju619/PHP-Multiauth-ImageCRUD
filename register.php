<?php
session_start();
if (isset($_SESSION['errorMessage'])) {
    echo "<div class='error-message'>" . $_SESSION['errorMessage'] . "</div>";
    unset($_SESSION['errorMessage']); // Clear the error message from the session
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="css/register.css">
</head>
<body>
<div class="container">
        <h2>Register</h2>
        <form id="registerForm" action="register_process.php" method="post" enctype="multipart/form-data">
            <input type="text" name="name" placeholder="Name"><span id="nameError" class="error"></span>
            <input type="email" name="email" placeholder="Email"><span id="emailError" class="error"></span>
            <input type="tel" name="mobile" placeholder="Mobile No."><span id="mobileError" class="error"></span>
            <div class="radio-group">
    <label for="gender">Gender</label> <!-- Label for the Gender field -->
    <input type="radio" id="male" name="gender" value="male">
    <label for="male">Male</label>
    <input type="radio" id="female" name="gender" value="female">
    <label for="female">Female</label>
    <input type="radio" id="other" name="gender" value="other">
    <label for="other">Other</label>
</div>
<span id="genderError" class="error"></span> <!-- Error message placeholder below the radio buttons -->


            <textarea name="special_note" placeholder="Special Note"></textarea><span id="specialNoteError" class="error"></span>
            <select name="user_type">
                <option value="">Select User Type</option>
                <option value="Admin">Admin</option>
                <option value="User">User</option>
                <option value="Editor">Editor</option>
                <option value="Viewer">Viewer</option>
            </select><span id="userTypeError" class="error"></span>
            <input type="password" name="password" placeholder="Password"><span id="passwordError" class="error"></span>
            <input type="password" name="confirm_password" placeholder="Confirm Password"><span id="confirmPasswordError" class="error"></span>
            <div class="file-group">
        <label for="profile_image">Profile Image:</label>
        <input type="file" name="profile_image" id="profile_image">
        <span id="imageError" class="error"></span>
    </div>

    <div class="checkbox-group">
        <input type="checkbox" name="terms" id="terms">
        <label for="terms">I agree to the terms and conditions</label>
    </div>
    <span id="termsError" class="error"></span>
            <div class= "already-account">
           <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
            <div class="form-submit">
            <button type="submit">Register</button>
            </div>
        </form>
    </div>
    <script src="js/register.js"></script>
</body>
</html>
