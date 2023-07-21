<?php
session_start();

function calculateTotal (){

  $total_quantity = 0;

    foreach($_SESSION['cart'] as $key => $values){

      $product = $_SESSION['cart'][$key];

      $quantity = $product['product_quantity'];

      
      $total_quantity = $total_quantity + $quantity;
    }
   
   $_SESSION['quantity'] = $total_quantity;
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
  <link rel="stylesheet" href="assets/css/accueil.css">
</head>

<body>
	  <!--Navbar-->
    <header>
    <nav class="navbar navbar-expand-lg bg-dark">
      <div class="container">
        <div class="w-100 d-flex justify-content-between">
          <div>
            <i class="fa-solid fa-envelope text-light contact-info"></i>
            <a href="mailto:info@leodisplay.com" class="navbar-sm-brand text-light text-decoration-none contact-info">info@leodisplay.com</a>
            <i class="fa-solid fa-phone contact-info text-light"></i>
            <a href="" class="navbar-sm-brand text-white text-decoration-none contact-info">(+216) 73 277 997 /(+216) 98 319 329 /(+216) 93 099 393</a>
          </div>
          <div>
            <a href="" class="text-white"><i class="fa-brands fa-facebook me-2"></i></a>
            <a href="" class="text-white"><i class="fa-brands fa-whatsapp me-2"></i></a>
          </div>
        </div>
      </div>
    </nav>
  </header>
  <header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container d'flex justify-content-between">
        <div>
        <a href="accueil.php" style="text-decoration:none;"><h1 class="text-success brand-title">LeoDisplay</h1></a>
        </div>
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
          <div class="container-fluid">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item nav-items">
                  <a class="nav-link nav-links" aria-current="page" href="accueil.php">Accueil</a>
                </li>
                <li class="nav-item nav-items">
                  <a class="nav-link nav-links" href="#mainBox">About</a>
                </li>
                <li class="nav-item nav-items">
                  <a class="nav-link nav-links" href="#shop">Shop</a>
                </li>
                <li class="nav-item nav-items">
                  <a class="nav-link nav-links" href="contact.php">Contact</a>
                </li>
              </ul>
              <!-- add_product -->
              <div class="position-relative">
                  <form action="cart.php" method="POST">
                  <!-- <i class="fa-solid fa-cart-arrow-down nav-icon"></i> -->
                  <button type="submit" class="submit-btn" name="cart_btn" style="  border:none;  background-color: transparent;">
                     <i class="fa-solid fa-cart-arrow-down nav-icon"></i>
                  </button>
                <a href="login.php" class="text-decoration-none text-dark">
                  <i class="fa-solid fa-user nav-icon"></i>
                </a>
                  </form>
              </div>
              <div class="position-absolute rounded-circle cart"><?php if(isset($_SESSION['quantity']) && $_SESSION['quantity'] != 0){?>
                    <span><?php echo $_SESSION['quantity']; ?></span>
                  <?php }?></div>
              <div class="position-absolute rounded-circle user"><span></span></div>
            </div>
          </div>
        </nav>
      </div>
    </nav>

  </header>

  <section class="home">
    <div class="background" style="background-image: url('../imgs/HP-Stitch-S500.jpg'); z-index:2; !important">
    <div class="">
      <!-- <h5> New Arrivals</h5> -->
      <h1>Sublimation sur supports textiles <br><span>HP Stitch S500</span></h1>
      <p>LeoDisplay est specialisé dans l'impression numérique sur textile. <br>Nous avons recours a la sublimation depuis de nombreuses années déja. Les toiles sont imprimées en 4 couleurs sur notre imprimante HP Stitch S500 et ensuite fixées sur la calandre, ce qui rend la matière résistante aux UV et a l"eau. De plus, l'impression par sublimation offre une palette de couleurs intenses ainsi qu'un transfert parfait lors de l'impression sur des toiles de drapeaux.</p>
      <a href="#shop"><button>Passez votre commande maintenant</button></a>
    </div>
    </div>
  </section>


  <!-- display small text dexcribing the products  -->
  <section id="mainBox">
    <div class="row ">

      <div class="box col-lg-4 col-md-12 col-sm-12 ">
        <div class="boxDetails ">
          <h3>Mise en place rapide et facile</h3>
          <p>D'une façon générale les produits LEO DISPLAY sont conçus pour être transportés, montés et démontés par une seule personne.</p>
        </div>
      </div>
      <div class="box col-lg-4 col-md-12 col-sm-12 ">
        <h3>Visuel personnalisable</h3>
        <p>
          Tous vos visuels peuvent être traités et imprimés avec des supports dédiés pour chaque besoin et pour chaque support publicitaire.
        </p>
      </div>
      <div class="box col-lg-4 col-md-12 col-sm-12 ">
        <h3>Dimension sur-mesure</h3>
        <p>
          À parts les dimensions standard que nous proposons, nous pouvons toutefois réaliser des supports sur-mesure qui s’adaptent à votre espace.</p>
      </div>

    </div>
  </section>
  <h1 id="shop" style="margin-left:510px; margin-bottom:30px; color: orange">Choisissez vos produits <i class="fa-solid fa-arrow-down fa-bounce" style="color: orange;"></i></h1><span></span>
  <!-- display small text dexcribing the products  -->
  <section id='new' class="w-100">

  <style>
  .product-box {
    cursor: pointer;
  }
</style>

<div class="row p-0 m-0">
  <?php include('server/get_products.php'); ?>
  <?php while ($row = $products->fetch_assoc()) { ?>
    <div class="one col-lg-4 col-md-12 col-sm-12 p-0 product-box" onclick="submitForm('<?php echo $row['product_id']; ?>')">
      <img class="img-fluid" src="<?php echo $row['product_image'] ?>" alt="Flag">
      <div class="details">
        <h2><?php echo $row['product_name'] ?> <?php echo $row['product_id'] ?> </h2>
        <p> <?php echo $row['product_description'] ?></p>
        <form id="productForm<?php echo $row['product_id']; ?>" action="single_product<?php echo $row['product_id'] ?>.php" method="GET">
          <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
        </form>
      </div>
    </div>
  <?php } ?>
</div>

<script>
  function submitForm(productID) {
    var formID = "productForm" + productID;
    document.getElementById(formID).submit();
  }
</script>
  </section>
  <!-- footer  -->

  <footer class="footer">
    <div class="container">
      <div class="row">
        <h2 style="color: #ffffff; padding-bottom: 50px; text-align: center;">Trouver nos revendeurs :</h2>

        <div class="footer-col">
          <h4>S3P Distribution Tunis</h4>
          <ul>
            <li>
              <p>E-mail : s3ptunis.contact@gmail.com</p>
            </li>
            <li>
              <p>Tel : +216 58 402 416</p>
            </li>
            <li>
              <p>Adresse : 21 Cité ennour, 2080 Ariana, Tunisie</p>
            </li>
          </ul>
        </div>

        <div class="footer-col">
          <h4>S3P Distribution Sousse</h4>
          <ul>
            <li>
              <p>E-mail : s3p.contact@gnet.tn</p>
            </li>
            <li>
              <p>Tel : +216 58 306 649</p>
            </li>
            <li>
              <p>Adresse : 9 Avenue de la Cité Olympique 4000 Sousse, Tunisie</p>
            </li>
          </ul>
        </div>

        <div class="footer-col">
          <h4>S3P Distribution Sfax</h4>
          <ul>
            <li>
              <p>E-mail : s3p.sfax@gnet.tn</p>
            </li>
            <li>
              <p>Tel : +216 56 114 500</p>
            </li>
            <li>
              <p>Adresse : Z.I. Poudriere 1, Rue 13 Aout 5000 Sfax, Tunisie</p>
            </li>
          </ul>
        </div>

      </div>
    </div>

    <!--<hr style="border: none; height: 2px; background-color: #ffffff;">-->

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