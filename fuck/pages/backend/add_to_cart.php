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
    die("Invalid input data");
}

// Check if the product is already in the cart
$check_query = "SELECT * FROM cart WHERE user_id = ? AND product_id = ?";
$check_stmt = $db->prepare($check_query);
$check_stmt->bind_param("ii", $p_id, $product_id);
$check_stmt->execute();
$result = $check_stmt->get_result();

if ($result->num_rows > 0) {
    // Update quantity if product exists in cart
    $update_query = "UPDATE cart SET quantity = quantity + ? WHERE user_id = ? AND product_id = ?";
    $update_stmt = $db->prepare($update_query);
    $update_stmt->bind_param("iii", $quantity, $p_id, $product_id);
    $update_stmt->execute();
} else {
    // Insert new product into cart
    $insert_query = "INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, ?)";
    $insert_stmt = $db->prepare($insert_query);
    $insert_stmt->bind_param("iii", $p_id, $product_id, $quantity);
    $insert_stmt->execute();
}

echo "Product added to cart successfully!";
header("Location: ../../index.php?page=cart");
exit();
?>
