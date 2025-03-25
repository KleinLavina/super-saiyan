<style>
/* General Styles */
.h3 {
    background: linear-gradient(90deg, #B5E61D, #F7D716); /* Lime Green to Vivid Yellow */
    box-shadow: 0 0 15px rgba(183, 230, 29, 0.9); /* Green glow */
}

/* Label Styles */
label {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
    font-size: 15px;
    color: #B5E61D; /* Lime green for labels */
}

/* Input, Textarea, and File Upload Styles */
input[type="text"],
input[type="number"],
textarea,
input[type="file"],
select {
    width: 100%;
    padding: 10px;
    margin: 8px 0;
    border-radius: 8px;
    background-color: #0F1B0E; /* Dark greenish-black */
    color: #E8F5E9;
    border: 1px solid #B5E61D; /* Lime green border */
    transition: all 0.3s ease-in-out;
}

/* Hover Effect for Inputs */
input[type="text"]:focus,
input[type="number"]:focus,
textarea:focus,
input[type="file"]:focus,
select:focus {
    outline: none;
    border-color: #F7D716; /* Bright Yellow Glow */
    box-shadow: 0 0 10px rgba(247, 215, 22, 0.8);
}

/* Textarea Styling */
textarea {
    resize: vertical;
    height: 100px;
}

/* Submit Button Styling */
input[type="submit"] {
    padding: 12px 20px;
    background: linear-gradient(90deg, #B5E61D, #F7D716);
    color: #0F1B0E;
    border: none;
    cursor: pointer;
    border-radius: 8px;
    margin-top: 10px;
    font-weight: bold;
    transition: all 0.3s ease-in-out;
}

input[type="submit"]:hover {
    background: linear-gradient(90deg, #F7D716, #B5E61D);
    box-shadow: 0 0 15px rgba(247, 215, 22, 0.9);
    transform: scale(1.05);
}

/* Form Container for Dark Mode */
.form-container {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.85);
    z-index: 9999;
    justify-content: center;
    align-items: center;
}

/* Form Inner Container */
.form-container .container {
    background-color: #0F1B0E;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0px 0px 20px rgba(247, 215, 22, 0.9);
    position: relative;
    min-width: 320px;
    max-width: 700px;
    height: auto;
}

/* Add and Exit Button Styles */
.show-form-btn, .exit-btn {
    padding: 12px 20px;
    background: #B5E61D;
    color: #0F1B0E;
    border: none;
    font-style:italic;
    cursor: pointer;
    border-radius: 10px 0 10px 0;
    display: block;
    margin: 10px auto;
    transition: background-color 0.3s ease;
}

.show-form-btn:hover, .exit-btn:hover {
    background: #F7D716;
}

/* Exit Button Positioning */
.exit-btn {
    position: absolute;
    top: 10px;
    right: 10px;
    background-color: #F7D716;
    box-shadow: 0 0 10px rgba(247, 215, 22, 0.8);
}

/* Product Info Flex Layout */
.product-info {
    display: flex;
    justify-content: space-between;
    gap: 10px;
}

.product-info div {
    width: 32%;
}

/* Placeholder Styling */
::placeholder {
    color: #81C784; /* Soft green */
    font-style: italic;
}

/* Dropdown Custom Styling */
.product-info select {
    width: 100%;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #B5E61D;
    background-color: #0F1B0E;
    color: #E8F5E9;
    font-size: 15px;
    appearance: none;
    background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="gray"><path d="M7 10l5 5 5-5H7z"/></svg>');
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 16px;
}

/* Hover and Focus Effects for Dropdown */
.product-info select:hover {
    border-color: #F7D716;
}

.product-info select:focus {
    outline: none;
    box-shadow: 0 0 10px rgba(247, 215, 22, 0.8);
}

/* Style dropdown options */
.product-info select option {
    background-color: #0F1B0E;
    color: #E8F5E9;
    padding: 5px;
    font-size: 14px;
}

/* Mobile Responsive Design */
@media screen and (max-width: 768px) {
    .product-info {
        flex-direction: column;
        gap: 10px;
    }

    .product-info div {
        width: 100%;
    }

    .form-container .container {
        width: 90%;
        height: auto;
    }
}
</style>


</head>
<body>
<?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
    <button class="show-form-btn" onclick="toggleForm()"> + Add an Item</button>
    <?php endif; ?>

    <div class="form-container" id="form-container">
        <div class="container">
            <button class="exit-btn" onclick="toggleForm()">X</button>
            <h3 style="color: #fff">Add an Item</h3>
            <form action="pages/backend/upload.php" method="post" enctype="multipart/form-data">

            <label for="product_name">Item Name:</label>
            <input type="text" name="product_name" id="product_name" placeholder="Enter product name" required>
            
                <div class="product-info">
                    <div>
                        <label for="price">Price:</label>
                        <input type="number" name="price" id="price" placeholder="e.g. $XX.XX" step="0.01" required>
                    </div>
                    <div>
                    <label for="stocks">Stocks:</label>
                            <input type="number" name="stocks" id="stocks" placeholder="Add stock quantity" required>
                    </div>
                    <div>
                    <label for="category">Category:</label>
                        <select name="category" id="category" required>
                            <option value="Casual Jackets">
                                Casual Jackets
                            </option>
                            <option value="Performance Jackets">
                                Performance Jackets
                            </option>
                            <option value="Formal Jackets">
                                Formal Jackets
                            </option>
                        </select>
                    </div>
                </div>

                <label for="details">Details:</label>
                <textarea name="details" id="details" placeholder="Enter product details" required></textarea>

                <label for="file">Select a photo:</label>
                <input type="file" name="file" id="file" required>

                <input type="submit" name="submit" value="Upload Product">
            </form>
        </div>
    </div>

    <script>
        function toggleForm() {
            const formContainer = document.getElementById('form-container');
            formContainer.style.display = formContainer.style.display === 'flex' ? 'none' : 'flex';
        }
    </script>

</body>
