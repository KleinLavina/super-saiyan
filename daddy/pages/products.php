<style>

/* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.container {
    width: 90%;
    margin: 50px auto;
}

/* Grid layout for product cards */
.products-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr); /* 3 columns */
    gap: 20px;
    margin-top: 20px;
}

/* Product card styling */
.product-card {
    background-color: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

/* Product card hover effect */
.product-card:hover {
    opacity: 0.8;
    transition: scale(1.1) 0.2s ease-in-out;
}

/* Product image in the card */
.product-card img {
    max-width: 100%;
    height: auto;
    border-radius: 8px;
    margin-bottom: 15px;
}
.product-card .stocks {
    font-size: 1em;
    color: #333;
    margin-top: 10px;
    font-weight: bold;
}


/* Product name and description in the card */
.product-card h3 {
    font-size: 1.5em;
    margin: 10px 0;
}

.product-card p {
    font-size: 1.1em;
    color: #777;
}

/* Price section in the product card */
.product-card .price {
    font-size: 1.2em;
    color: #4CAF50;
    font-weight: bold;
    margin-top: 10px;
}

/* Action buttons for Edit, Delete, and Add to Cart */
.product-card .action-buttons {
    margin-top: 15px;
}

.product-card .action-buttons a:hover {
    opacity: 0.8;
    transform: scale(1.2); /* Increases size by 10% */
}

.product-card .action-buttons a {
    padding: 8px 15px;
    transition: transform 0.3s ease, opacity 0.3s ease; /* Smooth transition for transform and opacity */
    background-color: #4CAF50;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
    margin: 5px;
}

.product-card .action-buttons a.delete {
    background-color: #f44336; /* Red for delete */
}

.product-card .action-buttons button {
    padding: 8px 15px;
    background-color: #008CBA;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}
.product-card .action-buttons .out-of-stock {
    background: #f44336; /* Red */
    cursor: not-allowed;
}


.product-card .action-buttons button:hover {
    opacity: 0.8;
}

/* Responsive Design for smaller screens */
@media (max-width: 768px) {
    .products-grid {
        grid-template-columns: repeat(2, 1fr); /* 2 columns on smaller screens */
    }

    .product-name p {
        font-size: 1em; /* Adjust font size for smaller screens */
    }
}

@media (max-width: 480px) {
    .products-grid {
        grid-template-columns: 1fr; /* 1 column on very small screens */
    }
}
.nav-menu {
    display: flex;
    justify-content: center; /* Centers the nav horizontally */
    align-items: center; /* Centers items vertically */
    width: 100%; /* Ensures it spans the full width */
    margin: 20px 0;
    background: rgb(0, 217, 255);
    padding: 10px;
    border-radius: 15px; /* Adds some space above and below */
}
.nav-menu ul {
    list-style: none;
    display: flex;
    flex-direction: row;
    gap: 15px; /* Space between items */
    padding: 0;
    margin: 0;
}

.nav-menu ul li {
    display: inline;
}

.nav-menu ul li a {
    text-decoration: none;
    color: black;
    font-weight: bold;
    padding: 8px 12px;
    border-radius: 5px;
    transition: background 0.3s;
}

.nav-menu ul li a:hover {
    background: #008CBA;
    color: white;
}

/* Responsive Design */
@media (max-width: 600px) {
    .nav-menu ul {
        flex-direction: column;
        text-align: center;
    }
}

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
        <h3 style="margin:0 20px; color: white; background: #008CBA; padding:5px; border-radius:20px;">Categories</h3>
            <ul>
                <li><a href="index.php?page=products&category=all">All</a></li>
                <li><a href="index.php?page=products&category=Surface Furniture">Surface Furniture</a></li>
                <li><a href="index.php?page=products&category=Lounge">Lounge</a></li>
                <li><a href="index.php?page=products&category=Storage Units">Storage Units</a></li>
            </ul>

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
                        <div class="clickable-image" onclick="openModal('<?php echo $image_src; ?>')">
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
                                <button class="out-of-stock" onclick="showOutOfStockModal()">Out of Stock</button>
                        <?php endif; ?>

                    <?php endif; ?>
                        </div>
                    </div>

                    <?php include "modal/image-modal.php" ?>
                    <?php include "modal/form-modal.php" ?>
                    <?php
                }
            } else {
                echo "<p>No products found.</p>";
            }
            ?>
        </div>
    </div>

    <!-- Out of Stock Modal -->
    <div id="outOfStockModal" class="modal">
        <div class="modal-content">
            <span class="close" id="close-btn" onclick="closeOutOfStockModal()">&times;</span>
            <p>Sorry, this product is currently out of stock.</p>
        </div>
    </div>

    <script>
    function showOutOfStockModal() {
        document.getElementById("outOfStockModal").style.display = "flex";
        document.getElementById("outOfStockModal").style.cursor = "pointer";
    }

    function closeOutOfStockModal() {
        document.getElementById("outOfStockModal").style.display = "none";
    }
    </script>

    </body>
    </html>

    <?php
    $db->close();
    ?>

