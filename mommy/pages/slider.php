<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Furniture for Sale - Home</title>

    <!-- Slick Slider CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">
    
    <style>
        /* Basic styling for the slider container */
        .slider-container {
            width: 80%;
            margin: 0 auto;
            padding-top: 20px;
            position: relative;  /* For positioning the navigation buttons */
        }

        /* Add blurred effect to the image */
        .slick-slide img {
            width: 70vh; /* Ensure images cover the entire slide */
            height: auto;
            margin: auto;
            transition: filter 0.3s ease-in-out;
        }

        /* Navigation buttons */
        .slider-nav-button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            font-size: 24px;
            padding: 10px;
            cursor: pointer;
            z-index: 2;  /* Make sure buttons are on top */
        }
        .image1 .image2 .image3 .image4 {
    position: relative;  /* This ensures that content inside the div stays above the background */
    height: 500px;       /* Adjust height to suit your design */
    position: relative;  /* Ensure the content stays above the background */
    height: 500px;       /* Adjust height to suit your design */
    display: flex;       /* Use flexbox to center the content */
    justify-content: center;  /* Horizontally center the image */
    align-items: center
        }

/* Pseudo-element for the blurred background image */
.image1::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('images/poster1.jpg') no-repeat center center;
    background-size: cover;
    filter: blur(8px); /* Apply blur to only the background image */
    z-index: -1; /* Ensure the blurred background stays behind the content */
}
.image2::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('images/poster2.jpg') no-repeat center center;
    background-size: cover;
    filter: blur(8px); /* Apply blur to only the background image */
    z-index: -1; /* Ensure the blurred background stays behind the content */
}
.image3::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('images/poster3.jpg') no-repeat center center;
    background-size: cover;
    filter: blur(8px); /* Apply blur to only the background image */
    z-index: -1; /* Ensure the blurred background stays behind the content */
}
.image4::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: url('images/poster4.jpg') no-repeat center center;
    background-size: cover;
    filter: blur(8px); /* Apply blur to only the background image */
    z-index: -1; /* Ensure the blurred background stays behind the content */
}

.image1 .content {
    position: relative;  /* Ensure the content stays on top of the blurred background */
    color: white;
    text-align: center;
    z-index: 1; /* Content stays above the blurred background */
}



        /* Left button */
        .prev-button {
            left: 0;
        }

        /* Right button */
        .next-button {
            right: 0;
        }

        /* Add a fading blur on the sides of the images */
        .slick-slide {
            position: relative;
        }

    </style>
</head>
<body>

    <!-- Image Slider -->
    <div class="slider-container">
        <!-- Slick Slider Navigation Buttons -->
        <button class="slider-nav-button prev-button">&#10094;</button>  <!-- Left arrow -->
        <button class="slider-nav-button next-button">&#10095;</button>  <!-- Right arrow -->

        <div class="slider">
            <div class="image1"><img src="images/poster1.jpg" alt="Furniture Image 1"></div>
            <div class="image2"><img src="images/poster2.jpg" alt="Furniture Image 2"></div>
            <div class="image3"><img src="images/poster3.jpg" alt="Furniture Image 3"></div>
            <div class="image4"><img src="images/poster4.jpg" alt="Furniture Image 4"></div>
        </div>
    </div>

    <!-- jQuery and Slick Slider JS -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>

    <script>
        // Initialize the slick slider
        $(document).ready(function(){
            var slider = $('.slider'); // Initialize the slider

            // Initialize the slick slider with autoplay and other settings
            slider.slick({
                autoplay: true,         // Automatically scroll images
                autoplaySpeed: 3000,    // Change image every 3 seconds
                dots: true,             // Show dots for navigation
                arrows: false,          // Hide default arrows
                infinite: true,         // Infinite loop of slides
                speed: 1000,            // Smooth transition speed
            });

            // Manual control for next and previous buttons
            $('.prev-button').click(function() {
                slider.slick('slickPrev');  // Go to the previous slide
            });

            $('.next-button').click(function() {
                slider.slick('slickNext');  // Go to the next slide
            });
        });
    </script>
    
</body>
</html>
