<?php


session_start();


if (isset($_POST['remove_product'])) {
  $product_id = $_POST['product_id'];
  foreach ($_SESSION['cart'] as $key => $product) {
    if ($product['product_id'] === $product_id) {
      unset($_SESSION['cart'][$key]);
      break;
    }
  }
  calculateTotal();
} elseif (isset($_POST['edit_btn'])) {
  $product_id = $_POST['product_id'];
  $product_quantity = $_POST['product_quantity'];

  foreach ($_SESSION['cart'] as &$product) {
    if ($product['product_id'] === $product_id) {
      $product['product_quantity'] = $product_quantity;
      break;
    }
  }

  calculateTotal();
} elseif (isset($_POST['cart_btn'])) {
  // Retrieve the cart data from the session
  $cart_data = $_SESSION['cart'] ?? array();
  // Display the cart data
  foreach ($cart_data as $product) {
    // Display each product in the cart
    // ...
  }
} else {
  header('location: accueil.php');
}

function calculateTotal()
{

  $total_price = 0;
  $total_quantity = 0;

  foreach ($_SESSION['cart'] as $key => $values) {

    $product = $_SESSION['cart'][$key];
    $price = $product['product_price'];
    $quantity = $product['product_quantity'];

    $total_price = $total_price + ($price * $quantity);
    $total_quantity = $total_quantity + $quantity;
  }
  $_SESSION['total'] = $total_price;
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
  <link rel="stylesheet" href="assets/css/cart.css">
</head>

<body>
  <!--Navbar-->
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
                  <a class="nav-link nav-links" aria-current="page" href="accueil.php">Accueil</a>
                </li>
                <li class="nav-item nav-items">
                  <a class="nav-link nav-links" href="#mainBox">About</a>
                </li>
                <li class="nav-item nav-items">
                <a class="nav-link nav-links" href="accueil.php#new">Shop</a>
                </li>
                <li class="nav-item nav-items">
                  <a class="nav-link nav-links" href="contact.php">Contact</a>
                </li>
              </ul>
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
              <div class="position-absolute rounded-circle cart"><?php if (isset($_SESSION['quantity']) && $_SESSION['quantity'] != 0) { ?>
                  <span><?php echo $_SESSION['quantity']; ?></span>
                <?php } ?>
              </div>
              <div class="position-absolute rounded-circle user"><span></span></div>
            </div>
          </div>
        </nav>
      </div>
    </nav>

  </header>

  <!--Cart-->
  <section class="cart container my-5 py-5">
    <div class="container mt-5">
      <h2 class="font-weight-bolde">Your Cart</h2>
      <hr>
    </div>
    <table class="mt-5 pt-5">
      <tr>
        <th>Product</th>
        <th style="text-align: center;">Details</th>
        <th></th>
      </tr>

      <?php if (isset($_SESSION['cart'])) { ?>

        <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
          <tr>
            <td style="width:200px; display:flex;">
              <div class="product-info">
                <img src="<?php echo $value['product_image'] ?>" alt="#">
                <div>
                  <br>
                  <form method="POST" action='cart.php'>
                    <input type='hidden' name="product_id" value="<?php echo $value['product_id'] ?>" />
                    <input type='submit' name="remove_product" class="remove-btn" value='remove' style="    color: white;
    background-color: orange;
    border:none;
    text-decoration: none;
    font-size: 14px;
    padding:5px;
    border-radius:5px;" />
                  </form>
                </div>
              </div>
            </td>

            <td style="font-size:20px;">
              <form action="cart.php" method="POST">
                <!-- <input type='hidden' name="product_id" value="<?php echo $value['product_id'] ?>" /> -->
                <div class="cart_items" style="display: flex; ">
                  <?php if ($value['option1'] !== null) : ?>
                    <span class="product-price"><?php echo $value['option1'] ?></span>

                    <?php if ($value['option2'] !== null) : ?>
                      <span class="product-price"><?php echo $value['option2'] ?></span><span> X</span>
                    <?php endif; ?>
                  <?php endif; ?>
                  <?php if ($value['quantity_2'] !== "0") : ?>
                    <span class="product-price"><?php echo $value['quantity_2'] ?></span>
                  <?php endif; ?>
                  <?php if ($value['option3'] !== null) : ?>
                    <span class="product-price"><?php echo $value['option3'] ?></span><span> X</span>
                  <?php endif; ?>
                  <?php if ($value['quantity_3'] !== "0") : ?>
                    <span class="product-price"><?php echo $value['quantity_3'] ?></span>
                  <?php endif; ?>
                  <?php if ($value['option5'] !== 0) : ?>
                    <?php if ($value['option5'] == "1") : ?>
                      <span class="product-price">Avec Bare Metalique</span><span> X</span>
                    <?php endif; ?>
                    <?php if ($value['option5'] == "0") : ?>
                      <span class="product-price">Sans Bare Metalique</span>
                    <?php endif; ?>
                  <?php endif; ?>
                  <?php if ($value['quantity_5'] !== "0") : ?>
                    <span class="product-price"><?php echo $value['quantity_5'] ?></span>
                  <?php endif; ?>
                  <?php if ($value['option4'] !== null) : ?>
                    <img src="data:image/jpeg;base64,<?php echo base64_encode($value['option4']) ?>" alt="Product Image" style="width: 100px; height: 100px; position:absolute; right:120px;">
                 <?php endif; ?>
                </div>

                <!-- <input type="submit" class="edit-btn" name="edit-btn" value="Edit" > -->
              </form>
            </td>



          </tr>
        <?php } ?>

      <?php } ?>

    </table>
    <style>
      .cart_items span {
        padding: 10px;
        /* background-color: red; */
      }
    </style>
    </div>

    <div class="checkout-container">
      <form method="POST" action="server/place_order.php">
        <input type='hidden' name="product_id" value="<?php echo $value['product_id'] ?>" />
        <input type="submit" class="btn checkout-btn" value="Checkout" name="place_order">
      </form>
      <form action="single_product<?php echo $value['product_id'] ?>.php" method="GET">
        <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
        <button type="submit" class="btn checkout-btn">Ajouter Un Autre Produit</button>
      </form>
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