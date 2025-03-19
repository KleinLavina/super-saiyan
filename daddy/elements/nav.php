<?php
session_start(); // Start the session
require_once "pages/backend/database_connect.php";

$db = new Database();

// Ensure the user is logged in and fetch the cart count
$cart_count = 0;
if (isset($_SESSION['p_id'])) {
    $p_id = $_SESSION['p_id'];

    // Query to count the number of unique products in the cart
    $query = "SELECT COUNT(DISTINCT product_id) AS total_items FROM cart WHERE user_id = ?";
    $stmt = $db->prepare($query);
    if ($stmt === false) {
        // Output the error if the query fails to prepare
        die('MySQL prepare error: ' . $db->error);
    }

    // Bind parameters
    $stmt->bind_param("i", $p_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $cart_count = $row['total_items'] ?? 0;
    }
}

// Check if the logout request is made
if (isset($_GET['logout']) && $_GET['logout'] == 'true') {
    session_unset();
    session_destroy();
    header("Location: index.php"); // Redirect after logout
    exit();
}
?>

<nav style="background-color: rgb(17, 40, 57); padding: 10px 0;">
    <ul style="list-style-type: none; display: flex; justify-content: center;">
        <li style="margin: 0 20px;"><a href="?page=home" class="nav-link">Home</a></li> 
        <li style="margin: 0 20px;"><a href="?page=products" class="nav-link">Products</a></li>

        <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 'true'): ?>
            <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'user'): ?>
            <li style="margin: 0 20px;"><a href="?page=purchase" class="nav-link">Purchase Records</a></li>
                    <li style="margin: 0 20px; position: relative;">
                        <a href="?page=cart" class="nav-link">
                            Cart
                            <?php if ($cart_count > 0): ?>
                                <span id="cart-count" style="background:red; color:white; padding:3px 7px; border-radius:50%; font-size:14px; position:absolute; top:-5px; right:-15px;">
                                    <?php echo $cart_count; ?>
                                </span>
                            <?php endif; ?>
                        </a>
                    </li>
                <?php endif; ?>
            <li style="margin: 0 20px;"><a href="?logout=true" class="nav-link">Log Out</a></li>
        <?php else: ?>
            <li style="margin: 0 20px;"><a href="?page=login" class="nav-link">Log In</a></li>
            <li style="margin: 0 20px;"><a href="?page=signup" class="nav-link">Sign Up</a></li>
        <?php endif; ?>
    </ul>
</nav>
