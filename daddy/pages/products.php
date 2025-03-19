<style>
/* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
}

/* Container */
.container {
    width: 90%;
    margin: 50px auto;
}

/* Categories Menu */
.nav-menu {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: #008CBA;
    padding: 10px 20px;
    border-radius: 10px;
    margin-bottom: 20px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.nav-menu h3 {
    color: white;
    margin: 0;
    font-size: 1.2em;
}

.nav-menu ul {
    list-style: none;
    display: flex;
    gap: 15px;
}

.nav-menu ul li {
    display: inline;
}

.nav-menu ul li a {
    text-decoration: none;
    color: white;
    padding: 8px 12px;
    background: #006F9A;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.nav-menu ul li a:hover {
    background: #00bfff;
}

/* Success & Error Message Styles */
.alert-container {
    margin-top: 20px;
    margin-bottom: 20px;
    text-align: center;
}

.alert {
    padding: 12px 20px;
    border-radius: 8px;
    font-size: 1.1em;
    margin-bottom: 10px;
    width: 100%;
    max-width: 600px;
    margin: 0 auto;
}

/* Success Message */
.alert-success {
    background-color: #d4edda;
    color: #155724;
    border: 1px solid #c3e6cb;
}

/* Error Message */
.alert-error {
    background-color: #f8d7da;
    color: #721c24;
    border: 1px solid #f5c6cb;
}

/* Products Grid - KEEPING 3-COLUMN LAYOUT */
.products-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* Locked to 3 columns */
    gap: 20px;
    margin-top: 20px;
}

/* Product Card Styling */
.product-card {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    transition: transform 0.2s ease;
}

.product-card:hover {
    transform: scale(1.03);
}

/* Product Image */
.product-card img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin-bottom: 15px;
}

/* Product Name and Price */
.product-card h3 {
    font-size: 1.5em;
    margin: 10px 0;
    color: #333;
}

.product-card p {
    font-size: 1.1em;
    color: #777;
}

/* Price */
.product-card .price {
    font-size: 1.2em;
    color: #4CAF50;
    font-weight: bold;
    margin-top: 10px;
}

/* Stock Availability */
.product-card .stocks {
    font-size: 1em;
    color: #333;
    margin-top: 10px;
    font-weight: bold;
}

/* Action Buttons */
.product-card .action-buttons {
    margin-top: 15px;
}

.product-card .action-buttons a,
.product-card .action-buttons button {
    padding: 8px 15px;
    background-color: #4CAF50;
    color: white;
    text-decoration: none;
    border-radius: 5px;
    margin: 5px;
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
}

.product-card .action-buttons a:hover,
.product-card .action-buttons button:hover {
    background-color: #45a049;
    transform: scale(1.05);
}

/* Delete Button */
.product-card .action-buttons a.delete {
    background-color: #f44336;
}

.product-card .action-buttons .out-of-stock {
    background: #f44336;
    cursor: not-allowed;
}

/* Responsive Design */
@media (max-width: 768px) {
    .products-grid {
        grid-template-columns: repeat(2, 1fr); /* 2 columns for smaller screens */
    }

    .nav-menu {
        flex-direction: column;
        gap: 10px;
    }

    .nav-menu ul {
        flex-direction: column;
        width: 100%;
        text-align: center;
    }

    .nav-menu ul li a {
        display: block;
        width: 100%;
    }
}

@media (max-width: 480px) {
    .products-grid {
        grid-template-columns: 1fr; /* 1 column for mobile */
    }
}
/* Fix Modal */
</style>
   <?php
    require_once "backend/database_connect.php";  // Include the Database connection class
    $db = new Database();  // Instantiate the Database class

    if (isset($_GET['category'])) {
        $category = $_GET['category']; // Get the category from URL
        
        // Check the category and prepare the appropriate SQL query
        if ($category == "all") {
            $sql = "SELECT * FROM products";
            $stmt = $db->prepare($sql); // No need to bind parameters here
        } elseif ($category == "Storage Units") {
            $sql = "SELECT * FROM products WHERE category = ?";
            $stmt = $db->prepare($sql);
            $stmt->bind_param("s", $category); // Bind the category as a string parameter
        } elseif ($category == "Surface Furniture") {
            $sql = "SELECT * FROM products WHERE category = ?";
            $stmt = $db->prepare($sql);
            $stmt->bind_param("s", $category); // Bind the category as a string parameter
        } elseif ($category == "Lounge") {
            $sql = "SELECT * FROM products WHERE category = ?";
            $stmt = $db->prepare($sql);
            $stmt->bind_param("s", $category); // Bind the category as a string parameter
        } else {
            $sql = "SELECT * FROM products";
            $stmt = $db->prepare($sql); // Default to all products if category is unknown
        }
    } else {
        // Default query if 'category' is not set
        $sql = "SELECT * FROM products";
        $stmt = $db->prepare($sql);
    }

    // Execute the query
    $stmt->execute();
    $result = $stmt->get_result();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product List</title>
    </head>
    <body>

    <div class="container">
    <div class="nav-menu">
    <h3>Categories</h3>
    <ul>
        <li><a href="index.php?page=products&category=all">All</a></li>
        <li><a href="index.php?page=products&category=Surface Furniture">Surface Furniture</a></li>
        <li><a href="index.php?page=products&category=Lounge">Lounge</a></li>
        <li><a href="index.php?page=products&category=Storage Units">Storage Units</a></li>
    </ul>
</div>


    <div class="alert-container">
            <?php if (isset($_SESSION['error_message'])): ?>
                <div class="alert alert-error">
                    <?php echo $_SESSION['error_message']; unset($_SESSION['error_message']); ?>
                </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['success_message'])): ?>
                <div class="alert alert-success">
                    <?php echo $_SESSION['success_message']; unset($_SESSION['success_message']); ?>
                    <a href="index.php?page=purchase" style="text-decoration:underline;color:blue;">Check Orders</a>
                </div>
            <?php endif; ?>
    </div>




    <?php include "add_a_product.php" ?>

        <div class="products-grid">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $product_id = $row['product_id'];
                    $product_name = $row['product_name'];
                    $price = $row['price'];
                    $details = $row['details'];
                    $image_data = $row['image_data'];
                    $stocks = $row['stocks'];
                    

                    $image_base64 = base64_encode($image_data);
                    $image_src = 'data:image/jpeg;base64,' . $image_base64;
                    ?>
                    <div class="product-card">
                        <div class="clickable-image" onclick="customOpenModal('<?php echo $image_src; ?>')">
                            <img src="<?php echo $image_src; ?>" alt="<?php echo $product_name; ?>">
                        </div>
                        <p><?php echo $product_name; ?></p>
                        <div class="price">$<?php echo number_format($price, 2); ?></div>
                        <div class="stocks">Available stock: <?php echo $stocks; ?></div>


        <div class="action-buttons">  
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                        <a href="pages/backend/edit_product.php?product_id=<?php echo $product_id; ?>">Edit</a>
                        <a href="pages/backend/delete_product.php?product_id=<?php echo $product_id; ?>" class="delete" onclick="return confirm('Are you sure you want to delete this product?');">Delete</a>
                    <?php else: ?>
                        <?php if ($stocks > 0): ?>
                                    <button onclick="toggleCart(<?php echo $product_id; ?>)">Add to Cart</button>
                        <?php else: ?>
                            <button class="out-of-stock" type="button" onclick="uniqueOpenModal()">Out of Stock</button>

                        <?php endif; ?>

                    <?php endif; ?>
                        </div>
                    </div>

                    <?php include "modal/image-modal.php" ?>
                    <?php include "modal/form-modal.php" ?>
                    <?php include "modal/out-stock.php" ?>
                    <?php
                }
            } else {
                echo "<p>No products found.</p>";
            }
            ?>
        </div>
    </div>


    </body>
    </html>

    <?php
    $db->close();
    ?>

