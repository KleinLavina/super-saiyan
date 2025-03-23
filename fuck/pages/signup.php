<?php
// Initialize error and success messages
$message = "";

require_once "backend/database_connect.php";
$db = new Database();

// Query to get the highest existing ID
$result = $db->getData("SELECT MAX(p_id) AS max_id FROM persons");
$row = $result->fetch_assoc();
$next_id = $row['max_id'] + 1; // Increment the highest ID to get the next available ID

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $idno = $next_id; // Use the generated ID
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $address = $_POST['address']; // Corrected form field
    $username = $_POST['username'];
    $passwords = $_POST['passwords'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($passwords !== $confirm_password) {
        $_SESSION['message'] = "Error: Passwords do not match!";
    } else {
        // Insert new record into the database
        $sql1 = $db->prepare("INSERT INTO persons (p_id, p_fname, p_lname, address, username, passwords) VALUES (?, ?, ?, ?, ?, ?)");
        $sql1->bind_param("ssssss", $idno, $fname, $lname, $address, $username, $passwords);

        if ($sql1->execute()) {
            // Success message
            $_SESSION['message'] = "New record created successfully!";
        } else {
            // Error in execution
            $_SESSION['message'] = "Error: Failed to execute the query. " . $sql1->error;
        }
        $sql1->close();
    }
}


// Close the database connection
$db->close();
?>

<div style="position: relative; width: 100%; height: 100vh; display: flex; justify-content: center; align-items: center; overflow: hidden;">
    <!-- Glassmorphism Overlay and Background Image -->
    <div style="
        position: absolute;
        width: 100%;
        height: 100%;
        background: url('images/mine.gif') no-repeat center center/cover;
        filter: brightness(0.3);
        z-index: -1;
        font-family: 'Anton', sans-serif;
    "></div>

    <!-- Main Container with Glass Effect -->
    <div style="position: relative; background: rgba(255, 255, 255, 0.1); padding: 30px; padding-bottom: 80px; border-radius: 20px; width: 480px; box-shadow: 0 0 25px rgba(113, 255, 70, 0.5); border: 2px solid rgba(255, 255, 70, 0.3); overflow: hidden;">
        
        <!-- Glass Blur Effect -->
        <div style="
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            background: rgba(255, 255, 255, 0.05);
            z-index: -1;
        "></div>

        <!-- Registration Form -->
        <form method="POST" action="" style="display: flex; flex-direction: column;">
            <div style="text-align: center; font-size: 32px; margin-bottom: 20px;
                background: linear-gradient(90deg, rgb(242, 255, 3) 22%, rgb(6, 176, 255) 50%, rgb(183, 224, 1) 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                text-shadow: 0 0 10px rgba(243, 255, 70, 0.8);
                transform: skewX(-10deg) translateX(5px);
                letter-spacing: 2px;">
                <h3>Register</h3>
            </div>

            <!-- Display Success or Error Message -->
            <?php if (isset($_SESSION['message'])) : ?>
                <div class="message" style="margin: 5px 0 10px 0; padding: 10px; text-align: center; color: white; border-radius: 12px; font-weight: bold; <?php echo (strpos($_SESSION['message'], 'Error') !== false) ? 'background-color: #FF2E63;' : 'background-color: #7ed957;'; ?>">
                    <?php echo $_SESSION['message']; ?>
                </div>
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>

            <!-- First and Last Name Input Fields -->
            <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                <div style="flex: 1; margin-right: 10px;">
                    <label for="fname" style="display: block; margin-bottom: 5px; color: white;">First Name:</label>
                    <input type="text" id="fname" name="fname" placeholder="Enter First Name"
                        style="width: 100%; padding: 12px; border-radius: 6px; border: 1px solid white;
                        background: rgba(15, 25, 35, 0.8); color: white;
                        text-shadow: 0 0 10px rgba(243, 255, 70, 0.8);
                        transform: skewX(-10deg); transition: all 0.3s ease-in-out;"
                        onfocus="this.style.transform='skewX(0deg)'; this.style.boxShadow='0 0 12px rgba(243, 255, 70, 0.9)'"
                        onblur="this.style.transform='skewX(-10deg)'; this.style.boxShadow='0 0 5px rgba(243, 255, 70, 0.5)';"
                        required>
                </div>
                <div style="flex: 1; margin-left: 10px;">
                    <label for="lname" style="display: block; margin-bottom: 5px; color: white;">Last Name:</label>
                    <input type="text" id="lname" name="lname" placeholder="Enter Last Name"
                        style="width: 100%; padding: 12px; border-radius: 6px; border: 1px solid white;
                        background: rgba(15, 25, 35, 0.8); color: white;
                        text-shadow: 0 0 10px rgba(243, 255, 70, 0.8);
                        transform: skewX(-10deg); transition: all 0.3s ease-in-out;"
                        onfocus="this.style.transform='skewX(0deg)'; this.style.boxShadow='0 0 12px rgba(243, 255, 70, 0.9)'"
                        onblur="this.style.transform='skewX(-10deg)'; this.style.boxShadow='0 0 5px rgba(243, 255, 70, 0.5)';"
                        required>
                </div>
            </div>

            <!-- Address Input Field -->
            <div style="margin-bottom: 15px;">
                <label for="address" style="display: block; margin-bottom: 5px; color: white;">Address:</label>
                <input type="text" id="address" name="address" placeholder="Enter Address"
                    style="width: 100%; padding: 12px; border-radius: 6px; border: 1px solid white;
                    background: rgba(15, 25, 35, 0.8); color: white;
                    text-shadow: 0 0 10px rgba(243, 255, 70, 0.8);
                    transform: skewX(-10deg); transition: all 0.3s ease-in-out;"
                    onfocus="this.style.transform='skewX(0deg)'; this.style.boxShadow='0 0 12px rgba(243, 255, 70, 0.9)'"
                    onblur="this.style.transform='skewX(-10deg)'; this.style.boxShadow='0 0 5px rgba(243, 255, 70, 0.5)';"
                    required>
            </div>

            <!-- Username Input Field -->
            <div style="margin-bottom: 15px;">
                <label for="username" style="display: block; margin-bottom: 5px; color: white;">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter Username"
                    style="width: 100%; padding: 12px; border-radius: 6px; border: 1px solid white;
                    background: rgba(15, 25, 35, 0.8); color: white;
                    text-shadow: 0 0 10px rgba(243, 255, 70, 0.8);
                    transform: skewX(-10deg); transition: all 0.3s ease-in-out;"
                    onfocus="this.style.transform='skewX(0deg)'; this.style.boxShadow='0 0 12px rgba(243, 255, 70, 0.9)'"
                    onblur="this.style.transform='skewX(-10deg)'; this.style.boxShadow='0 0 5px rgba(243, 255, 70, 0.5)';"
                    required>
            </div>

            <!-- Password and Confirm Password Fields -->
            <div style="display: flex; justify-content: space-between; margin-bottom: 15px;">
                <div style="flex: 1; margin-right: 10px;">
                    <label for="passwords" style="display: block; margin-bottom: 5px; color: white;">Password:</label>
                    <input type="password" id="passwords" name="passwords" placeholder="Enter Password"
                        style="width: 100%; padding: 12px; border-radius: 6px; border: 1px solid white;
                        background: rgba(15, 25, 35, 0.8); color: white;
                        text-shadow: 0 0 10px rgba(243, 255, 70, 0.8);
                        transform: skewX(-10deg); transition: all 0.3s ease-in-out;"
                        onfocus="this.style.transform='skewX(0deg)'; this.style.boxShadow='0 0 12px rgba(243, 255, 70, 0.9)'"
                        onblur="this.style.transform='skewX(-10deg)'; this.style.boxShadow='0 0 5px rgba(243, 255, 70, 0.5)';"
                        required>
                </div>
                <div style="flex: 1; margin-left: 10px;">
                    <label for="confirm_password" style="display: block; margin-bottom: 5px; color: white;">Confirm Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password"
                        style="width: 100%; padding: 12px; border-radius: 6px; border: 1px solid white;
                        background: rgba(15, 25, 35, 0.8); color: white;
                        text-shadow: 0 0 10px rgba(243, 255, 70, 0.8);
                        transform: skewX(-10deg); transition: all 0.3s ease-in-out;"
                        onfocus="this.style.transform='skewX(0deg)'; this.style.boxShadow='0 0 12px rgba(243, 255, 70, 0.9)'"
                        onblur="this.style.transform='skewX(-10deg)'; this.style.boxShadow='0 0 5px rgba(243, 255, 70, 0.5)';"
                        required>
                </div>
            </div>

            <!-- Submit Button -->
            <div style="display:flex;align-items:center;justify-content:center;">
                <input type="submit" value="Register"
                    style="width: 50%; padding: 12px; border-radius: 6px; border: none;
                    background: linear-gradient(90deg, rgb(242, 255, 3) 22%, rgb(6, 176, 255) 50%, rgb(183, 224, 1) 100%);
                    color: white; cursor: pointer; font-size: 16px; font-weight: bold; text-transform: uppercase;
                    box-shadow: 0 0 15px rgba(255, 70, 85, 0.8); transition: all 0.3s ease;"
                    onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 0 20px rgba(243, 255, 70, 1)'"
                    onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 0 10px rgba(243, 255, 70, 0.8)'">
            </div>
        </form>
    </div>
</div>
