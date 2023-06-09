<?php 

session_start();

if( !empty($_SESSION['cart']) && isset($_POST['checkout'])){

//let user in

}else{
  //send user to home page
  header('location: accueil.php');

}









?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/bf14b68fbc.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/checkout.css">

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

    <!--Checkout-->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-3">
          <h2 class="form-weight-bold">Check Out</h2>
          <hr class="mx-auto line">

          <div class="mx-auto container">
            <form id="checkout-form" methode="POST" action="server/place_order.php">

              <div class="form-group checkout-small-element">
                <label>Name</label>
                <input type="text" class="form-control" id='checkout-name' name="name" placeholder="Name" required>      
              </div>

              <div class="form-group checkout-small-element">
                <label>Email</label>
                <input type="email" class="form-control" id='checkout-email' name="email" placeholder="Email" required>
              </div>

              <div class="form-group checkout-small-element">
                <label>Phone</label>
                <input type="tel" class="form-control" id='checkout-phone' name="phone" placeholder="Phone" required>
              </div>

              <div class="form-group checkout-small-element">
                <label>City</label>
                <input type="text" class="form-control" id='checkout-city' name="city" placeholder="City" required>
              </div>

              <div class="form-group checkout-large-element">
                <label>Address</label>
                <input type="text" class="form-control" id='checkout-address' name="address" placeholder="Address" required>
              </div>
              
              <div class="form-group checkout-btn-container">
                <p>Total: Dt <?php echo $_SESSION[$total]?></p>
                <input type="submit" class="btn" id="checkout-btn" name="place_order" value="Place Order">
              </div>
            </form>
          </div>
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