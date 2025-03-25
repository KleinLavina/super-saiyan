
<style>
    /* Valorant-Themed Navigation */
    nav {
        background: linear-gradient(to right, #0D0D0D, #1A1A1A);
        border-bottom: 4px solid #FF4655;
        padding: 10px 0;
        box-shadow: 0 4px 15px rgba(255, 70, 85, 0.4);
        position: relative;
        z-index: 1000;
        font-style:italic;
        letter-spacing: 4px;
        
    }

    ul {
        list-style-type: none;
        display: flex;
        justify-content: center;
        margin: 0;
        padding: 0;
    }

    li {
        margin: 0 20px;
        position: relative;
    }

    /* Navigation Links */
    .nav-link {
        text-decoration: none;
        color: #FFFFFF;
        font-size: 16px;
        font-weight: bold;
        padding: 12px 20px;
        position: relative;
        transition: all 0.3s ease-in-out;
    }

    /* Hover effect - animated glow */
    .nav-link:hover {
        background: linear-gradient(90deg, rgba(255,3,3,1) 22%, rgba(90,6,255,1) 50%, rgba(18,136,137,1) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    transform: skewX(-10deg); /* Slanted text effect */
    text-shadow: 0 0 10px rgba(255, 70, 85, 0.8); /* Glowing effect */
        transform: scale(1.1);
        animation: flicker 0.5s infinite alternate;
    }

    /* Glow Effect */
    .nav-link::before {
        content: "";
        position: absolute;
        bottom: -5px;
        left: 50%;
        width: 0;
        height: 3px;
        background: #FF4655;
        transition: width 0.3s ease, left 0.3s ease;
    }

    .nav-link:hover::before {
        width: 100%;
        left: 0;
    }

    /* Active link pulsing effect */
    .nav-link.active {
        color: #FF4655;
        border-bottom: 3px solid #FF4655;
        animation: pulseGlow 1.5s infinite alternate;
    }

    /* Cart count badge */
    #cart-count {
        background: linear-gradient(135deg, #FF4655, #8A2BE2);
        color: #FFFFFF;
        padding: 4px 8px;
        border-radius: 50%;
        font-size: 14px;
        position: absolute;
        top: -5px;
        right: -12px;
        box-shadow: 0 0 10px rgba(255, 70, 85, 0.8);
        animation: pulseCart 1.5s infinite alternate;
    }

    /* Particle Effect on Hover */
    .nav-link:hover::after {
        content: "";
        position: absolute;
        width: 12px;
        height: 12px;
        background: rgba(255, 70, 85, 0.9);
        border-radius: 50%;
        animation: particles 0.6s linear infinite;
    }

    /* Special Agent-Inspired Hover Animation */
    @keyframes particles {
        0% {
            transform: translateY(0) scale(1);
            opacity: 1;
        }
        100% {
            transform: translateY(-20px) scale(0.5);
            opacity: 0;
        }
    }

    /* Pulse glow effect */
    @keyframes pulseGlow {
        0% {
            text-shadow: 0 0 10px #FF4655, 0 0 20px #FF4655;
        }
        100% {
            text-shadow: 0 0 20px #8A2BE2, 0 0 40px #FF4655;
        }
    }

    /* Flicker effect for hover */
    @keyframes flicker {
        0% {
            opacity: 1;
        }
        100% {
            opacity: 0.8;
        }
    }

    /* Pulse effect for cart */
    @keyframes pulseCart {
        0% {
            transform: scale(1);
        }
        100% {
            transform: scale(1.1);
        }
    }

    /* Responsive Design */
    @media screen and (max-width: 768px) {
        ul {
            flex-direction: column;
            text-align: center;
        }

        li {
            margin: 10px 0;
        }
    }
</style>

<?php

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