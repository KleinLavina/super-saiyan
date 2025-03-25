<?php
require "database_connect.php";  // Include the Database connection class
$db = new Database();  // Instantiate the Database class

// Check if product_id is provided
if (isset($_GET['product_id'])) {
    $product_id = $_GET['product_id'];

    // Start a transaction
    $db->connection->begin_transaction();

    try {
        // First, delete related records in purchases
        $stmt_purchases = $db->connection->prepare("DELETE FROM purchases WHERE product_id = ?");
        $stmt_purchases->bind_param('i', $product_id);
        $stmt_purchases->execute();
        $stmt_purchases->close();

        // Delete related records in cart
        $stmt_cart = $db->connection->prepare("DELETE FROM cart WHERE product_id = ?");
        $stmt_cart->bind_param('i', $product_id);
        $stmt_cart->execute();
        $stmt_cart->close();

        // Now, delete the product
        $stmt_product = $db->connection->prepare("DELETE FROM products WHERE product_id = ?");
        $stmt_product->bind_param('i', $product_id);
        $stmt_product->execute();
        $stmt_product->close();

        // Commit transaction if all queries were successful
        $db->connection->commit();

        echo "Product deleted successfully!";
        header("Location: ../../?page=products");  // Redirect back to products page
        exit;

    } catch (mysqli_sql_exception $e) {  // ✅ Properly catching MySQL errors
        // Rollback changes if an error occurs
        $db->connection->rollback();
        echo "Error deleting product: " . $e->getMessage();
    }
} else {
    echo "Product ID not specified!";
}

// Close database connection
$db->close();
?>
