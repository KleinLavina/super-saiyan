<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cracken Furniture</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F1F1F1; /* Light Gray Background */
        }

        footer {
            background-color: #1E4C6D; /* Ocean Blue */
            color: white;
            padding: 40px 0;
            font-family: 'Arial', sans-serif;
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
            font-weight: bold;
            color: #68AEDD; /* Sky Blue */
        }

        .footer-column p, .footer-column ul {
            font-size: 14px;
            line-height: 1.7;
            color: #FFFFFF; /* White text for readability */
        }

        .footer-column a {
            color: white;
            text-decoration: none;
            transition: color 0.3s ease, transform 0.3s ease;
        }

        .footer-column a:hover {
            color: #A0D6D1; /* Seafoam Green */
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
            color: white;
            text-decoration: none;
            font-size: 14px;
        }

        .footer-column ul li a:hover {
            color: #A0D6D1; /* Seafoam Green */
        }

        .footer-column p {
            font-size: 14px;
            color: #BBBBBB; /* Soft gray for subtext */
        }

        .footer-column {
            border-right: 1px solid rgba(255, 255, 255, 0.2);
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

            .footer-column p, .footer-column ul {
                font-size: 13px;
            }
        }
    </style>
</head>
<body>
    <footer>
        <div class="footer-container">
            <div class="footer-row">
                <div class="footer-column">
                    <h3>Cracken Furniture</h3>
                    <p>At Cracken Furniture, we offer a wide range of high-quality furniture for every space. From stylish sofas to elegant dining tables, we have the perfect pieces to transform your home.</p>
                    <p><strong>Klein Lavina</strong>, CEO</p>
                </div>

                <div class="footer-column">
                    <h3>Our Products</h3>
                    <ul>
                        <li><a href="#">Sofas & Couches</a></li>
                        <li><a href="#">Dining Tables</a></li>
                        <li><a href="#">Bedroom Furniture</a></li>
                        <li><a href="#">Storage Solutions</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h3>Customer Service</h3>
                    <ul>
                        <li><a href="#">Your Account</a></li>
                        <li><a href="#">Order Status</a></li>
                        <li><a href="#">Delivery Information</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>

                <div class="footer-column">
                    <h3>Contact</h3>
                    <p>456 Furniture Blvd, Comfort City, USA</p>
                    <p>Email: contact@crackenfurniture.com</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
