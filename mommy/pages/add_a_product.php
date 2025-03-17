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
            width: 600px;  /* Set the width of the form */
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
        }

        .product-info div {
            width: 48%; /* Adjust the width of product name and price inputs */
        }

        /* Optional: Set placeholder color and styling */
        ::placeholder {
            color: #888;
            font-style: italic;
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
                
                <div class="product-info">
                    <div>
                        <label for="product_name">Item Name:</label>
                        <input type="text" name="product_name" id="product_name" placeholder="Enter product name" required>
                    </div>
                    <div>
                        <label for="price">Price:</label>
                        <input type="number" name="price" id="price" placeholder="e.g. $XX.XX" step="0.01" required>
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
