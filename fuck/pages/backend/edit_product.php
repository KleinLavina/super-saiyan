    <?php
    require "database_connect.php";  // Include the Database connection class
    $db = new Database();  // Instantiate the Database class

    // Check if product_id is provided in the URL
    if (isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];
        
        // Fetch product details from the database based on the product_id
        $sql = "SELECT * FROM products WHERE product_id = ?";
        $stmt = $db->connection->prepare($sql);
        $stmt->bind_param('i', $product_id);  // Bind the product_id to the SQL query
        $stmt->execute();
        $result = $stmt->get_result();
        
        // Check if product exists
        if ($result->num_rows > 0) {
            $product = $result->fetch_assoc();
        } else {
            echo "Product not found!";
            exit;
        }
    } else {
        echo "Product ID not specified!";
        exit;
    }

    ?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit Product</title>
        <!-- Link to external CSS or include a framework like Bootstrap -->
        <link rel="stylesheet" href="styles.css">
        <!-- Optional: Link to a font from Google Fonts -->
    </head>

        <style>
    /* General Styles */
    body {
        font-family: 'Roboto', sans-serif;
        margin: 0;
        padding: 0;
        background-color: #0D0D0D; /* Dark Valorant BG */
        color: #fff;
    }

    /* Container */
    .container {
        max-width: 800px;
        margin: 30px auto;
        padding: 20px;
        background: #1A1A1A; /* Darker Shade */
        border-radius: 12px;
        box-shadow: 0 0 20px rgba(255, 70, 85, 0.6); /* Red Glow */
        border: 2px solid #FF4655;
    }

    /* Header */
    .header h1 {
        font-size: 2rem;
        text-align: center;
        color: #FF4655; /* Valorant Red */
        text-shadow: 0 0 12px rgba(255, 70, 85, 0.8);
    }

    /* Form */
    .form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        position: relative;
    }

    label {
        font-weight: bold;
        margin-bottom: 5px;
        font-size: 0.9rem;
        color: #FF4655; /* Red Label */
        text-shadow: 0 0 8px rgba(255, 70, 85, 0.8);
    }

    input, select, textarea {
        font-size: 1rem;
        padding: 12px;
        border: 1px solid #FF4655;
        border-radius: 5px;
        background-color: #111;
        color: #fff;
        outline: none;
        transition: box-shadow 0.3s ease-in-out;
    }

    input:focus, select:focus, textarea:focus {
        box-shadow: 0 0 12px #FF4655;
        border-color: #FF4655;
    }

    textarea {
        resize: vertical;
        min-height: 100px;
    }

    input[type="file"] {
        border: none;
    }

    /* Button */
    .btn-submit {
        font-size: 1rem;
        font-weight: bold;
        color: #fff;
        background: linear-gradient(90deg, #FF4655, #8A2BE2);
        border: 1px solid #FF4655;
        border-radius: 4px;
        padding: 12px 20px;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .btn-submit:hover {
        background: #FF4655;
        box-shadow: 0 0 15px rgba(255, 70, 85, 0.8);
    }

    /* Current Image Section */
    .current-image {
        margin-top: 10px;
    }

    .current-image img {
        max-width: 100%;
        height: auto;
        border-radius: 4px;
        border: 2px solid #FF4655;
        box-shadow: 0 0 12px rgba(255, 70, 85, 0.6);
    }

    /* Flexbox for Form Row */
    .form-row {
        display: flex;
        gap: 20px;
        justify-content: space-between;
    }

    .form-row .form-group {
        width: 30%;
        min-width: 150px;
    }

    input, select {
        width: 100%;
    }

    /* Responsive Design */
    @media (max-width: 600px) {
        .container {
            padding: 15px;
        }

        .header h1 {
            font-size: 1.5rem;
        }

        .btn-submit {
            font-size: 0.9rem;
            padding: 10px;
        }

        .form-row {
            flex-direction: column;
        }

        .form-row .form-group {
            width: 100%;
        }
    }

    /* Custom Select Dropdown */
    select {
        appearance: none;
        background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" fill="white" viewBox="0 0 24 24" width="20" height="20"><path d="M7 10l5 5 5-5H7z"/></svg>') no-repeat right 10px center;
        background-size: 16px;
        background-color: #111;
        padding-right: 40px;
        cursor: pointer;
    }

    select option {
        background-color: #1A1A1A;
        color: #fff;
    }
</style>


    </style>
    <body>
        <div class="container">
            <header class="header">
                <h1>Edit Product</h1>
            </header>

            <main>
                <form action="update_product.php" method="post" enctype="multipart/form-data" class="form">
                    <input type="hidden" name="product_id" value="<?= htmlspecialchars($product['product_id']) ?>">

                    <div class="form-group">
                        <label for="product_name">Product Name:</label>
                        <input type="text" name="product_name" id="product_name" placeholder="Enter the product name"
                            value="<?= htmlspecialchars($product['product_name']) ?>" required>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="price">Price:</label>
                            <input type="number" name="price" id="price" placeholder="Enter price"
                                value="<?= htmlspecialchars($product['price']) ?>" step="0.01" required>
                        </div>

                        <div class="form-group">
                            <label for="stocks">Stocks: Current (<?= htmlspecialchars($product['stocks']) ?>)</label>
                            <input type="number" name="stocks" id="stocks" placeholder="Add stock quantity"
                            value="<?= htmlspecialchars($product['stocks']) ?>" required>
                        </div>

                    
                    <div class="form-group">
                        <label for="category">Category:</label>
                        <select name="category" id="category" required>
                            <option value="Performance Jackets" <?= $product['category'] === 'Performance Jackets' ? 'selected' : '' ?>>
                                Performance Jackets
                            </option>
                            <option value="Casual Jackets"
                                <?= $product['category'] === 'Casual Jackets' ? 'selected' : '' ?>>Casual Jackets
                            </option>
                            <option value="Formal Jackets" <?= $product['category'] === 'Formal Jackets' ? 'selected' : '' ?>>Formal Jackets
                            </option>
                        </select>
                    </div>
                    </div>



                    <div class="form-group">
                        <label for="details">Details:</label>
                        <textarea name="details" id="details" placeholder="Enter product details"
                            required><?= htmlspecialchars($product['details']) ?></textarea>
                    </div>


                    <div class="form-group">
                        <label for="file">Product Image:</label>
                        <input type="file" name="file" id="file">
                    </div>

                    <?php if (!empty($product['image_data'])): ?>
                        <div class="form-group current-image">
                            <p>Current Image:</p>
                            <img src="data:image/jpeg;base64,<?= base64_encode($product['image_data']) ?>" alt="Product Image">
                        </div>
                    <?php endif; ?>

                    <div class="form-group">
                        <button type="submit" class="btn-submit">Update Product</button>
                    </div>
                </form>
            </main>
        </div>
    </body>

    </html>
