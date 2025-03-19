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
    <div class="modal-container">
        <button class="exit-btn" onclick="toggleCart(<?php echo $product_id; ?>)">×</button>
        <h2>Please log in to add items to your cart.</h2>
        <a href="index.php?page=login" style="padding:20px;text-decoration:none;color:white;background: rgb(0, 217, 255); border-radius:20px;">Log in</a>
    </div>
    <?php endif; ?>
</div>

<? include "image/modal.php"; ?>

<style>
/* Modal container for centralizing content */
.modal-container {
    background-color: #fff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
    position: relative;
    max-width: 1200px;
    width: 100%;
    display: flex;  
    height: auto;
    flex-direction: column;
    align-items: center;
    gap: 20px;
}

/* Modal content - Flex row layout */
.modal-content {
    display: flex;
    justify-content: space-between;
    gap: 20px;
    width: 100%;
    max-width: 1000px;
    background-color:rgb(73, 82, 91);
    border-radius: 12px;
    padding: 20px;
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
}

/* Right side - Product name, details, and price */
.modal-right {
    flex: 2;
    min-width: 300px;
    display: flex;
    flex-direction: column;
    gap: 15px;
}

/* Product name */
.product-name {
    background: rgba(255, 255, 255, 0.9);
    border-radius: 16px;
    padding: 10px;
    text-align: center;
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
}

/* Product details with fixed height and scroll */
.product-details {
    overflow-y: auto;
    max-height: 150px;
    padding: 10px;
    background-color: #f8f9fa;
    border: 1px solid #ddd;
    border-radius: 8px;
}

/* Product price section */
.product-price {
    display: flex;
    flex-direction: column;
    background-color: #3d3a38;
    border-radius: 8px;
    padding: 10px;
    color: white;
}

/* Price text */
.product-price .price {
    display: inline-block;
    text-align: center;
    font-size: 1.1em;
    font-weight: bold;
    background-color: rgb(14, 153, 9); /* Updated background color */
    padding: 5px 10px;
    border-radius: 10px;
    width: auto; /* Ensures width is based on content */
    margin-top: 10px;
}

.product-price .total-price {
    display: inline-block;
    text-align: center;
    color:black;
    font-size: 1.1em;
    font-weight: bold;
    background-color: rgb(255, 255, 255); /* Updated background color */
    padding: 5px 10px;
    border-radius: 10px;
    width: auto; /* Ensures width is based on content */
    margin-top: 10px;
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
    border: 1px solid #ccc;
    border-radius: 5px;
    padding: 5px;
}

/* Buttons */
.product-price .b-btn, .product-price .a-btn {
    padding: 10px 30px;
    border: none;
    margin:10px;
    border-radius: 5px;
    cursor: pointer;
    transition: transform 0.3s;
}
.product-price .b-btn {
    background-color:rgb(74, 95, 199);
    color: white;
}
.product-price .a-btn {
    background-color:rgb(219, 255, 12);
    color: black;
}
.product-price button {
    background-color: #008CBA;
    color: white;
    padding: 10px 30px;
    border: none;
    margin:10px;
    border-radius: 5px;
    cursor: pointer;
    transition: transform 0.3s;
}

.product-price button:hover, .product-price .a-btn:hover , .product-price .b-btn:hover {
    opacity: 0.8;
    transform: scale(1.05);
}

/* Exit button */
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
}

.exit-btn:hover {
    background-color: #e60000;
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
