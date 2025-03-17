<?php
session_start();
require_once "database_connect.php"; // Ensure Database class is correctly imported

$db = new Database(); // Initialize database connection

if (!isset($_SESSION['p_id'])) {
    die("User not logged in. Please log in first.");
}

$p_id = $_SESSION['p_id']; // Logged-in user ID

// Check if database connection is valid
if (!$db->connection) {
    die("Database connection error: " . $db->connection->connect_error);
}

// Check if buying a single product or all cart items
if (isset($_POST['product_id']) && isset($_POST['quantity'])) {
    // Buy a single product
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Fetch product details
    $query = "SELECT product_id, price, stocks FROM products WHERE product_id = ?";
    $stmt = $db->connection->prepare($query);

    if (!$stmt) {
        die("SQL Error (Prepare Failed): " . $db->connection->error);
    }

    $stmt->bind_param("i", $product_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();

    if (!$product) {
        die("Product not found.");
    }

    if ($quantity > $product['stocks']) {
        die("Insufficient stock for this item.");
    }

    $total_price = $product['price'] * $quantity;

    // Start transaction
    $db->connection->begin_transaction();

    try {
        // Insert purchase record
        $insert_query = "INSERT INTO purchases (user_id, product_id, quantity, total_price) VALUES (?, ?, ?, ?)";
        $stmt = $db->connection->prepare($insert_query);

        if (!$stmt) {
            throw new Exception("Insert Query Error: " . $db->connection->error);
        }

        $stmt->bind_param("iiid", $p_id, $product_id, $quantity, $total_price);
        $stmt->execute();

        // Deduct stock
        $update_stock_query = "UPDATE products SET stocks = stocks - ? WHERE product_id = ?";
        $stmt = $db->connection->prepare($update_stock_query);

        if (!$stmt) {
            throw new Exception("Stock Update Error: " . $db->connection->error);
        }

        $stmt->bind_param("ii", $quantity, $product_id);
        $stmt->execute();

        // Remove item from cart
        $delete_cart_query = "DELETE FROM cart WHERE user_id = ? AND product_id = ?";
        $stmt = $db->connection->prepare($delete_cart_query);

        if (!$stmt) {
            throw new Exception("Cart Delete Error: " . $db->connection->error);
        }

        $stmt->bind_param("ii", $p_id, $product_id);
        $stmt->execute();

        $db->connection->commit();
        echo "Checkout successful for " . htmlspecialchars($product['product_id']);
    } catch (Exception $e) {
        $db->connection->rollback();
        die("Checkout failed: " . $e->getMessage());
    }
} else {
    // Process full cart checkout (if no product_id is provided)
    $query = "SELECT cart.product_id, products.price, cart.quantity, products.stocks 
              FROM cart 
              JOIN products ON cart.product_id = products.product_id 
              WHERE cart.user_id = ?";

    $stmt = $db->connection->prepare($query);
    if (!$stmt) {
        die("SQL Error (Prepare Failed): " . $db->connection->error);
    }

    $stmt->bind_param("i", $p_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if (!$result) {
        die("Query Execution Failed: " . $db->connection->error);
    }

    $purchases = [];
    $insufficient_stock = [];

    while ($row = $result->fetch_assoc()) {
        if ($row['quantity'] > $row['stocks']) {
            $insufficient_stock[] = $row['product_id'];
        } else {
            $purchases[] = $row;
        }
    }

    if (!empty($insufficient_stock)) {
        die("Some items are out of stock. Please update your cart.");
    }

    $db->connection->begin_transaction();

    try {
        foreach ($purchases as $purchase) {
            $product_id = $purchase['product_id'];
            $quantity = $purchase['quantity'];
            $total_price = $purchase['price'] * $quantity;

            // Insert purchase record
            $insert_query = "INSERT INTO purchases (user_id, product_id, quantity, total_price) VALUES (?, ?, ?, ?)";
            $stmt = $db->connection->prepare($insert_query);

            if (!$stmt) {
                throw new Exception("Insert Query Error: " . $db->connection->error);
            }

            $stmt->bind_param("iiid", $p_id, $product_id, $quantity, $total_price);
            $stmt->execute();

            // Deduct stock
            $update_stock_query = "UPDATE products SET stocks = stocks - ? WHERE product_id = ?";
            $stmt = $db->connection->prepare($update_stock_query);

            if (!$stmt) {
                throw new Exception("Stock Update Error: " . $db->connection->error);
            }

            $stmt->bind_param("ii", $quantity, $product_id);
            $stmt->execute();
        }

        // Clear cart after checkout
        $delete_cart_query = "DELETE FROM cart WHERE user_id = ?";
        $stmt = $db->connection->prepare($delete_cart_query);

        if (!$stmt) {
            throw new Exception("Cart Delete Error: " . $db->connection->error);
        }

        $stmt->bind_param("i", $p_id);
        $stmt->execute();

        $db->connection->commit();
        echo "Checkout successful! Your purchases have been recorded.";
    } catch (Exception $e) {
        $db->connection->rollback();
        die("Checkout failed: " . $e->getMessage());
    }
}
?>
