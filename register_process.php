<?php
// Include database connection file
include_once 'db_connection.php';

// Start session to use for passing messages
session_start();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $mobile = mysqli_real_escape_string($conn, $_POST['mobile']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $special_note = mysqli_real_escape_string($conn, $_POST['special_note']);
    $user_type = mysqli_real_escape_string($conn, $_POST['user_type']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // Check if email already exists
    $emailCheckQuery = "SELECT email FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $emailCheckQuery);
    if (mysqli_num_rows($result) > 0) {
        // Email already exists, redirect back to registration page with error message
        $_SESSION['errorMessage'] = "User with email $email is already registered. Please use another email.";
        header("Location: register.php");
        exit();
    }

    // Encrypt password
    $password = password_hash($password, PASSWORD_DEFAULT);

    // Terms and conditions check
if (!isset($_POST['terms'])) {
    $_SESSION['errorMessage'] = "Please agree to the terms and conditions.";
    header("Location: register.php");
    exit();
}

// Handle profile image upload
if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
    // Define the path to the upload folder
    $uploadDir = 'img/profile_pictures/';
    // Create a unique filename for the image to prevent overwriting
    $imageName = time() . '_' . basename($_FILES['profile_image']['name']);
    $uploadFile = $uploadDir . $imageName;

    // Check if the file is an actual image
    $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
    $check = getimagesize($_FILES['profile_image']['tmp_name']);
    if ($check === false) {
        $_SESSION['errorMessage'] = "File is not an image.";
        header("Location: register.php");
        exit();
    }

    // Allow certain file formats
    if (!in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
        $_SESSION['errorMessage'] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        header("Location: register.php");
        exit();
    }

    // Check if $uploadOk is set to 0 by an error
    if (!move_uploaded_file($_FILES['profile_image']['tmp_name'], $uploadFile)) {
        $_SESSION['errorMessage'] = "Sorry, there was an error uploading your file.";
        header("Location: register.php");
        exit();
    }
} else {
    $imageName = ""; // Handle cases where no image is uploaded or an error occurred
}

// Adjust your SQL to include the imageName
$sql = "INSERT INTO users (name, email, mobile, gender, special_note, user_type, password, profile_image) VALUES ('$name', '$email', '$mobile', '$gender', '$special_note', '$user_type', '$password', '$imageName')";

    if (mysqli_query($conn, $sql)) {
        // Determine message based on user type
        $userTypeMessages = [
            "Admin" => "Admin is registered.",
            "User" => "User is registered.",
            "Editor" => "Editor is registered.",
            "Viewer" => "Viewer is registered."
        ];
        $alertMessage = isset($userTypeMessages[$user_type]) ? $userTypeMessages[$user_type] : "Registration successful.";

        $_SESSION['alertMessage'] = $alertMessage;

        // Redirect to login page
        header("Location: login.php");
        exit();
    } else {
        // Database insertion error
        $_SESSION['errorMessage'] = "Error: " . $sql . "<br>" . mysqli_error($conn);
        header("Location: register.php");
        exit();
    }
}
?>
