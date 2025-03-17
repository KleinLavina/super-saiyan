<?php
require "database_connect.php";  // Include the Database connection class
$db = new Database();  // Instantiate the Database class

// Check if product_id is provided
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Prepare SQL to delete the product
    $sql = "DELETE FROM products WHERE product_id = ?";
    $stmt = $db->connection->prepare($sql);
    $stmt->bind_param('i', $product_id);
    
    if ($stmt->execute()) {
        echo "Product deleted successfully!";
        // Redirect back to products page
        header("Location: ../../?page=products");
        exit;
    } else {
        echo "Error deleting product: " . $stmt->error;
    }
} else {
    echo "Product ID not specified!";
}

$db->close();
?>
