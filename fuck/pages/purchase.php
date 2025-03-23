<?php

require_once "backend/database_connect.php";

// Check if user is logged in
if (!isset($_SESSION['p_id'])) {
    die("Unauthorized access. Please log in.");
}

$p_id = $_SESSION['p_id']; // Get user ID from session
$db = new Database();

// Check if a delete request is made
if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    $delete_sql = "DELETE FROM purchases WHERE purchase_id = ? AND user_id = ?";
    $delete_stmt = $db->prepare($delete_sql);
    $delete_stmt->bind_param("ii", $delete_id, $p_id);
    
    if ($delete_stmt->execute()) {
        echo "<script>alert('Purchase removed successfully!'); window.location.href='index.php?page=purchase';</script>";
    } else {
        echo "<script>alert('Error removing purchase.');</script>";
    }
    $delete_stmt->close();
}

// Query purchase history for logged-in user, including product image
$sql = "SELECT p.purchase_id, pr.product_name, pr.image_data, p.quantity, p.total_price, p.purchase_date 
        FROM purchases p
        JOIN products pr ON p.product_id = pr.product_id
        WHERE p.user_id = ?";
$stmt = $db->prepare($sql);
$stmt->bind_param("i", $p_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase History</title>
    <style>
        /* General Styling */
        body {
            font-family: Arial, sans-serif;
            background: #121212; /* Dark background */
            color: #e0e0e0; /* Light text */
            text-align: center;
        }
        .container {
            width: 90%;
            margin: 30px auto;
            background: #1e1e1e; /* Dark card background */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.5);
        }
        h1 {
            margin-bottom: 20px;
            color: #f4f4f4;
        }
        /* Table Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #1a1a1a; /* Table dark background */
        }
        th, td {
            padding: 10px;
            border: 1px solid #333;
        }
        th {
            background: #333;
            color: #fff;
        }
        td {
            background: #252525;
        }
        tr:nth-child(even) {
            background: #2b2b2b; /* Alternate row color */
        }
        /* Product Image */
        .product-image {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 5px;
            cursor: pointer;
            transition: transform 0.2s;
        }
        .product-image:hover {
            transform: scale(1.1);
        }
        /* Remove Button */
        .remove-btn {
            padding: 8px 15px;
            background-color: #ff4d4d;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 5px;
        }
        .remove-btn:hover {
            background-color: #cc0000;
        }
        /* Back Button */
        .btn {
            padding: 10px;
            text-decoration: none;
            margin-top: 30px;
            color: white;
            background: #007bff;
            border-radius: 15px;
            transition: background 0.3s;
        }
        .btn:hover {
            background: #0056b3;
        }
        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 99;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: #333;
            padding: 20px;
            border-radius: 8px;
            width: 90vh;
            max-width: 800px;
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }
        .close-btn {
            font-size: 40px;
            color: #aaa;
            cursor: pointer;
            position: absolute;
            top: 10px;
            right: 20px;
        }
        .close-btn:hover {
            color: white;
        }
        .modal-body {
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .modal-image-container img {
            width: 100%;
            max-width: 1000px;
            height: 90vh;
            border-radius: 8px;
        }
    </style>
</head>
<body>

<div class="container">
    <h1>Purchase History</h1>
    <table>
        <thead>
            <tr>
                <th>Purchase ID</th>
                <th>Product</th>
                <th>Image</th>
                <th>Quantity</th>
                <th>Total Price</th>
                <th>Purchase Date</th>
                <th>Action</th> <!-- New column for remove button -->
            </tr>
        </thead>
        <tbody>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    // Convert binary image data to Base64
                    $image_src = 'data:image/jpeg;base64,' . base64_encode($row['image_data']);
                    
                    echo "<tr>
                            <td>{$row['purchase_id']}</td>
                            <td>{$row['product_name']}</td>
                            <td>
                                <img src='{$image_src}' alt='{$row['product_name']}' class='product-image' onclick='customOpenModal(\"{$image_src}\")'>
                            </td>
                            <td>{$row['quantity']}</td>
                            <td>$" . number_format($row['total_price'], 2) . "</td>
                            <td>{$row['purchase_date']}</td>
                            <td>
                                <form method='POST' onsubmit='return confirmDelete();'>
                                    <input type='hidden' name='delete_id' value='{$row['purchase_id']}'>
                                    <button type='submit' class='remove-btn'>Remove</button>
                                </form>
                            </td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No purchases found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="index.php?page=products" class="btn">Back to Shop</a>
</div>

<!-- Image Modal -->
<?php include "modal/image-modal.php"; ?>

<script>
// Confirm Delete
function confirmDelete() {
    return confirm("Are you sure you want to remove this purchase?");
}

// Open Modal Function
function customOpenModal(imageSrc) {
    // Set modal image source to the clicked image's source
    document.getElementById('custom-modal-image').src = imageSrc;

    // Display the modal
    document.getElementById('custom-image-modal').style.display = "flex";
}

// Close Modal Function
function customCloseModal() {
    // Hide the modal
    document.getElementById('custom-image-modal').style.display = "none";
}
</script>

</body>
</html>


<?php
// Close database connection
$stmt->close();
$db->close();
?>
