<?php
require "database_connect.php";  // Include the Database connection class
$db = new Database();  // Instantiate the Database class

// Check if the form is submitted and the product_id is available
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $price = $_POST['price'];
    $details = $_POST['details'];
    $stocks = $_POST['stocks'];
    $category = $_POST['category'];

    // Fetch the current product image
    $sql = "SELECT image_data FROM products WHERE product_id = ?";
    if ($stmt = $db->connection->prepare($sql)) {
        $stmt->bind_param('i', $product_id);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($current_image_data);
        $stmt->fetch();
        $stmt->close();
    }

    // Check if a new image was uploaded
    if (isset($_FILES['file']) && $_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $image_data = file_get_contents($_FILES['file']['tmp_name']);
        if ($image_data === false) {
            die("Error reading uploaded file.");
        }
    } else {
        $image_data = $current_image_data;
    }

    if ($image_data === $current_image_data) {
        $sql = "UPDATE products SET product_name = ?, price = ?, details = ?, stocks = ?, category = ? WHERE product_id = ?";
        if ($stmt = $db->connection->prepare($sql)) {
            $stmt->bind_param('sdsisi', $product_name, $price, $details, $stocks, $category, $product_id);
            if ($stmt->execute()) {
                header("Location: ../../?page=products");
                exit;
            } else {
                echo "Error updating product: " . $stmt->error;
            }
            $stmt->close();
        }
    } else {
        $sql = "UPDATE products SET product_name = ?, price = ?, details = ?, stocks = ?, category = ?, image_data = ? WHERE product_id = ?";
        if ($stmt = $db->connection->prepare($sql)) {
            $stmt->bind_param('sdsisbi', $product_name, $price, $details, $stocks, $category, $image_data, $product_id);
            $stmt->send_long_data(5, $image_data); // Handle BLOB
            if ($stmt->execute()) {
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

$db->close();

?>
