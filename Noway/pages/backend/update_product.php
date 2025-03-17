<?php
require "database_connect.php";  // Include the Database connection class
$db = new Database();  // Instantiate the Database class

// Check if the form is submitted and the product_id is available
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $details = $_POST['details'];
    
    // Fetch the current product data to check the existing image
    $sql = "SELECT image_data FROM products WHERE product_id = ?";
    if ($stmt = $db->connection->prepare($sql)) {
        $stmt->bind_param('i', $product_id);  // Bind product_id
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($current_image_data);
        $stmt->fetch();
        $stmt->close();
    }

    // Check if a new image was uploaded
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        // Get the new file data
        $image_data = file_get_contents($_FILES['file']['tmp_name']);
    } else {
        // If no new image was uploaded, keep the current image
        $image_data = $current_image_data;
    }

    // Update query to change product details in the database
    if ($image_data === $current_image_data) {
        // Update product without changing the image
        $sql = "UPDATE products SET product_name = ?, price = ?, details = ? WHERE product_id = ?";
        if ($stmt = $db->connection->prepare($sql)) {
            $stmt->bind_param('sssi', $product_name, $price, $details, $product_id);
            if ($stmt->execute()) {
                echo "Product updated successfully, image remains unchanged.";
                header("Location: ../../?page=products");
                exit;
            } else {
                echo "Error updating product: " . $stmt->error;
            }
            $stmt->close();
        }
    } else {
        // Update product with new image
        $sql = "UPDATE products SET product_name = ?, price = ?, details = ?, image_data = ? WHERE product_id = ?";
        if ($stmt = $db->connection->prepare($sql)) {
            $stmt->bind_param('ssssi', $product_name, $price, $details, $image_data, $product_id);
            if ($stmt->execute()) {
                echo "Product updated successfully with the new image.";
                header("Location: ../../?page=products");
                exit;
            } else {
                echo "Error updating product: " . $stmt->error;
            }
            $stmt->close();
        }
    }
} else {
    echo "Invalid request!";
}

// Close the database connection
$db->close();
?>
