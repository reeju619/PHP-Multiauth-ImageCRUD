<?php
session_start();

include_once 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_product'])) {
    $product_id = $_POST['product_id'];

    // Delete the product from the database
    $sql = "DELETE FROM products WHERE id = $product_id";

    if (mysqli_query($conn, $sql)) {
        $_SESSION['alertMessage'] = "Product deleted successfully.";
        header("Location: dashboard.php");
        exit();
    } else {
        $_SESSION['alertMessage'] = "Error deleting product: " . mysqli_error($conn);
        header("Location: dashboard.php");
        exit();
    }
} else {
    header("Location: dashboard.php");
    exit();
}
?>
