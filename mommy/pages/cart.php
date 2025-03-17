<?php
require_once "backend/database_connect.php";

$db = new Database();

if (!isset($_SESSION['p_id'])) {
    die("User not logged in. Please log in first.");
}

$p_id = $_SESSION['p_id']; // Get logged-in user's ID

// Fetch all cart items for this user
$query = "SELECT cart.product_id, products.product_name, products.price, products.image_data, cart.quantity 
          FROM cart 
          JOIN products ON cart.product_id = products.product_id 
          WHERE cart.user_id = ?";
$stmt = $db->prepare($query);
$stmt->bind_param("i", $p_id);
$stmt->execute();
$result = $stmt->get_result();

$grand_total = 0;
?>

<style>
    .cart-container {
        display: grid;
        grid-template-columns: 2fr 2fr;
        gap: 20px;
        padding: 20px;
        background: #f8f8f8;
        border-radius: 10px;
    }

    .cart-item {
        display: flex;
        flex-direction: column;
        align-items: center;
        background: white;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .product-image {
        width: 100px;
        height: 100px;
        object-fit: cover;
        border-radius: 8px;
        cursor: pointer;
    }

    .cart-column {
        margin: 5px 0;
        font-size: 16px;
        font-weight: bold;
        text-align: center;
    }

    .quantity-input {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .quantity-btn {
        background-color: #007BFF;
        color: white;
        border: none;
        padding: 5px 10px;
        cursor: pointer;
        border-radius: 5px;
    }

    .quantity-field {
        width: 50px;
        text-align: center;
        font-size: 16px;
    }

    .cart-footer {
        grid-column: span 2;
        text-align: center;
        padding: 15px;
        font-size: 18px;
        font-weight: bold;
        background: #ddd;
        border-radius: 10px;
    }

    .cart-footer button {
        text-decoration: none;
        color: white;
        border:none;
        background-color:rgb(22, 122, 64);
        padding: 15px 20px;
        border-radius: 5px;
        display: inline-block;
        font-weight: bold;
        margin: 5px;
        cursor: pointer;
        transition: transform 0.3s ease;
    }
    .r-btn, .b-btn {
        text-decoration: none;
        color: white;
        border:none;
        padding: 10px 15px;
        border-radius: 5px;
        display: inline-block;
        font-weight: bold;
        margin: 5px;
        cursor: pointer;
        transition: transform 0.3s ease;
    }
    .r-btn:hover, .b-btn:hover, .a-btn:hover {
        transform: scale(1.1);
    }
    .r-btn{
        background-color: #dc3545;
    }
    .b-btn{
        background-color: #007BFF;
    }
</style>
<?php include "modal/image-modal.php"; ?>
<h2 style="text-align:center; margin: 20px;">Your Cart</h2>

<?php if ($result->num_rows > 0): ?>
    <div class="cart-container">
        <?php while ($row = $result->fetch_assoc()): 
            $total = $row['price'] * $row['quantity'];
            $grand_total += $total;
            $image_src = 'data:image/jpeg;base64,' . base64_encode($row['image_data']);
        ?>
            <div class="cart-item">
                <img src="<?= $image_src ?>" alt="<?= htmlspecialchars($row['product_name']) ?>" class="product-image" onclick="openModal('<?= $image_src ?>')">
                <div class="cart-column"><?= htmlspecialchars($row['product_name']) ?></div>
                <div class="cart-column">$<?= number_format($row['price'], 2) ?></div>
                <div class="cart-column">
                    <div class="quantity-input">
                        <button class="quantity-btn" type="button" onclick="updateQuantity(-1, <?= $row['product_id'] ?>, <?= $row['price'] ?>)">-</button>
                        <input type="number" class="quantity-field" id="quantity-<?= $row['product_id'] ?>" value="<?= $row['quantity'] ?>" min="1" readonly>
                        <button class="quantity-btn" type="button" onclick="updateQuantity(1, <?= $row['product_id'] ?>, <?= $row['price'] ?>)">+</button>
                    </div>
                </div>
                <div class="cart-column" id="total-price-<?= $row['product_id'] ?>">$<?= number_format($total, 2) ?></div>
                <div class="cart-column">
                <form action="pages/backend/checkout.php" method="post" style="display:inline;">
                    <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
                    <input type="hidden" id="buy-quantity-<?= $row['product_id'] ?>" name="quantity" value="<?= $row['quantity'] ?>">
                    <button type="submit" class="b-btn">Buy Now</button>
                </form>

                <form action="pages/backend/remove_from_cart.php" method="post" style="display:inline;">
                    <input type="hidden" name="product_id" value="<?= $row['product_id'] ?>">
                    <input type="hidden" id="buy-quantity-<?= $row['product_id'] ?>" name="quantity" value="<?= $row['quantity'] ?>">
                    <button type="submit" class="r-btn">Remove</button>
                </form>
                 </div>
            </div>
        <?php endwhile; ?>

        <div class="cart-footer">
            Grand Total: <b>$<?= number_format($grand_total, 2) ?></b>
            <form action="pages/backend/checkout.php" method="post">
                <input type="hidden" name="buy_all" value="true">
                <button type="submit" class="a-btn">Buy All</button>
            </form>
        </div>
    </div>
<?php else: ?>
<div style="display: flex; justify-content: center; height: 50vh;">
    <div style="text-align: center; padding: 20px; background-color: #e3f2fd; border: 2px solid #1e88e5; border-radius: 8px; color: #1e88e5; font-size: 18px; width: 40%; height:30vh;">
        <strong>Your cart is empty.</strong>  
            <div style="margin-top: 10px;">
                <a href="index.php?page=products" style="text-decoration: none; background-color: #1e88e5; color: white; padding: 10px 15px; border-radius: 5px; display: inline-block; font-weight: bold;">
                    Shop Now
                </a>
            </div>
    </div>
</div>

<?php endif; ?>

<script>
function updateQuantity(change, productId, price) {
    let quantityInput = document.getElementById("quantity-" + productId);
    let totalPriceElement = document.getElementById("total-price-" + productId);
    let buyQuantityInput = document.getElementById("buy-quantity-" + productId);

    let currentValue = parseInt(quantityInput.value);
    let newValue = currentValue + change;

    if (newValue < 1) newValue = 1; // Prevent negative quantity

    quantityInput.value = newValue;
    if (buyQuantityInput) buyQuantityInput.value = newValue;

    // Calculate new total price
    let totalPrice = (newValue * price).toFixed(2);
    
    // 🛠 Fix: Update the displayed total price correctly
    totalPriceElement.innerText = `$${totalPrice}`;

    // Update grand total
    updateGrandTotal();

    // Update quantity in database via AJAX
    updateQuantityInDB(productId, newValue);

}

function updateGrandTotal() {
    let totalElements = document.querySelectorAll("[id^='total-price-']");
    let grandTotal = 0;

    totalElements.forEach(element => {
        let priceText = element.innerText.replace("$", "").trim(); // 🛠 FIXED: Remove '$' before parsing
        grandTotal += parseFloat(priceText);
    });

    document.getElementById("grand-total").innerText = `$${grandTotal.toFixed(2)}`;
}

function updateQuantityInDB(productId, newQuantity) {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "pages/backend/update_cart.php", true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log("Cart updated successfully: " + xhr.responseText);
        }
    };
    xhr.send("product_id=" + productId + "&quantity=" + newQuantity);
}

</script>
