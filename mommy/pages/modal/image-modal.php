 <div id="image-modal" class="modal">
            <div class="modal-content">
                <span class="close-btn" onclick="closeModal()">&times;</span>
                <div class="modal-body">
                    <div class="modal-image-container">
                        <img id="modal-image" src="" alt="">
                    </div>
                </div>
            </div>
        </div>

        <style>
    /* Modal Styles */
.modal {
    display: none; /* Hidden by default */
    position: fixed;
    z-index: 99; /* Sit on top */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    background-color: rgba(0, 0, 0, 0.7); /* Black with opacity */
    justify-content: center;
    align-items: center;
}

.modal-content {
    background-color: rgba(167, 167, 167, 0.7);
    padding: 20px;
    border-radius: 8px;
    width: 90vh;
    max-width: 800px;
    display: flex;
    justify-content: center;
    align-items: center;
}

.close-btn {
    font-size: 50px;
    color: #aaa;
    cursor: pointer;
    position: absolute;
    top: 10px;
    right: 20px;
}

.close-btn:hover,
.close-btn:focus {
    color: black;
    text-decoration: none;
}

.modal-body {
    display: flex;
    justify-content: center;
    align-items: center;
}

.modal-image-container img {
    width: 100%;
    max-width: 1000px;
    height: 90vh;
    border-radius: 8px;
}

</style>
<script>

// Open Modal Function
function openModal(imageSrc) {
// Set modal image source to the clicked image's source
document.getElementById('modal-image').src = imageSrc;

// Display the modal
document.getElementById('image-modal').style.display = "flex";
}

// Close Modal Function
function closeModal() {
// Hide the modal
document.getElementById('image-modal').style.display = "none";
}

// Close modal when clicking outside the modal content
window.onclick = function(event) {
if (event.target == document.getElementById('image-modal')) {
    closeModal();
}
}
</script>