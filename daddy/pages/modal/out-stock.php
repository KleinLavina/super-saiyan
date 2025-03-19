<!-- Unique Modal Structure -->
<div id="unique-message-modal" class="unique-modal" onclick="uniqueCheckOutsideClick(event)">
    <div class="unique-modal-content" id="unique-modal-content">
        <div class="unique-modal-body">
            <div class="unique-modal-image-container">
                <p style="font-size: 18px; color: #333; margin: 10px 0;">
                    😔 <strong>We're really sorry!</strong>
                </p>
                <p style="font-size: 16px; color: #555;">
                    Unfortunately, this product is currently out of stock. We’re working hard to restock it as soon as possible. 
                    Thank you for your patience and understanding. ❤️
                </p>
            </div>
        </div>
    </div>
    <!-- Exit message -->
    <div class="unique-exit-message">Click anywhere outside to exit.</div>
</div>

<style>
/* Modal Styles */
.unique-modal {
    display: none; /* Hidden by default */
    position: fixed;
    z-index: 9999; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    background-color: rgba(0, 0, 0, 0.7); /* Black with opacity */
    justify-content: center;
    align-items: center;
    flex-direction: column; /* Stack content vertically */
}

/* Modal Content */
.unique-modal-content {
    background-color: rgba(255, 255, 255, 0.95);
    padding: 25px;
    border-radius: 12px;
    width: 90vh;
    max-width: 500px;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

/* Modal Body */
.unique-modal-body {
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
    flex-direction: column;
}

/* Exit Message */
.unique-exit-message {
    margin-top: 10px;
    font-size: 16px;
    color: #f2f2f2;
    text-align: center;
    background: rgba(0, 0, 0, 0.6);
    padding: 10px 20px;
    border-radius: 8px;
}

/* Responsive Layout */
@media (max-width: 768px) {
    .unique-modal-content {
        width: 90%;
        padding: 15px;
    }

    .unique-exit-message {
        font-size: 14px;
    }
}
</style>

<script>
// Open Modal Function
function uniqueOpenModal() {
    // Show the modal
    document.getElementById('unique-message-modal').style.display = "flex";
}

// Close Modal Function
function uniqueCloseModal() {
    // Hide the modal
    document.getElementById('unique-message-modal').style.display = "none";
}

// Check for Outside Click to Close
function uniqueCheckOutsideClick(event) {
    const modalContent = document.getElementById('unique-modal-content');

    // Close modal if clicked outside the modal content
    if (!modalContent.contains(event.target)) {
        uniqueCloseModal();
    }
}
</script>

<!-- Example Button to Trigger Modal -->

