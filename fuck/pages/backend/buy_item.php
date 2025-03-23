<?php
session_start();
require "database_connect.php";

$db = new Database();

// Ensure the user is logged in
if (!isset($_SESSION['p_id'])) {
    die("User not logged in. Please log in first.");
}

$p_id = $_SESSION['p_id']; // Get logged-in user's ID
$product_id = $_POST['product_id'];
$quantity = $_POST['quantity'];

// Validate input
if (!is_numeric($product_id) || !is_numeric($quantity) || $quantity < 1) {
    die("Invalid input data.");
}

// Check stock availability
$stock_query = "SELECT price, stocks FROM products WHERE product_id = ?";
$stock_stmt = $db->prepare($stock_query);
$stock_stmt->bind_param("i", $product_id);
$stock_stmt->execute();
$stock_result = $stock_stmt->get_result();

if ($stock_result->num_rows === 0) {
    die("Product not found.");
}

$product = $stock_result->fetch_assoc();
$price = $product['price'];
$stocks = $product['stocks'];

// Check if requested quantity exceeds available stock
if ($quantity > $stocks) {
    // Redirect back to cart page with error message
    $_SESSION['error_message'] = "Not enough stock available for this product.";
    header("Location: ../../index.php?page=products");  // Redirect back to cart or desired page
    exit();
}

// Calculate total price
$total_price = $price * $quantity;

// Insert purchase record into `purchases` table
$insert_purchase_query = "INSERT INTO purchases (user_id, product_id, quantity, total_price) VALUES (?, ?, ?, ?)";
$insert_purchase_stmt = $db->prepare($insert_purchase_query);
$insert_purchase_stmt->bind_param("iiid", $p_id, $product_id, $quantity, $total_price);
$insert_purchase_stmt->execute();

// Deduct stock from `products` table
$update_stock_query = "UPDATE products SET stocks = stocks - ? WHERE product_id = ?";
$update_stock_stmt = $db->prepare($update_stock_query);
$update_stock_stmt->bind_param("ii", $quantity, $product_id);
$update_stock_stmt->execute();

// Successful purchase
$_SESSION['success_message'] = "Purchase successful!  Thank you for shopping with us.";
header("Location: ../../index.php?page=products");
exit();
?>
