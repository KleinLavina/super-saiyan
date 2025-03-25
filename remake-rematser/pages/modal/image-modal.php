<!-- Custom Modal Structure -->
<div id="custom-image-modal-<?php echo $product_id; ?>" class="custom-modal" onclick="checkOutsideClick(event, <?php echo $product_id; ?>)">
    <div class="custom-modal-content" id="custom-modal-content-<?php echo $product_id; ?>">
        <!-- Image Container -->
      
        <div class="modal-left">
            <div class="custom-modal-image-container">
                <img id="custom-modal-image-<?php echo $product_id; ?>" src="" alt="">
            </div>
        </div>

        <!-- Details Container -->
        <div class="modal-right">
            <div class="custom-modal-details">
                <h3>Product Details</h3>
                <p><?php echo $details; ?></p>
            </div>
        </div>

    </div>
    <div class="custom-exit-message">Click anywhere outside to exit.</div>
</div>
<style>
/* Modal Styles */
.custom-modal {
    display: none;
    position: fixed;
    z-index: 9999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    justify-content: center;
    align-items: center;
}

/* Updated Modal Content */
.custom-modal-content {
    background-color: rgba(167, 167, 167, 0.9);
    padding: 20px;
    border-radius: 8px;
    width: 90vw; /* Use more width */
    max-width: 900px;
    display: flex;
    justify-content: space-between;
    align-items: flex-start; /* Align to top */
    position: relative;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    gap: 15px; /* Space between image and details */
}

/* Updated Image Container */
.custom-modal-image-container {
    flex: 3; /* Take 3/4 of the space */
    display: flex;
    justify-content: center;
    align-items: center;
}

.custom-modal-image-container img {
    width: 100%;
    max-width: 600px;
    height: 60vh; /* Bigger height */
    object-fit: contain;
    border-radius: 8px;
}

/* Details Section with Reduced Width */
.custom-modal-details {
    flex: 1; /* Take 1/4 of the space */
    height: 60vh; /* Fixed height */
    overflow-y: auto; /* Enable scroll if content overflows */
    background-color: #fff;
    color: #333;
    padding: 10px;
    border-radius: 8px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    font-size: 14px;
}

/* Exit Message at Bottom */
.custom-exit-message {
    margin-top: 10px;
    font-size: 16px;
    color: #f2f2f2;
    text-align: center;
    background: rgba(0, 0, 0, 0.6);
    padding: 10px 20px;
    border-radius: 8px;
    position: absolute;
    bottom: 10px; /* Stick to bottom */
    left: 50%;
    transform: translateX(-50%);
    width: auto;
    white-space: nowrap;
}

/* Responsive Design */
@media (max-width: 768px) {
    .custom-modal-content {
        flex-direction: column;
        align-items: center;
    }

    .custom-modal-image-container,
    .custom-modal-details {
        width: 100%;
        height: auto;
    }
}


</style>

<script>
function customOpenModal(imageSrc, productId) {
    // Set modal image source to the clicked image's source
    document.getElementById('custom-modal-image-' + productId).src = imageSrc;

    // Display the correct modal based on productId
    document.getElementById('custom-image-modal-' + productId).style.display = "flex";
}

// Check for Outside Click to Close
function checkOutsideClick(event, productId) {
    const modalContent = document.getElementById('custom-modal-content-' + productId);
    if (!modalContent.contains(event.target)) {
        customCloseModal(productId);
    }
}

// Close Modal Function
function customCloseModal(productId) {
    document.getElementById('custom-image-modal-' + productId).style.display = "none";
}

</script>
