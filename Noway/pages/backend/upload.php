<?php

require "database_connect.php";  // Include the Database connection class
$db = new Database();  // Instantiate the Database class

// Check if the form is submitted
if (isset($_POST['submit'])) {
    // Check if the file is uploaded and there is no error
    if (isset($_FILES['file']) && $_FILES['file']['error'] == 0) {
        
        // Collect the product details from the form
        $product_name = $_POST['product_name'];
        $price = $_POST['price'];
        $details = $_POST['details'];

        // Get the uploaded image
        $image_name = $_FILES['file']['name'];
        $image_tmp = $_FILES['file']['tmp_name'];
        $image_data = file_get_contents($image_tmp);

        // Prepare the SQL query to insert the product and image into the database
        $sql = "INSERT INTO products (product_name, price, details, image_name, image_data) 
                VALUES (?, ?, ?, ?, ?)";
        
        // Use the Database class's connection and prepare method
        $stmt = $db->connection->prepare($sql);

        // Bind the parameters to the SQL query
        $stmt->bind_param("sdsss", $product_name, $price, $details, $image_name, $image_data);  // "s" stands for string, "d" for double (price), and "b" for blob (image data)

        // Execute the query
        if ($stmt->execute()) {
            echo "Product uploaded successfully!";
            header("Location: ../../?page=products");
            exit;
        } else {
            echo "Error uploading product: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Please select a valid image file to upload.";
    }
}

// Close the database connection
$db->close();
?>
