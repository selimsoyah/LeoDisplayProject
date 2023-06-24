<?php
session_start();

if (isset($_POST['add_product'])) {
    $product_id = $_POST['product_id'];
    $product_image = $_POST['product_image'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_quantity = $_POST['product_quantity'];
    $option1 = $_POST['option1'];
    $option2 = $_POST['option2'];
    $option3 = $_POST['option3'];
    $imageName = $_FILES['option4']['name'];
    $imageTmpName = $_FILES['option4']['tmp_name'];
    $option4 = file_get_contents($imageTmpName);

    $product_array = array(
        'product_id' => $product_id,
        'product_image' => $product_image,
        'product_name' => $product_name,
        'product_price' => $product_price,
        'product_quantity' => $product_quantity,
        'option1' => $option1,
        'option2' => $option2,
        'option3' => $option3,
        'option4' => $option4,
    );

    $_SESSION['cart'][] = $product_array;

    calculateTotal();
} elseif (isset($_POST['remove_product'])) {
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

function calculateTotal (){

  $total_price = 0;
  $total_quantity = 0;

    foreach($_SESSION['cart'] as $key => $values){

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
                  <a class="nav-link nav-links" href="#new">Shop</a>
                </li>
                <li class="nav-item nav-items">
                  <a class="nav-link nav-links" href="contact.php">Contact</a>
                </li>
              </ul>
              <div class="position-relative">
                <a href="cart.php" class="text-decoration-none text-dark ">
                  <i class="fa-solid fa-cart-arrow-down nav-icon"></i>
                </a>
                <a href="login.php" class="text-decoration-none text-dark">
                  <i class="fa-solid fa-user nav-icon"></i>
                </a>
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

            <?php foreach($_SESSION['cart'] as $key => $value){?>
            <tr>
                <td>
                    <div class="product-info">
                        <img src="<?php echo $value['product_image'] ?>" alt="#">
                    <div>
                        <p><?php echo $value['product_name'] ?></p>
                        <small><span>Dt</span><?php echo $value['option1'] ?></small>
                        <br>
                          <form method="POST" action='cart.php'>
                            <input type='hidden' name="product_id" value="<?php echo $value['product_id'] ?>" />
                            <input type='submit' name="remove_product" class="remove_btn" value='remove' />
                          </form>
                    </div>
                </div>
            </td>

            <td>
                <form action="cart.php" method="POST">
                    <input type='hidden' name="product_id" value="<?php echo $value['product_id'] ?>" />
                    <input type="number" name='product_quantity' value="<?php echo $value['product_quantity'] ?>">
                    <input type="submit" class="edit-btn" name="edit-btn" value="Edit" >
                </form>
            </td>

            <td>
                <span>Dt</span>
                <span class="product-price"><?php echo $value['product_price']*$value['product_quantity'] ?></span>
            </td>

            </tr>
  <?php } ?>
            </table>
        </div>

        <div class="checkout-container">
          <form method="POST" action="checkout.php">
          <input type='hidden' name="product_id" value="<?php echo $value['product_id'] ?>" />
            <input type="submit" class="btn checkout-btn" value="Checkout" name="checkout">
          </form>
          <form action="single_product<?php echo $value['product_id'] ?>.php" method="GET">
              <input type="hidden" name="product_id" value="<?php echo $value['product_id']; ?>">
              <button type="submit" class="text-uppercase">Ajouter Un Autre Produit</button>
            </form>
        </div>
              <div class="cart-total">
                <table>
                  <tr>
                    <td>Total</td>
                    <td><?php echo $_SESSION['total'] ?></td>
                  </tr>
                </table>
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