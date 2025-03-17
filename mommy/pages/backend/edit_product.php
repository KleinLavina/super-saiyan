<?php
require "database_connect.php";  // Include the Database connection class
$db = new Database();  // Instantiate the Database class

// Check if product_id is provided in the URL
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];
    
    // Fetch product details from the database based on the product_id
    $sql = "SELECT * FROM products WHERE product_id = ?";
    $stmt = $db->connection->prepare($sql);
    $stmt->bind_param('i', $product_id);  // Bind the product_id to the SQL query
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if product exists
    if ($result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        echo "Product not found!";
        exit;
    }
} else {
    echo "Product ID not specified!";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            padding: 20px;
            margin: 0;
            color: #333;
        }

        h1 {
            text-align: center;
            color: #4CAF50;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 600px;
            margin: 20px auto;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 8px;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        input[type="submit"] {
            padding: 12px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .current-image {
            display: block;
            margin: 10px 0;
        }

        .current-image img {
            max-width: 200px;
            border-radius: 5px;
        }
    </style>
</head>
<body>

<h1>Edit Item</h1>

<form action="update_product.php" method="post" enctype="multipart/form-data">
    <input type="hidden" name="product_id" value="<?php echo $product['product_id']; ?>">

    <label for="product_name">Product Name:</label>
    <input type="text" placeholder="Enter the name of an item" name="product_name" id="product_name" value="<?php echo htmlspecialchars($product['product_name']); ?>" required>

    <label for="price">Price:</label>
    <input type="number" placeholder="Enter the price, e.g $XXX.XX" name="price" id="price" value="<?php echo htmlspecialchars($product['price']); ?>" step="0.01" required>

    <label for="details">Details:</label>
    <textarea placeholder="Enter the details" name="details" id="details" required><?php echo htmlspecialchars($product['details']); ?></textarea>

    <label for="category">Category:</label>
    <select name="category" id="category" required>
        <option value="Storage Units" <?php echo $product['category'] == 'Storage Units' ? 'selected' : ''; ?>>Storage Units</option>
        <option value="Surface Furniture" <?php echo $product['category'] == 'Surface Furniture' ? 'selected' : ''; ?>>Surface Furniture</option>
        <option value="Lounge" <?php echo $product['category'] == 'Lounge' ? 'selected' : ''; ?>>Lounge</option>
    </select>

    <label for="stocks">Stocks:</label>
    <p>Current Stocks: <?php echo htmlspecialchars($product['stocks']); ?></p>
    <input type="number" placeholder="Enter stock quantity" name="stocks" id="stocks" required>

    <label for="file">Product Image:</label>
    <input type="file" name="file" id="file">
    <div class="current-image">
        <p>Current Image:</p>
        <img src="data:image/jpeg;base64,<?php echo base64_encode($product['image_data']); ?>" alt="Product Image">
    </div>

    <input type="submit" value="Update Product">
</form>


</body>
</html>

<?php
// Close the database connection
$db->close();
?>
