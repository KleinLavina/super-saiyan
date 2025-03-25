<style>
/* General Reset */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}


body{
    background: rgb(0, 0, 0);
    font-style:italic;
}
/* Container */
.container {
    width: 90%;
    margin: 50px auto;
}


/* Categories Menu */
.nav-menu {
    width: auto;
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-style:italic;
    background:rgb(0, 0, 0);
    border-top: 4px solid yellow;
    border-bottom: 4px solid green;
    padding: 10px 10px;
    border-radius: 40px;
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
    color: black;
    padding: 8px 12px;
    background:rgb(185, 188, 0);
    border-radius: 10px 0px 10px 0px;
    transition: all 0.3s ease;
}

.nav-menu ul li a:hover {
    background:rgb(0, 189, 41);
    color:white;
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
    background-color: rgb(35, 35, 35);
    padding: 20px;
    padding-bottom: 50px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    transition: transform 0.2s ease;
}


.picture-border:hover {
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
    color: white;
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
    color: yellow;
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
    background-color: transparent; /* Transparent background */
    text-decoration: none;
    border-radius: 10px 0 10px 0;
    margin: 5px;
    cursor: pointer;
    transition: all 0.3s ease;
}

/* Edit and Add to Cart - Green Button */
.product-card .action-buttons a,
.product-card .action-buttons button:not(.out-of-stock):not(.delete) {
    color: #4CAF50; /* Green text */
    border: 1px solid #4CAF50; /* Green border */
}

.product-card .action-buttons a:hover,
.product-card .action-buttons button:not(.out-of-stock):not(.delete):hover {
    background-color: #4CAF50; /* Green background on hover */
    color: white;
}

/* Delete and Out of Stock - Red Button */
.product-card .action-buttons a.delete,
.product-card .action-buttons .out-of-stock {
    color: #f44336; /* Red text */
    border: 1px solid #f44336; /* Red border */
}

.product-card .action-buttons a.delete:hover,
.product-card .action-buttons .out-of-stock:hover {
    background-color: #f44336; /* Red background on hover */
    color: white;
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
@layer picture-border {
  .picture-border {
    transition: transform 0.3s ease;
    display: grid;
    width: auto;
    height: auto;
    --bc: yellow; /* Border color */
    --bs: 1vw; /* Border size */
    --cs: 2vw; /* Cut size */
    grid-template-rows: var(--cs) auto 1fr;
  }

  /* Caption (figcaption to div with class caption) */
  .picture-border > .caption {
    grid-area: 1/1/2/2;
    justify-self: end;
    min-width: 50%;
    min-height: calc(var(--cs) * 2 + var(--bs));
    display: grid;
    place-items: center;
    text-align: center;
    background-color: var(--bc);
    clip-path: polygon(
      var(--cs) 0,
      100% 0,
      100% 100%,
      0 100%,
      0 var(--cs)
    );
  }

  /* Image inside the div */
  .picture-border > .product-card {
    grid-area: 2/1/4/2;
    width: 100%;
    height: 100%;
    object-fit: cover;
    --em: 0.5;
    clip-path: polygon(
      calc(var(--cs) + var(--bs) * var(--em)) var(--bs),
      calc(100% - var(--bs)) var(--bs),
      calc(100% - var(--bs)) calc(100% - var(--cs) - var(--bs)),
      calc(50% + var(--cs) - var(--bs) * var(--em)) calc(100% - var(--cs) - var(--bs)),
      calc(50% - var(--bs) * var(--em)) calc(100% - var(--bs)),
      var(--bs) calc(100% - var(--bs)),
      var(--bs) calc(var(--cs) + var(--bs) * var(--em))
    );
  }

  /* Border effect using ::before */
  .picture-border::before {
    content: "";
    grid-area: 2/1/4/2;
    background-color: var(--bc);
    clip-path: polygon(
      var(--cs) 0,
      100% 0,
      100% calc(100% - var(--cs)),
      calc(50% + var(--cs)) calc(100% - var(--cs)),
      50% 100%,
      0% 100%,
      0 var(--cs)
    );
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
        } elseif ($category == "Performance Jackets") {
            $sql = "SELECT * FROM products WHERE category = ?";
            $stmt = $db->prepare($sql);
            $stmt->bind_param("s", $category); // Bind the category as a string parameter
        } elseif ($category == "Casual Jackets") {
            $sql = "SELECT * FROM products WHERE category = ?";
            $stmt = $db->prepare($sql);
            $stmt->bind_param("s", $category); // Bind the category as a string parameter
        } elseif ($category == "Formal Jackets") {
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
    <h3 style="color:yellow;">Categories</h3>
    <ul>
        <li><a href="index.php?page=products&category=all">All</a></li>
        <li><a href="index.php?page=products&category=Casual Jackets">Casual Jackets</a></li>
        <li><a href="index.php?page=products&category=Formal Jackets">Formal Jackets</a></li>
        <li><a href="index.php?page=products&category=Performance Jackets">Performance Jackets</a></li>
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
                <div class="picture-border">

                    <div class="product-card">
                  
                        <div class="clickable-image" onclick="customOpenModal('<?php echo $image_src; ?>', <?php echo $product_id; ?>)">
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

