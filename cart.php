<?php 

  session_start();

  if(isset($_POST['add_product'])){
    $product_array_ids = array_column ($_SESSION['cart'],'product_id');
      if (!in_array($_POST['product_id'],$product_array_ids)){

       

        $product_array = array (
           'product_id'=> $_POST['product_id'],
           'product_image'=> $_POST['product_image'],
           'product_name'=> $_POST['product_name'],
           'product_price'=> $_POST['product_price'],
           'product_quantity'=> $_POST['product_quantity'],
        );

        $_SESSION['cart'][$product_id] = $product_array;


      }else{
          echo '<script>alert("Product was already to cart ")</script>';
          echo '<script>window.location="accueille.php"</script>';

      }
    if(isset($_SESSION['cart'])){

      }else{

        $product_id = $_POST['product_id'];
        $product_image = $_POST['product_image'];
        $product_name = $_POST['product_name'];
        $product_price = $_POST['product_price'];
        $product_quantity = $_POST['product_quantity'];

        $product_array = array (
           'product_id'=> $product_id,
           'product_image'=> $product_image,
           'product_name'=> $product_name,
           'product_price'=> $product_price,
           'product_quantity'=> $product_quantity,
        );

        $_SESSION['cart'][$product_id] = $product_array;

      }
  }else{
    header('location:accueille.php');
  }


?>





<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LeoDisplay</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/bf14b68fbc.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/cart.css">
</head>
<body>
	<!---first nav-->
	<header>
		<nav class="navbar navbar-expand-lg bg-dark">
			<div class="container">
				<div class="w-100 d-flex justify-content-between">
					<div>
						<i class="fa-solid fa-envelope text-light contact-info"></i>
						<a href="" class="navbar-sm-brand text-light text-decoration-none contact-info">info@company.com</a>
						<i class="fa-solid fa-phone contact-info text-light"></i>
						<a href="" class="navbar-sm-brand text-white text-decoration-none contact-info">920-510-42</a>
					</div>
					<div>
						<a href="" class="text-white"><i class="fa-brands fa-facebook me-2"></i></a>
						<a href="" class="text-white"><i class="fa-brands fa-whatsapp me-2"></i></a>
					</div>
				</div>
			</div>
		</nav>
	</header>
	<!---end first nav-->
	<!---main nav-->
	<header>
	<nav class="navbar navbar-expand-lg bg-body-tertiary">
		<div class="container d'flex justify-content-between">
			<div>
				<h1 class="text-success brand-title">LeoDisplay</h1>
			</div>
			<nav class="navbar navbar-expand-lg bg-body-tertiary">
				<div class="container-fluid">
				  <div class="collapse navbar-collapse" id="navbarSupportedContent">
					<ul class="navbar-nav me-auto mb-2 mb-lg-0">
					  <li class="nav-item nav-items">
						<a class="nav-link nav-links" aria-current="page" href="accueil.html">Accueil</a>
					  </li>
					  <li class="nav-item nav-items">
						<a class="nav-link nav-links" href="#">About</a>
					  </li>
					  <li class="nav-item nav-items">
						<a class="nav-link nav-links" href="#">Shop</a>
					  </li>
					  <li class="nav-item nav-items">
						<a class="nav-link nav-links" href="#">Contact</a>
					  </li>
					</ul>
					<div class="position-relative">
						<a href="cart.html" class="text-decoration-none text-dark ">
							<i class="fa-solid fa-cart-arrow-down nav-icon"></i>
						</a>
						<a href="login.html" class="text-decoration-none text-dark">
							<i class="fa-solid fa-user nav-icon"></i>
						</a>
					</div>
					<div class="position-absolute rounded-circle cart"><span>7</span></div>
					<div class="position-absolute rounded-circle user"><span>+99</span></div>
				  </div>
				</div>
			  </nav>	
		</div>
	  </nav>
	  
	</header>
	<!---main nav end-->

    <!--Cart-->
    <section class="cart container my-5 py-5">
        <div class="container mt-5">
            <h2 class="font-weight-bolde">Your Cart</h2>
            <hr>
        </div>
        <table class="mt-5 pt-5">
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Subtotal</th>
            </tr>
            <tr>
                <td>
                    <div class="product-info">
                        <img src="#" alt="#">
                    <div>
                        <p>Flag</p>
                        <small><span>Dt</span>200</small>
                        <br>
                        <a href="" class="remove-btn">Remove</a>
                    </div>
                </div>
            </td>

            <td>
                <input type="number" value="1">
                <a href="" class="edit-btn">Edit</a>
            </td>

            <td>
                <span>Dt</span>
                <span class="product-price">200</span>
            </td>

            </tr>

            <tr>
                <td>
                    <div class="product-info">
                        <img src="#" alt="#">
                    <div>
                        <p>Flag</p>
                        <small><span>Dt</span>200</small>
                        <br>
                        <a href="" class="remove-btn">Remove</a>
                    </div>
                </div>
            </td>

            <td>
                <input type="number" value="1">
                <a href="" class="edit-btn">Edit</a>
            </td>

            <td>
                <span>Dt</span>
                <span class="product-price">200</span>
            </td>

            </tr>

            <tr>
                <td>
                    <div class="product-info">
                        <img src="#" alt="#">
                    <div>
                        <p>Flag</p>
                        <small><span>Dt</span>200</small>
                        <br>
                        <a href="" class="remove-btn">Remove</a>
                    </div>
                </div>
            </td>

            <td>
                <input type="number" value="1">
                <a href="" class="edit-btn">Edit</a>
            </td>

            <td>
                <span>Dt</span>
                <span class="product-price">200</span>
            </td>
        </tr>
        </table>

        <div class="cart-total">
            <table>
                <tr>
                    <td>Subtotal</td>
                    <td>Dt1000</td>
                </tr>

                <tr>
                    <td>Total</td>
                    <td>Dt1000</td>
                </tr>
            </table>
        </div>

        <div class="checkout-container">
            <a href="checkout.html"><button class="btn checkout-btn">Checkout</button></a>
        </div>


    </section>



      <!--Footer-->
      <footer class="footer">
        <div class="container">
          <div class="row">
            <h2 style="color: #ffffff; padding-bottom: 50px; text-align: center;">Trouver nos revendeurs :</h2>

            <div class="footer-col">
              <h4>S3P Distribution Tunis</h4>
              <ul>
                <li><p>E-mail : s3ptunis.contact@gmail.com</p></li>
                <li><p>Tel : +216 58 402 416</p></li>
                <li><p>Adresse : 21 Cité ennour, 2080 Ariana, Tunisie</p></li>
              </ul>
            </div>

            <div class="footer-col">
              <h4>S3P Distribution Sousse</h4>
              <ul>
                <li><p>E-mail : s3p.contact@gnet.tn</p></li>
                <li><p>Tel : +216 58 306 649</p></li>
                <li><p>Adresse : 9 Avenue de la Cité Olympique 4000 Sousse, Tunisie</p></li>
              </ul>
            </div>

            <div class="footer-col">
              <h4>S3P Distribution Sfax</h4>
              <ul>
                <li><p>E-mail : s3p.sfax@gnet.tn</p></li>
                <li><p>Tel : +216 56 114 500</p></li>
                <li><p>Adresse : Z.I. Poudriere 1, Rue 13 Aout 5000 Sfax, Tunisie</p></li>
              </ul>
            </div>

          </div>
        </div>

        <hr style="border: none; height: 2px; background-color: #ffffff;">
       
      </footer>
    
      <div class="footer-bottom">
        <div class="content">
          <div class="child">
          <a href="#"><i class="fab fa-facebook-f"></i></a>
          </div>

          <div class="child">
          <img src="#" alt="#">
          </div>

          <div class="child">
          <p>© 2023 VORTECH Media. All Rights Reserved.</p>
          </div>
        </div>
      </div>
      
      
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>   

    </body>
    </html>