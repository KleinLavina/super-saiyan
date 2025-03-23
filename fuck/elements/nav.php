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
        die('MySQL prepare error: ' . $db->error);
    }

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
    header("Location: index.php");
    exit();
}
?>

<style>
    /* Valorant-Themed Navigation */
    nav {
        background: linear-gradient(to right, #0D0D0D, #1A1A1A);
        border-bottom: 4px solid rgb(227, 255, 70);
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
        background: linear-gradient(90deg, rgb(242, 255, 3) 22%, rgb(6, 176, 255) 50%, rgb(183, 224, 1) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    transform: skewX(-10deg); /* Slanted text effect */
    text-shadow: 0 0 10px rgba(243, 255, 70, 0.8); /* Glowing effect *//* Change text to white on hover */
        transform: scale(1.1);
        animation: flicker 0.5s infinite alternate;
        letter-spacing: 7px;
       }

    /* Glow Effect */
    .nav-link::before {
        content: "";
        position: absolute;
        bottom: -5px;
        left: 50%;
        width: 0;
        height: 3px;
        background-color: rgb(70, 255, 95);
        transition: width 0.3s ease, left 0.3s ease;
    }

    .nav-link:hover::before {
        width: 100%;
        left: 0;
    }

    /* Active link pulsing effect */
    .nav-link.active {
        color:rgb(237, 255, 70);
        border-bottom: 3px solid rgb(70, 255, 98);
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
        background: rgba(92, 255, 70, 0.9);
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
            text-shadow: 0 0 10px rgb(70, 218, 255), 0 0 20px rgb(86, 255, 70);
        }
        100% {
            text-shadow: 0 0 20px rgb(177, 226, 43), 0 0 40px rgb(243, 255, 70);
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

<nav>
    <ul>
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
