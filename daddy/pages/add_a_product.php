<style>

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 3px;
            font-size: 15px;
        }

        input[type="text"],
        input[type="number"],
        textarea,
        input[type="file"] {
            width: 100%;
            padding: 8px;
            margin: 8px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
        }

        textarea {
            resize: vertical;
            height: 80px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        /* Initially hide the form container */
        .form-container {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 9999; /* Makes sure it stays on top */
            justify-content: center;
            align-items: center;
        }

        .form-container .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
            position: relative;
            min-width: 300px;  /* Set the width of the form */
            max-width: 700px;  /* Set the width of the form */
            height: 90%;  /* Allow height to auto-adjust based on content */
        }

        /* Button Style */
        .show-form-btn, .exit-btn {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            display: block;
            margin: 10px auto;
        }

        .show-form-btn:hover, .exit-btn:hover {
            background-color: #45a049;
        }

        /* Exit button position */
        .exit-btn {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #f44336; /* Red for exit */
        }

        .exit-btn:hover {
            background-color: #e53935;
        }

        /* Style for product name and price on the same line */
        .product-info {
            display: flex;
            justify-content: space-between;
            gap: 10px; /* Adjust spacing between elements */
}

        .product-info div {
            width: 32%; /* Adjust width so all three elements fit in one row */
        }


        /* Optional: Set placeholder color and styling */
        ::placeholder {
            color: #888;
            font-style: italic;
        }
        /* Style the dropdown container */
.product-info select {
    width: 100%;
    padding: 8px;
    border-radius: 5px;
    border: 1px solid #ccc;
    background-color: #fff;
    font-size: 15px;
    cursor: pointer;
    appearance: none; /* Removes default browser styling */
    position: relative;
    background-image: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18" fill="gray"><path d="M7 10l5 5 5-5H7z"/></svg>'); /* Custom arrow */
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 16px;
}

/* Hover and focus effects */
.product-info select:hover {
    border-color: #4CAF50;
}

.product-info select:focus {
    outline: none;
    border-color: #45a049;
    box-shadow: 0 0 5px rgba(76, 175, 80, 0.5);
}

/* Style dropdown options */
.product-info select option {
    background-color: #fff;
    padding: 5px;
    font-size: 14px;
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
            <h3>Add an Item</h3>
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
                            <option value="Storage Units">
                                Storage Units
                            </option>
                            <option value="Surface Furniture">
                                Surface Furniture
                            </option>
                            <option value="Lounge">
                                Lounge
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
