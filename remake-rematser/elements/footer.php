<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Francis Martin Fits</title>
    <style>

        /* Alt Body for custom background */
        .alt-body {
            margin: 0;
            padding: 0;
            background-color: #0D0D0D; /* Dark Background */
        }

        footer {
            background-color: #1A1A1A; /* Dark Gray */
            color: white;
            padding: 40px 0;
            font-family: 'Arial', sans-serif;
            border-top: 4px solid rgb(89, 255, 70); /* Green Top Border */
            font-style: italic;
        }

        .footer-container {
            width: 85%;
            margin: 0 auto;
        }

        .footer-row {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 30px;
        }

        .footer-column {
            flex: 1;
            min-width: 250px;
            margin: 10px;
        }

        .footer-column h3 {
            font-size: 22px;
            margin-bottom: 15px;
            background: linear-gradient(90deg, rgb(242, 255, 3) 22%, rgb(6, 176, 255) 50%, rgb(183, 224, 1) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            transform: skewX(-10deg); /* Slanted text effect */
            text-shadow: 0 0 10px rgba(243, 255, 70, 0.8);
        }

        .footer-column p,
        .footer-column ul {
            font-size: 14px;
            line-height: 1.7;
            color: rgb(0, 255, 38); /* Soft Gray Text */
        }

        .footer-column a {
            color: rgb(195, 255, 0);
            text-decoration: none;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .footer-column a:hover {
            background: linear-gradient(90deg, rgb(242, 255, 3) 22%, rgb(6, 176, 255) 50%, rgb(183, 224, 1) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            transform: skewX(-10deg);
            text-shadow: 0 0 10px rgba(243, 255, 70, 0.8);
            transform: translateX(5px);
        }

        .footer-column ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-column ul li {
            margin: 8px 0;
        }

        .footer-column ul li a {
            color: rgb(234, 255, 0);
            text-decoration: none;
            font-size: 14px;
        }

        .footer-column ul li a:hover {
            background: linear-gradient(90deg, rgb(242, 255, 3) 22%, rgb(6, 176, 255) 50%, rgb(183, 224, 1) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            transform: skewX(-10deg);
            text-shadow: 0 0 10px rgba(243, 255, 70, 0.8);
        }

        .footer-column p {
            font-size: 14px;
            color: rgb(0, 255, 42); /* Slightly Lighter Gray */
        }

        .footer-column {
            border-right: 1px solid rgba(9, 255, 0, 0.1);
            padding-right: 15px;
        }

        .footer-column:last-child {
            border-right: none;
        }

        @media screen and (max-width: 768px) {
            .footer-row {
                flex-direction: column;
                align-items: center;
            }

            .footer-column {
                margin-bottom: 20px;
                border-right: none;
            }

            .footer-column h3 {
                font-size: 20px;
            }

            .footer-column p,
            .footer-column ul {
                font-size: 13px;
            }
        }
    </style>
</head>

<body>
    <!-- Apply alt-body for dark background -->
    <div class="alt-body">
        <footer>
            <div class="footer-container">
                <div class="footer-row">
                    <div class="footer-column">
                        <h3>Francis Martin Fits</h3>
                        <p>Explore the finest selection of premium jackets and winter essentials, carefully curated to bring style and warmth to your wardrobe.</p>
                        <p><strong>Francis Martin</strong>, Founder</p>
                    </div>

                    <div class="footer-column">
                        <h3>Jacket Collections</h3>
                        <ul>
                            <li><a href="#">Puffer Jackets</a></li>
                            <li><a href="#">Leather Jackets</a></li>
                            <li><a href="#">Bomber Jackets</a></li>
                            <li><a href="#">Limited Edition Drops</a></li>
                        </ul>
                    </div>

                    <div class="footer-column">
                        <h3>Customer Support</h3>
                        <ul>
                            <li><a href="#">Order Tracking</a></li>
                            <li><a href="#">Shipping Information</a></li>
                            <li><a href="#">Return Policy</a></li>
                            <li><a href="#">Contact Us</a></li>
                        </ul>
                    </div>

                    <div class="footer-column">
                        <h3>Contact Us</h3>
                        <p>123 Street, Urban Style District</p>
                        <p>Email: support@francismartinfits.com</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
