<?php
session_start();

include_once 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: dashboard.php");
    exit();
}

$product_id = $_GET['id'];
$sql = "SELECT * FROM products WHERE id = '$product_id'";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) === 0) {
    header("Location: dashboard.php");
    exit();
}

$product = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="css/product-edit.css">
</head>
<body>
<div class="container">
    <h2>Edit Product</h2>
    <form id="editProductForm" action="edit_product_process.php" method="post" enctype="multipart/form-data">
        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
        <input type="text" name="product_name" value="<?= $product['product_name'] ?>" placeholder="Product Name">
        <input type="text" name="product_price" value="<?= $product['product_price'] ?>" placeholder="Product Price">
        <select name="product_category">
            <option value="">Select Category</option>
            <option value="Electronics" <?= ($product['product_category'] == 'Electronics') ? 'selected' : '' ?>>Electronics</option>
            <option value="Fashion Clothing" <?= ($product['product_category'] == 'Fashion Clothing') ? 'selected' : '' ?>>Fashion Clothing</option>
            <option value="Household Items" <?= ($product['product_category'] == 'Household Items') ? 'selected' : '' ?>>Household Items</option>
            <option value="Home Appliances" <?= ($product['product_category'] == 'Home Appliances') ? 'selected' : '' ?>>Home Appliances</option>
        </select>
        <textarea name="product_description" placeholder="Product Description"><?= $product['product_description'] ?></textarea>
        <div class="image-preview">
            <label for="product_image">Product Image:</label><br>
            <img src="<?= $product['product_image'] ?>" alt="Product Image"><br>
            <input type="file" name="product_image" id="product_image">
        </div>
        <div class="stock-number">
        <label for="stock-no">Stock Number</label>
        <input type="number" name="stock_number" value="<?= $product['stock_number'] ?>" placeholder="Stock Number">
        </div>
        <div class="stock-available">
        <label for="stock-status">Stock Status</label><br>
<label><input type="radio" name="stock_available" value="Yes" <?= ($product['stock_available'] == 'Yes') ? 'checked' : '' ?>> Stock Available</label><br>
<label><input type="radio" name="stock_available" value="No" <?= ($product['stock_available'] == 'No') ? 'checked' : '' ?>> Not Available</label><br>
</div>
<div class="selling-status">
<label for="selling">Selling Status</label><br>
<label><input type="radio" name="selling_status" value="High" <?= ($product['selling_status'] == 'High') ? 'checked' : '' ?>> High</label>
<label><input type="radio" name="selling_status" value="Medium" <?= ($product['selling_status'] == 'Medium') ? 'checked' : '' ?>> Medium</label>
<label><input type="radio" name="selling_status" value="Low" <?= ($product['selling_status'] == 'Low') ? 'checked' : '' ?>> Low</label>
</div>
<div class="product-status">
        <button type="submit">Update Product</button>
        <a href="dashboard.php">Cancel</a>
</div>
    </form>
</div>
</body>
</html>
