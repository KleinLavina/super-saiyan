<!-- Custom Modal Structure -->
<div id="custom-image-modal" class="custom-modal" onclick="checkOutsideClick(event)">
    <div class="custom-modal-content" id="custom-modal-content">
        <div class="custom-modal-body">
            <div class="custom-modal-image-container">
                <img id="custom-modal-image" src="" alt="">
            </div>
        </div>
    </div>
    <!-- Exit message -->
    <div class="custom-exit-message">Click anywhere outside to exit.</div>
</div>

<style>
/* Modal Styles */
.custom-modal {
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
.custom-modal-content {
    background-color: rgba(167, 167, 167, 0.9);
    padding: 20px;
    border-radius: 8px;
    width: 90vh;
    max-width: 800px;
    display: flex;
    justify-content: center;
    align-items: center;
    position: relative;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
}

/* Close Button */
.custom-close-btn {
    font-size: 50px;
    color: #aaa;
    cursor: pointer;
    position: absolute;
    top: 10px;
    right: 20px;
    transition: color 0.3s ease-in-out;
}

.custom-close-btn:hover,
.custom-close-btn:focus {
    color: black;
    text-decoration: none;
}

/* Modal Body */
.custom-modal-body {
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Modal Image Container */
.custom-modal-image-container img {
    width: 100%;
    max-width: 1000px;
    height: 80vh;
    border-radius: 8px;
}

/* Exit Message */
.custom-exit-message {
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
    .custom-modal-content {
        width: 90%;
        padding: 15px;
    }

    .custom-modal-image-container img {
        height: auto;
        max-height: 70vh;
    }

    .custom-close-btn {
        font-size: 35px;
    }

    .custom-exit-message {
        font-size: 14px;
    }
}
</style>

<script>
// Open Modal Function
function customOpenModal(imageSrc) {
    // Set modal image source to the clicked image's source
    document.getElementById('custom-modal-image').src = imageSrc;

    // Display the modal
    document.getElementById('custom-image-modal').style.display = "flex";
}

// Close Modal Function
function customCloseModal() {
    // Hide the modal
    document.getElementById('custom-image-modal').style.display = "none";
}

// Check for Outside Click to Close
function checkOutsideClick(event) {
    const modalContent = document.getElementById('custom-modal-content');

    // Close modal if clicked outside the modal content
    if (!modalContent.contains(event.target)) {
        customCloseModal();
    }
}
</script>
