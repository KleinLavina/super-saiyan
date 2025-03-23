<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Francis Martin Fits</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<style>
 
</style>
<body>

<?php include "elements/header.php" ?>

<?php include "elements/nav.php" ?>
  

<div class="all-content">
  <?php 
	if (isset($_GET['page'])) {
		$pg = $_GET['page'];
			if ($pg == "home") {
				include "pages/home.php";
				}
				elseif ($pg == "products") {
				include "pages/products.php";
				}
        elseif ($pg == "purchase") {
          include "pages/purchase.php";
          }
          elseif ($pg == "cart") {
            include "pages/cart.php";
            }
				elseif ($pg == "login") {
				include "pages/login.php";
				}
        elseif ($pg == "signup") {
        include "pages/signup.php";
        }
        elseif ($pg == "cart") {
        include "pages/cart.php";
        }
                else {
                    include "pages/home.php";
                        }
            } else { 
                include "pages/home.php";
            }	
                ?>
</div>

<?php include "elements/footer.php" ?>
</body>
</html>
