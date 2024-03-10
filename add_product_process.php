<?php
session_start();

include_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate form data
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
    $product_category = mysqli_real_escape_string($conn, $_POST['product_category']);
    $product_description = mysqli_real_escape_string($conn, $_POST['product_description']);
    $stock_number = mysqli_real_escape_string($conn, $_POST['stock_number']);
    
    // Check if the checkbox is checked
    $stock_available = isset($_POST['stock_available']) ? 1 : 0;

    // Get the value of the selected radio button for Selling Status
    $selling_status = mysqli_real_escape_string($conn, $_POST['selling_status']);

    // Check if all fields are filled
    if (empty($product_name) || empty($product_price) || empty($product_category) || empty($product_description) || empty($_FILES['product_image']['name'])) {
        $_SESSION['alertMessage'] = "Please fill all the fields.";
        header("Location: product-add.php");
        exit();
    }

    // Handle file upload
    $uploadDir = 'img/product_images/';
    $imageName = time() . '_' . basename($_FILES['product_image']['name']);
    $uploadFile = $uploadDir . $imageName;

    if (!move_uploaded_file($_FILES['product_image']['tmp_name'], $uploadFile)) {
        $_SESSION['alertMessage'] = "Sorry, there was an error uploading your file.";
        header("Location: product-add.php");
        exit();
    }

    // Insert data into products table
    $sql = "INSERT INTO products (product_name, product_price, product_category, product_description, product_image, stock_number, stock_available, selling_status)
            VALUES ('$product_name', '$product_price', '$product_category', '$product_description', '$uploadFile', '$stock_number', '$stock_available', '$selling_status')";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['alertMessage'] = "Product added successfully.";
        header("Location: dashboard.php");
        exit();
    } else {
        $_SESSION['alertMessage'] = "Error: " . $sql . "<br>" . mysqli_error($conn);
        header("Location: product-add.php");
        exit();
    }
} else {
    header("Location: product-add.php");
    exit();
}
?>
