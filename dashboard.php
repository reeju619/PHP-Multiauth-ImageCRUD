<?php
session_start();

include_once 'db_connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userType = isset($_SESSION['user_type']) ? $_SESSION['user_type'] : 'User';
$welcomeMessage = "Welcome, $userType";

$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);

if (!$result || mysqli_num_rows($result) === 0) {
    $products = []; // Initialize an empty array if no products are found
} else {
    $products = mysqli_fetch_all($result, MYSQLI_ASSOC); // Fetch all products as an associative array
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
</head>
<body>
<div class="container">
    <h2><?= $welcomeMessage ?></h2>
    <div class="add-button-container">
        <a href="product-add.php" class="add-button">Add Product</a>
    </div>
    <table>
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Product Price</th>
                <th>Product Category</th>
                <th>Product Description</th>
                <th>Product Image</th>
                <th>Stock Number</th>
<th>Stock Available</th>
<th>Selling Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                <td><?= $product['product_name'] ?? 'N/A' ?></td>
                <td><?= $product['product_price'] ?? 'N/A' ?> Rs/-</td>
                <td><?= $product['product_category'] ?? 'N/A' ?></td>
                <td><?= $product['product_description'] ?? 'N/A' ?></td>
                <td><img src="<?= $product['product_image'] ?? 'N/A' ?>" alt="Product Image"></td>
                <td><?= $product['stock_number'] ?? 'N/A' ?></td>
<td><?= $product['stock_available'] ?? 'N/A' ?></td>
<td><?= $product['selling_status'] ?? 'N/A' ?></td>
                <td><a href='product-edit.php?id=<?= $product['id'] ?>'>Edit</a>
                 <form action="delete_product.php" method="post">
        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">
        <button type="submit" name="delete_product">Delete</button>
    </form></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <!-- Logout Button -->
    <form action="logout.php" method="post">
        <button type="submit" name="logout" class="logout">Logout</button>
    </form>
</div>
</body>
</html>
