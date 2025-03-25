<div class="form-container" id="cart-form-container-<?php echo $product_id; ?>" style="display:none;">
    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 'true'): ?>
    <div class="modal-container">
        <button class="exit-btn" onclick="toggleCart(<?php echo $product_id; ?>)">×</button> <!-- Exit button -->
        <div class="modal-content">
            <!-- Left side - Product image -->
            <div class="modal-left">
                <div class="product-image">
                    <img src="<?php echo $image_src; ?>" alt="<?php echo $product_name; ?>" onclick="customOpenModal('<?php echo $image_src; ?>')">
                </div>
            </div>

            <!-- Right side - Product details and buy process -->
            <div class="modal-right">
                <div class="product-name">
                    <p><b>Name:</b> <?php echo $product_name; ?></p>
                </div>
                <div class="product-details">
                    <h3><b>About this Item:</b></h3>
                    <p><?php echo $details; ?></p>
                </div>

                <div class="product-price">
                    <div class="price">Price: $<?php echo number_format($price, 2); ?></div>

                    <div class="quantity-input">
                        <button class="quantity-btn" type="button" onclick="updateQuantity(-1, <?php echo $product_id; ?>, <?php echo $price; ?>)">-</button>
                        <input type="number" class="quantity-field" id="quantity-<?php echo $product_id; ?>" name="quantity" value="1" min="1" style="padding:8px;height:40px;">
                        <button class="quantity-btn" type="button" onclick="updateQuantity(1, <?php echo $product_id; ?>, <?php echo $price; ?>)">+</button>
                    </div>

                    <div class="total-price" id="total-price-<?php echo $product_id; ?>">Total Price: $<?php echo number_format($price, 2); ?></div>

                            <div style="display:flex;fkex-direction:row;justify-content:space-around;align-items:center;width:100%;">
                                    <form action="pages/backend/add_to_cart.php" method="POST">
                                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                        <input type="hidden" id="cart-quantity-<?php echo $product_id; ?>" name="quantity" value="1">
                                        <button type="submit" class="a-btn">Add to Cart</button>
                                    </form>

                                    <!-- Buy Item Form -->
                                    <form action="pages/backend/buy_item.php" method="POST">
                                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                        <input type="hidden" id="buy-quantity-<?php echo $product_id; ?>" name="quantity" value="1">
                                        <button type="submit" class="b-btn">Buy Item</button>
                                    </form>
                            </div>  
                    </div>
            </div>
        </div>
    </div>
    <?php else: ?>
        <div class="modalnot-container">
    <button class="exit-btn" onclick="toggleCart(<?php echo $product_id; ?>)">×</button>
    <h2 class="modal-title">Please log in to add items to your cart.</h2>
    <a href="index.php?page=login" class="login-btn">Log in</a>
</div>
    <?php endif; ?>
</div>

<? include "image/modal.php"; ?>

<style>
/* Modal container for centralizing content */
.modal-container {
    background-color: #121A0C; /* Dark Neon Background */
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 0 8px #64DD17; /* Reduced glow */
    position: relative;
    max-width: 1200px;
    width: 100%;
    display: flex;  
    height: auto;
    flex-direction: column;
    align-items: center;
    gap: 20px;
}
.modalnot-container {
    background-color: #121A0C; /* Dark Neon Background */
    padding: 30px;
    border-radius: 15px;
    box-shadow: 0 0 15px #FF4655, 0 0 25px #8A2BE2;
    position: relative;
    max-width: 500px;
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 20px;
    text-align: center;
    border: 2px solid #FF4655;
}

/* Exit Button - Cross with Valorant Red */
.exit-btn {
    position: absolute;
    top: 12px;
    right: 12px;
    background: #FF4655;
    color: white;
    border: none;
    font-size: 20px;
    cursor: pointer;
    border-radius: 50%;
    width: 35px;
    height: 35px;
    display: flex;
    justify-content: center;
    align-items: center;
    transition: background 0.3s ease, transform 0.2s ease;
}
.exit-btn:hover {
    background: #FF1744;
    transform: scale(1.1);
}

/* Modal Title - Valorant Vibes */
.modal-title {
    color: #E8E6E3;
    font-size: 22px;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    margin-top: 10px;
    text-shadow: 0 0 8px rgba(255, 70, 85, 0.8);
}

/* Login Button - Futuristic Design */
.login-btn {
    padding: 12px 25px;
    text-decoration: none;
    color: #121A0C;
    background: linear-gradient(135deg, #FF4655, #8A2BE2);
    border-radius: 25px;
    font-weight: bold;
    font-size: 16px;
    box-shadow: 0 0 10px #FF4655, 0 0 20px #8A2BE2;
    transition: background 0.3s ease, transform 0.2s ease;
}
.login-btn:hover {
    background: linear-gradient(135deg, #8A2BE2, #FF4655);
    transform: scale(1.1);
}

/* Modal Animation - Flicker on Load */
@keyframes flicker {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.8; }
}
.modal-container {
    animation: flicker 1.5s infinite alternate;
}

/* Modal content - Flex row layout */
.modal-content {
    display: flex;
    justify-content: space-between;
    gap: 20px;
    width: 100%;
    max-width: 1000px;
    background-color: #1C1F13; /* Darker Neon Area */
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 0 6px #76FF03; /* Softer Glow */
}
button{
    padding:10px;
    border:none;
    background-color:yellow;
    border-radius:10px;
}
/* Left side - Product image */
.modal-left {
    flex: 1;
    min-width: 250px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.product-image img {
    width: 100%;
    max-width: 300px;
    height: auto;
    border-radius: 8px;
    box-shadow: 0 0 6px #64DD17; /* Soft Glow */
    transition: transform 0.3s;
}

.product-image img:hover {
    transform: scale(1.05);
}

/* Right side - Product name, details, and price */
.modal-right {
    flex: 2;
    min-width: 300px;
    display: flex;
    flex-direction: column;
    gap: 15px;
}

/* Product name with neon glow */
.product-name {
    background: rgba(0, 0, 0, 0.8);
    border-radius: 16px;
    padding: 10px;
    text-align: center;
    color: #CCFF90;
    text-shadow: 0 0 6px #B2FF59; /* Reduced glow */
    box-shadow: 0 0 6px #76FF03;
}

/* Product details with fixed height and scroll */
.product-details {
    overflow-y: auto;
    max-height: 150px;
    padding: 10px;
    background-color: #1C1F13;
    border: 1px solid #76FF03;
    border-radius: 8px;
    color: #CCFF90;
}

/* Product price section with subtle glow */
.product-price {
    display: flex;
    flex-direction: column;
    background-color: #1C1F13;
    border-radius: 8px;
    padding: 10px;
    box-shadow: 0 0 5px #76FF03;
}

/* Price text */
.product-price .price, .product-price .total-price {
    text-align: center;
    font-size: 1.1em;
    font-weight: bold;
    background-color: #64DD17;
    color: #121A0C;
    padding: 5px 10px;
    border-radius: 10px;
    width: auto;
    margin-top: 10px;
    box-shadow: 0 0 5px #76FF03;
}

/* Quantity input layout */
.quantity-input {
    display: flex;
    justify-content: center;
    align-items: center;
    gap: 10px;
}

.quantity-input input {
    width: 50px;
    text-align: center;
    border: 1px solid #76FF03;
    border-radius: 5px;
    padding: 5px;
    background-color: #1C1F13;
    color: #CCFF90;
    box-shadow: 0 0 5px #64DD17;
}

/* Buttons */
.product-price .b-btn, .product-price .a-btn {
    padding: 10px 30px;
    border: none;
    margin: 10px;
    border-radius: 5px;
    cursor: pointer;
    transition: transform 0.3s;
    background-color: #76FF03;
    color: #121A0C;
    box-shadow: 0 0 6px #64DD17; /* Softer button glow */
}

.product-price .b-btn:hover, .product-price .a-btn:hover {
    background-color: #B2FF59;
    box-shadow: 0 0 10px #76FF03;
    transform: scale(1.05);
}

/* Exit button */
.exit-btn {
    position: absolute;
    top: 10px;
    right: 15px;
    background-color: #FF4655;
    color: white;
    border: none;
    padding: 10px;
    border-radius: 50%;
    font-size: 18px;
    cursor: pointer;
    box-shadow: 0 0 8px #FF4655; /* Softer Exit Glow */
}

.exit-btn:hover {
    background-color: #E60000;
    box-shadow: 0 0 10px #FF4655;
}

/* Responsive layout */
@media (max-width: 768px) {
    .modal-content {
        flex-direction: column;
        gap: 15px;
    }
    .modal-left, .modal-right {
        width: 100%;
    }
    .product-name {
        width: 100%;
    }
}

</style>


<script>
/* Update Quantity and Total Price */
function updateQuantity(change, productId, price) {
    let quantityInput = document.getElementById("quantity-" + productId);
    let totalPriceElement = document.getElementById("total-price-" + productId);
    let cartQuantityInput = document.getElementById("cart-quantity-" + productId);
    let buyQuantityInput = document.getElementById("buy-quantity-" + productId);

    let currentValue = parseInt(quantityInput.value);
    let newValue = currentValue + change;

    if (newValue < 1) {
        newValue = 1;
    }

    quantityInput.value = newValue;
    cartQuantityInput.value = newValue;
    buyQuantityInput.value = newValue;

    let totalPrice = (newValue * price).toFixed(2);
    totalPriceElement.innerText = `Total Price: $${totalPrice}`;
}

/* Toggle Cart Modal */
function toggleCart(productId) {
    const formContainer = document.getElementById("cart-form-container-" + productId);
    formContainer.style.display = formContainer.style.display === "flex" ? "none" : "flex";
}
</script>
