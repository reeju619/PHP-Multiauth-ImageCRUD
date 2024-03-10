<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="css/product-add.css">
</head>
<body>
<div class="container">
    <h2>Add Product</h2>
    <form id="addProductForm" action="add_product_process.php" method="post" enctype="multipart/form-data">
        <input type="text" name="product_name" placeholder="Product Name">
        <input type="text" name="product_price" placeholder="Product Price">
        <select name="product_category">
            <option value="">Select Category</option>
            <option value="Electronics">Electronics</option>
            <option value="Fashion Clothing">Fashion Clothing</option>
            <option value="Household Items">Household Items</option>
            <option value="Home Appliances">Home Appliances</option>
        </select>
        <textarea name="product_description" placeholder="Product Description"></textarea>
        <input type="file" name="product_image" id="product_image" accept="image/*">
<label for="product_image" class="file-upload-btn">Upload Product Image</label>

        <div class="stock-number">
        <input type="number" name="stock_number" value="stock_number" placeholder="Stock Number">
        </div>
        <div class="stock-available">
        <label for="stock-status">Stock Status</label><br>
<label><input type="checkbox" name="stock_available" value="Yes"> Stock Available</label><br>
<label><input type="checkbox" name="stock_available" value="No"> Not Available</label><br>
</div>
<div class="selling-status"><br>
<label for="selling">Selling Status</label><br>
<label><input type="radio" name="selling_status" value="High"> High</label>
<label><input type="radio" name="selling_status" value="Medium"> Medium</label>
<label><input type="radio" name="selling_status" value="Low"> Low</label>
</div>
        <button type="submit">Add Product</button>
        <div class="reset-button">
        <button type="reset">Reset</button>
</div>
        <div class="back-button">
        <a href="dashboard.php">Back to Product List</a>
</div>
    </form>
</div>
</body>
</html>
