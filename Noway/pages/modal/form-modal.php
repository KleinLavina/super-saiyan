<div class="form-container" id="cart-form-container-<?php echo $product_id; ?>" style="display:none;">
    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == 'true'): ?>
    <div class="modal-container">
        <button class="exit-btn" onclick="toggleCart(<?php echo $product_id; ?>)">×</button> <!-- Exit button as an '×' symbol -->
        <div class="product-name">
            <p><b>Name:</b> <?php echo $product_name; ?></p>
        </div>
        <div class="modal-content">
            <div class="modal-left">
                <div class="product-image">
                    <div class="clickable-image" onclick="openModal('<?php echo $image_src; ?>')">
                        <img src="<?php echo $image_src; ?>" alt="<?php echo $product_name; ?>">
                    </div>
                </div>
            </div>
            <div class="modal-right">
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

    <!-- Add to Cart Form -->
    <form action="pages/backend/add_to_cart.php" method="POST">
        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
        <input type="hidden" id="cart-quantity-<?php echo $product_id; ?>" name="quantity" value="1">
        <button type="submit">Add to Cart</button>
    </form>

    <!-- Buy Item Form -->
    <form action="pages/backend/buy_item.php" method="POST">
        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
        <input type="hidden" id="buy-quantity-<?php echo $product_id; ?>" name="quantity" value="1">
        <button type="submit">Buy Item</button>
    </form>
</div>

            </div>
        </div>
    </div>
    <?php else: ?>
    <div class="modal-container">
    <button class="exit-btn" onclick="toggleCart(<?php echo $product_id; ?>)">×</button>
            <h2>Please log in to add items to your cart.</h2>
            <a href="index.php?page=login" style="padding:20px;text-decoration:none;color:white;background: rgb(0, 217, 255); border-radius:20px;">Log in</a> <!-- Assuming you have a login page -->
    </div>
    <?php endif; ?>
</div>

<style>
/* Ensure the modal covers the entire screen */
.form-container {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7);
    z-index: 50;
    justify-content: center;
    align-items: center;
    padding: 20px;
    box-sizing: border-box;
    overflow: auto;
}
.quantity-input{
    display: flex;
    flex-direction: row;
    justify-content: space-evenly;
    align-content: center;
    padding: 5px;
    background-color: #f2f2f2;
    border-radius: 10px;
}
.quantity-input input{
    width: 50px;
    text-align: center;
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 5px;
    height:auto;
    font-size: 1em;
}
/* Modal container for centralizing content */
.modal-container {
    background-color: #fff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
    position: relative;
    max-width: 1500px;
    width: 100%;
    display: flex;
    height:auto;
    flex-direction: column;
    align-items: center;
    gap: 20px;
    max-height: 90%; /* Prevent overflow */
}

/* Exit button styling */
.exit-btn {
    position: absolute;
    top: 10px;
    right: 15px;
    background-color: #ff4d4d;
    color: white;
    border: none;
    padding: 10px;
    border-radius: 50%;
    font-size: 18px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.exit-btn:hover {
    background-color: #e60000;
}

/* Modal content layout with left and right sections */
.modal-content {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    width: auto;
    max-width: 1200px;
    gap: 20px;
    height: auto;
}

/* Left side - Product image */
.modal-left {
    flex: 1;
    min-width: 250px;
}

.product-image img {
    width: auto;
    height: auto;
    max-height: 300px;
    border-radius: 8px;
    display:flex;
   align-self: center;
}

/* Right side - Product name, details, and price */
.modal-right {
    flex: 2;
    min-width: 250px;
    width:auto;
    max-height: 300px;
   
}

/* Product name */
.product-name {
    background: rgba(255, 255, 255, 0.3);
    border-radius: 16px;
    padding: 15px;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(6.9px);
    border: 1px solid rgba(255, 255, 255, 0.32);
    width: auto; /* Set full width by default */
    max-width: 1050px;
    height: auto; /* Limit max width for better alignment */
    text-align: center; /* Center align text */
    margin: 0 auto; /* Center the name in its container */
}

.product-name p {
    font-size: 1.1em;
    color: #333;
    margin: 0;
}

/* Product details */
.product-details {
    overflow-y: auto;
    max-height: 200px;
    padding: 10px;
    background-color: #008CBA;
    color: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.product-details h3 {
    font-size: 1.2em;
    margin-bottom: 10px;
}

.product-details p {
    font-size: 1em;
    line-height: 1.5;
}

/* Product price section */
.product-price {
    display: flex;
    flex-direction: row;
    justify-content: space-around;
    align-items: center;
    height:100px;
    background-color: #3d3a38;
    border-radius: 8px;
    color: white;
}

.product-price .price {
    font-size: 1.1em;
    font-weight: bold;
    color:rgb(255, 255, 255);
    padding: 5px;
    border-radius: 10px;
    background-color:rgb(3, 86, 0);
    margin-top: 10px;
}

/* Buttons styling */
.product-price button {
    background-color: #008CBA;
    color: white;
    padding: 8px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    margin-top: 10px;
    width: 100%;
    max-width: 200px;
}

.product-price button:hover {
    opacity: 0.8;
}

/* Responsive layout */
@media (max-width: 768px) {
    .modal-content {
        flex-direction: column;
        gap: 15px;
    }
    .modal-left, .modal-right {
        flex: 1;
    }

    .product-name {
        width: 80%; /* Allow for more flexible width on smaller screens */
        max-width: 350px; /* Adjust max-width for mobile devices */
    }
}
.modal-container a:hover{
    opacity: 0.8;
    transition: transform 0.3s;
    transform: scale(1.1);
}
</style>

<script>
function updateQuantity(change, productId, price) {
    let quantityInput = document.getElementById("quantity-" + productId);
    let totalPriceElement = document.getElementById("total-price-" + productId);
    let cartQuantityInput = document.getElementById("cart-quantity-" + productId);
    let buyQuantityInput = document.getElementById("buy-quantity-" + productId);

    if (!quantityInput || !totalPriceElement) {
        console.error("Elements not found for productId:", productId);
        return;
    }

    let currentValue = parseInt(quantityInput.value);
    let newValue = currentValue + change;

    if (newValue < 1) {
        newValue = 1; // Prevent negative quantity
    }

    quantityInput.value = newValue;

    // Update hidden form inputs
    if (cartQuantityInput) cartQuantityInput.value = newValue;
    if (buyQuantityInput) buyQuantityInput.value = newValue;

    // Update the total price dynamically
    let totalPrice = (newValue * price).toFixed(2);
    totalPriceElement.innerText = `Total Price: $${totalPrice}`;
}


function toggleCart(productId) {
    const formContainer = document.getElementById('cart-form-container-' + productId);

    // Toggle visibility of modal
    formContainer.style.display = formContainer.style.display === 'flex' ? 'none' : 'flex';
}

</script>
