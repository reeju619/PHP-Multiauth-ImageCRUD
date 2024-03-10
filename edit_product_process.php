<?php
session_start();

include_once 'db_connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $product_id = mysqli_real_escape_string($conn, $_POST['product_id']);
    $product_name = mysqli_real_escape_string($conn, $_POST['product_name']);
    $product_price = mysqli_real_escape_string($conn, $_POST['product_price']);
    $product_category = mysqli_real_escape_string($conn, $_POST['product_category']);
    $product_description = mysqli_real_escape_string($conn, $_POST['product_description']);
    $stock_number = mysqli_real_escape_string($conn, $_POST['stock_number']);
    $stock_available = isset($_POST['stock_available']) ? $_POST['stock_available'] : 'No'; // Fix here
    $selling_status = mysqli_real_escape_string($conn, $_POST['selling_status']);

    // Check if a new image file is uploaded
    if ($_FILES['product_image']['error'] === UPLOAD_ERR_OK) {
        // Handle file upload
        $uploadDir = 'img/product_images/';
        $imageName = time() . '_' . basename($_FILES['product_image']['name']);
        $uploadFile = $uploadDir . $imageName;

        if (!move_uploaded_file($_FILES['product_image']['tmp_name'], $uploadFile)) {
            $_SESSION['alertMessage'] = "Sorry, there was an error uploading your file.";
            header("Location: product-edit.php?id=$product_id");
            exit();
        }

        // Update product record with new image path
        $sql = "UPDATE products SET 
        product_name = '$product_name', 
        product_price = '$product_price', 
        product_category = '$product_category', 
        product_description = '$product_description', 
        stock_number = '$stock_number', 
        stock_available = '$stock_available', 
        selling_status = '$selling_status' 
        WHERE id = '$product_id'";
    } else {
        // Update product record without changing the image path
        $sql = "UPDATE products SET 
        product_name = '$product_name', 
        product_price = '$product_price', 
        product_category = '$product_category', 
        product_description = '$product_description', 
        stock_number = '$stock_number', 
        stock_available = '$stock_available', 
        selling_status = '$selling_status' 
        WHERE id = '$product_id'";
    }

    if (mysqli_query($conn, $sql)) {
        $_SESSION['alertMessage'] = "Product updated successfully.";
        header("Location: dashboard.php");
        exit();
    } else {
        $_SESSION['alertMessage'] = "Error updating product: " . mysqli_error($conn);
        header("Location: product-edit.php?id=$product_id");
        exit();
    }
}
?>
