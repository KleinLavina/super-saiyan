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
        background-color: #f4f4f9;
        color: #333;
    }

    /* Container */
    .container {
        max-width: 800px;
        margin: 30px auto;
        padding: 20px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    /* Header */
    .header h1 {
        font-size: 1.8rem;
        text-align: center;
        color: #444;
        margin-bottom: 20px;
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
    }

    label {
        font-weight: bold;
        margin-bottom: 5px;
        font-size: 0.9rem;
    }

    input, select, textarea {
        font-size: 1rem;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        background-color: #fdfdfd;
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
        background-color: #007bff;
        border: none;
        border-radius: 4px;
        padding: 10px 15px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-submit:hover {
        background-color: #0056b3;
    }

    /* Current Image Section */
    .current-image {
        margin-top: 10px;
    }

    .current-image img {
        max-width: 100%;
        height: auto;
        border-radius: 4px;
        border: 1px solid #ddd;
        margin-top: 5px;
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
            padding: 8px;
        }
    }
    /* Flexbox for Form Row */
    /* Flexbox for Three Fields in One Row */
    .form-row {
        display: flex;
        gap: 20px;
        justify-content: space-between; 
        margin-bottom: 20px; /* Space between fields */
    }

    .form-row .form-group {
        width: 30%; /* Make fields take equal width */
        min-width: 150px; /* Ensure fields do not shrink too much */
    }

    label {
        margin-bottom: 5px;
        display: block;
    }

    input, select {
        width: 100%; /* Ensure inputs and select fill the container */
    }



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
                            <option value="Storage Units" <?= $product['category'] === 'Storage Units' ? 'selected' : '' ?>>
                                Storage Units
                            </option>
                            <option value="Surface Furniture"
                                <?= $product['category'] === 'Surface Furniture' ? 'selected' : '' ?>>Surface Furniture
                            </option>
                            <option value="Lounge" <?= $product['category'] === 'Lounge' ? 'selected' : '' ?>>Lounge
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
