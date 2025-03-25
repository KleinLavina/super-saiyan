<div style="position: relative; width: 100%; height: 100vh; display: flex; justify-content: center; align-items: center; overflow: hidden;">
    <!-- Glassmorphism Overlay using ::before -->
    <div style="
        position: absolute;
        width: 100%;
        height: 100%;
        background: url('images/mine.gif') no-repeat center center/cover; /* Add your Valorant-themed background here */
        filter: brightness(0.3); /* Slight dim for better contrast */
        z-index: -1; /* Push background behind everything */
    "></div>

    <!-- Main Container with Glass Effect -->
    <div style="position: relative; background: rgba(255, 255, 255, 0.1); padding: 30px; padding-bottom: 80px; border-radius: 20px; width: 420px; box-shadow: 0 0 25px rgba(242, 255, 3, 0.5); border: 2px solid rgba(6, 176, 255, 0.3); overflow: hidden;">
        
        <!-- Pseudo for Glass Blur -->
        <div style="
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            backdrop-filter: blur(15px); /* Glass Blur Effect */
            -webkit-backdrop-filter: blur(20px);
            background: rgba(110, 20, 20, 0.05); /* Slight glass transparency */
            z-index: -1;
        "></div>

        <!-- Login Form -->
        <form method="POST" action="pages/backend/check_login.php">
            <div style="
                text-align: center;
                font-size: 32px;
                margin-bottom: 20px;
                background: linear-gradient(90deg, rgb(242, 255, 3) 22%, rgb(6, 176, 255) 50%, rgb(183, 224, 1) 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                transform: skewX(-10deg);
                text-shadow: 0 0 10px rgba(243, 255, 70, 0.8);
            ">
                <h3>Log In</h3>
            </div>

            <?php
            // Display error messages if there is any
            if (isset($_SESSION['error'])) {
                echo '<div style="color: #f0ad4e; text-align: center; margin-bottom: 10px;">' . $_SESSION['error'] . '</div>';
                unset($_SESSION['error']);
            }
            ?>

            <!-- Username Input -->
            <div style="margin-bottom: 15px;">
                <label for="username" style="display: block; margin-bottom: 5px; font-weight: bold;
                background: linear-gradient(90deg, rgb(242, 255, 3) 22%, rgb(6, 176, 255) 50%, rgb(183, 224, 1) 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                text-shadow: 0 0 10px rgba(243, 255, 70, 0.8);
                ">USERNAME:</label>
                <input type="text" id="username" name="username" placeholder="Enter your username"
                    style="width: 100%; padding: 12px; border-radius: 6px; border: 1px solid white; background-color: rgba(15, 25, 35, 0.8); color: white; 
                    transform: skewX(-12deg); font-style: italic; transition: all 0.3s ease-in-out;"
                    onfocus="this.style.transform='skewX(0deg)'; this.style.boxShadow='0 0 12px rgba(6, 176, 255, 0.9)'"
                    onblur="this.style.transform='skewX(-12deg)'; this.style.boxShadow='0 0 5px rgba(6, 176, 255, 0.5)';"
                    required>
            </div>

            <!-- Password Input -->
            <div style="margin-bottom: 15px;">
                <label for="passwords" style="display: block; margin-bottom: 5px; font-weight: bold;
                background: linear-gradient(90deg, rgb(242, 255, 3) 22%, rgb(6, 176, 255) 50%, rgb(183, 224, 1) 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                text-shadow: 0 0 10px rgba(243, 255, 70, 0.8);
                ">PASSWORD:</label>
                <input type="password" id="passwords" name="passwords" placeholder="Enter your password"
                    style="width: 100%; padding: 12px; border-radius: 6px; border: 1px solid white; background-color: rgba(15, 25, 35, 0.8); color: white; 
                    transform: skewX(-12deg); font-style: italic; transition: all 0.3s ease-in-out;"
                    onfocus="this.style.transform='skewX(0deg)'; this.style.boxShadow='0 0 12px rgba(6, 176, 255, 0.9)'"
                    onblur="this.style.transform='skewX(-12deg)'; this.style.boxShadow='0 0 5px rgba(6, 176, 255, 0.5)';"
                    required>
            </div>

            <!-- CAPTCHA Input -->
            <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 15px;">
                <img id="imgcap" onclick="reloadCaptcha();return false;" src="inc/captcha.php" alt="CAPTCHA"
                    style="border-radius: 10px; height: 50px; width: 100px; cursor: pointer; border: 2px solid white; box-shadow: 0 0 12px rgba(6, 176, 255, 0.8); transition: transform 0.3s ease;"
                    onmouseover="this.style.transform='scale(1.1)'"
                    onmouseout="this.style.transform='scale(1)'">
                <input type="text" id="captcha" name="captcha" placeholder="Enter CAPTCHA"
                    style="width: 65%; padding: 12px; border-radius: 6px; border: 1px solid white; background-color: rgba(15, 25, 35, 0.8); color: white; 
                    transform: skewX(-12deg); font-style: italic; transition: all 0.3s ease-in-out;"
                    onfocus="this.style.transform='skewX(0deg)'; this.style.boxShadow='0 0 12px rgba(6, 176, 255, 0.9)'"
                    onblur="this.style.transform='skewX(-12deg)'; this.style.boxShadow='0 0 5px rgba(6, 176, 255, 0.5)';"
                    required>
            </div>

            <!-- Submit Button -->
            <div style="display:flex;align-items:center;justify-content:center;">
                <input type="submit" value="Submit"
                    style="width: 50%; padding: 12px; border-radius: 6px; border: none; background: linear-gradient(90deg, rgb(242, 255, 3), rgb(6, 176, 255), rgb(183, 224, 1));
                    color: white; cursor: pointer; font-size: 16px; font-weight: bold; text-transform: uppercase; box-shadow: 0 0 15px rgba(6, 176, 255, 0.8); transition: all 0.3s ease;"
                    onmouseover="this.style.transform='scale(1.05)'; this.style.boxShadow='0 0 20px rgba(6, 176, 255, 1)'"
                    onmouseout="this.style.transform='scale(1)'; this.style.boxShadow='0 0 10px rgba(6, 176, 255, 0.8)'">
            </div>
        </form>
    </div>
</div>

<script>
// Reload CAPTCHA image to prevent caching
function reloadCaptcha() {
    var d = new Date();
    document.getElementById("imgcap").src = document.getElementById("imgcap").src.split('?')[0] + '?' + d.getMilliseconds();
}
</script>
