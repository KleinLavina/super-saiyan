<header class="valorant-header">
    <h1><i>Francis Martin Fits</i></h1>
    <p>High-Tier Valorant-Inspired Gear at Competitive Prices</p>
    <p><i>By: Francis Martin Escobal</i></p>
</header>

<style>

/* Header container with background image */
.valorant-header {
    position: relative;
    background: url('images/source1.gif') no-repeat center center/cover;
    color: white;
    text-align: center;
    padding: 20px 15px;
    border-bottom: 4px solid rgb(70, 255, 89);
    overflow: hidden;
    transition: transform 0.5s ease-in-out;
   
}

/* Glass blur pseudo-element */
.valorant-header::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    backdrop-filter: blur(12px);
    background: rgba(13, 13, 13, 0.6); /* Dark semi-transparent overlay */
    z-index: 1;
}

/* Header content with higher z-index */
.valorant-header h1,
.valorant-header p {
    position: relative;
    z-index: 2;
}
.valorant-header p{
    background: linear-gradient(90deg, rgb(242, 255, 3) 22%, rgb(6, 176, 255) 50%, rgb(183, 224, 1) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    transform: skewX(-10deg); /* Slanted text effect */
    text-shadow: 0 0 10px rgba(243, 255, 70, 0.8); /* Glowing effect *//* Change text to white on hover */
    font-style: italic; /* Italics on hover */
}
.valorant-header h1{
    background: linear-gradient(90deg, rgb(3, 255, 24) 22%, rgb(201, 255, 6) 50%, rgba(18,136,137,1) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    transform: skewX(-10deg); /* Slanted text effect */
    text-shadow: 0 0 10px rgba(221, 255, 70, 0.8); /* Glowing effect *//* Change text to white on hover */
    font-style: italic; /* Italics on hover */
}
/* Header title style */
.valorant-header h1 {
    font-size: 2.8rem;
    margin-bottom: 10px;
    color:rgb(70, 172, 255);
    text-transform: uppercase;
    letter-spacing: 2px;
    transition: color 0.3s ease;
}

/* Subtitle and author styles */
.valorant-header p {
    font-size: 1.2rem;
    margin-top: 0;
    color: #CCCCCC;
    transition: color 0.3s ease;
}

/* Hover effect on header */
.valorant-header:hover {
    transform: scale(1.02); /* Slight zoom effect */
    filter: brightness(1.1); /* Slight brightness increase */
    border-bottom: 4px solid rgb(70, 224, 255);
    box-shadow: 0 0 20px rgba(70, 255, 70, 0.7); /* Glowing effect */
    transform: scale(1.02); /* Slight zoom effect */
}

/* Hover effect on title and text */
.valorant-header:hover h1 {
    background: linear-gradient(90deg, rgb(242, 255, 3) 22%, rgb(6, 176, 255) 50%, rgb(183, 224, 1) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    transform: skewX(-10deg); /* Slanted text effect */
    text-shadow: 0 0 10px rgba(243, 255, 70, 0.8); /* Glowing effect *//* Change text to white on hover */
    font-style: italic; /* Italics on hover */
}

.valorant-header:hover p {
    background: linear-gradient(90deg, rgb(3, 255, 24) 22%, rgb(201, 255, 6) 50%, rgba(18,136,137,1) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    transform: skewX(-10deg); /* Slanted text effect */
    text-shadow: 0 0 10px rgba(221, 255, 70, 0.8); /* Glowing effect *//* Change text to white on hover */
    font-style: italic; /* Italics on hover */
}
</style>
