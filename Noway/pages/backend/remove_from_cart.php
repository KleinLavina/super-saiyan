<?php
session_start();
require "database_connect.php";

$db = new Database();

// Ensure the user is logged in
if (!isset($_SESSION['p_id'])) {
    die("User not logged in. Please log in first.");
}

$p_id = $_SESSION['p_id']; // Get the logged-in user's ID
$product_id = $_POST['product_id']; // Get product ID from the request

// Validate input
if (!is_numeric($product_id)) {
    die("Invalid product ID.");
}

// Delete the product from the cart
$query = "DELETE FROM cart WHERE user_id = ? AND product_id = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("ii", $p_id, $product_id);
$stmt->execute();

if ($stmt->affected_rows > 0) {
    echo "Product removed from cart.";
    header("Location: ../../index.php?page=cart");
    exit();
} else {
    echo "Error: Product not found in cart.";
}
?>
