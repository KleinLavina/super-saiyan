<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@200,300,400,500,600,700,800,900&display=swap");
* {
  margin: 0;
  padding: 0;
  font-family: "Poppins", sans-serif;
}
.alt-body {
  display: flex;
  justify-content: center;
  align-items: center;
  min-height: 60vh;
  font: 1em/1.618 Inter, sans-serif;
  margin: 0;
  color: #224;
  position: relative;
  background:
    url('images/backshot.jpg')
    center / cover no-repeat fixed;
}

/* Add a glass blur layer using ::before */
.alt-body::before {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  backdrop-filter: blur(5px); /* Glass blur effect */
  background: rgba(255, 255, 255, 0.2); /* Optional transparent tint */
  z-index: 1;
}
.container {
  position: relative;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-wrap: wrap;
  margin: 40px 0;
  z-index: 2;
}
.card{
  transition:transform 1s;
}
.card:hover{
  transform:scale(1.1);
}
.container .card {
  position: relative;
  width: 300px;
  height: 400px;
  margin: 20px;
  overflow: hidden;
  box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
  border-radius: 15px;
  display: flex;
  justify-content: center;
  align-items: center;
}
.container .card .content{
  position: absolute;
  bottom: -160px;
  width: 100%;
  height: 160px;
  display: flex;
  justify-content: center;
  align-items: center;
  z-index: 10;
  flex-direction: column;
  backdrop-filter: blur(15px);
  box-shadow: 0 -10px 10px rgba(0,0,0,0.1);
  border: 1px solid rgba(255,255,255,0.2);
  transition: bottom 0.5s;
  transition-delay: 0.8s;
}
.container .card:hover .content{
  bottom: 0px;
  transition-delay: 0s;
}
.container .card .content .contentBx h3{
  color: #fff;
  text-transform: uppercase;
  letter-spacing: 2px;
  font-weight: 500;
  font-size: 12px;
  line-height: 1.1em;
  text-align: center;
  margin: 5px 0 15px;
  transition: 0.5s;
  opacity: 0;
  transform: translateY(-20px);
  transition-delay: 0.6s;
}
.container .card:hover .content .contentBx h3{
  opacity: 1;
  transform: translateY(0px);
}
.container .card .content .contentBx h3 span{
  font-size: 9px;
  font-weight: 300;
  text-transform: initial;
}
.container .card .content .sci{
  position: relative;
  bottom: 10px;
  display: flex;
}
.container .card .content .sci li{
  list-style: none;
  margin:  10px;
  transform: translateY(40px);
  transition: 0.5s;
  opacity: 0;
  transition-delay: calc(0.2s * var(--i));
}
.container .card:hover .content .sci li{
  transform: translateY(0px);
  opacity: 1;
}

.container .card .content .sci li a{
  color: #fff;
}
</style>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">


</head>

<div class= "alt-body">
  <div class="container">
    <div class="card">
      <div class="imgBx">
        <img src="images/past1.jpg">
      </div>
      <div class="content">
        <div class="contentBx">
          <h3> Aesthetic Design<br><span>Beauty meets purpose in thoughtfully crafted spaces.</span></h3>
        </div>

        <ul class="sci">
          <li style="--i:1"><a href="#"><i class="fab fa-facebook"></i></a></li>
          <li style="--i:2"><a href="#"><i class="fab fa-twitter"></i></a></li>
          <li style="--i:3"><a href="#"><i class="fab fa-instagram"></i></a></li>
        </ul>

      </div>
    </div>

    <div class="card">
      <div class="imgBx">
        <img src="images/past2.jpg">
      </div>
      <div class="content">
        <div class="contentBx">
          <h3>Modern Style<br><span>Sleek, simple, and effortlessly stylish.</span></h3>
        </div>

        <ul class="sci">
          <li style="--i:1"><a href="#"><i class="fab fa-facebook"></i></a></li>
          <li style="--i:2"><a href="#"><i class="fab fa-twitter"></i></a></li>
          <li style="--i:3"><a href="#"><i class="fab fa-instagram"></i></a></li>
        </ul>

      </div>
    </div>

    <div class="card">
      <div class="imgBx">
        <img src="images/past3.jpg">
      </div>
      <div class="content">
        <div class="contentBx">
          <h3>Wooden Furniture<br><span>Timeless warmth with lasting durability</span></h3>
        </div>

        <ul class="sci">
          <li style="--i:1"><a href="#"><i class="fab fa-facebook"></i></a></li>
          <li style="--i:2"><a href="#"><i class="fab fa-twitter"></i></a></li>
          <li style="--i:3"><a href="#"><i class="fab fa-instagram"></i></a></li>
        </ul>

      </div>
    </div>

  </div>

</div>

</html>