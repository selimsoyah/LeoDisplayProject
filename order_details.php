
<?php 

session_start();

include("server/connection.php");

if (isset($_GET['order_details_btn']) && isset($_GET['order_id'])){

  $order_id = $_GET['order_id'];

  $stmt = $conn->prepare("SELECT * FROM order_items WHERE order_id=?");
  $stmt->bind_param('i',$order_id);
  $stmt->execute();

  $order_details = $stmt->get_result();


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
    <link rel="stylesheet" href="assets/css/account.css">
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

  <section id="orders" class="orders container my-5 py3">
        <div class="container mt-5">
          <h2 class="font-weight-bold text-center">Order Details</h2>
          <hr class="mx-auto">
        </div>

        <table class="mt-5 py-5 mx-auto">

          <tr>
            <th>Product Name :</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Type</th>
            <th>Taille</th>
            <th>Base</th>
            <th>Image</th>
          </tr>


          <?php while ($row = $order_details->fetch_assoc()){ ?>
  <tr>
    <td>
      <div class="product-infoo">
        <img src="<?php echo $row['product_image'] ?>" alt="StandModulaire">
        <div>
          <span class="mr-3"><?php echo $row['product_name'] ?></span>
        </div>
      </div>
    </td>

    <td>
      <?php if ($row['product_price'] !== null): ?>
        <span><?php echo $row['product_price'] ?></span>
      <?php endif; ?>
    </td>

    <td>
      <?php if ($row['product_quantity'] !== null): ?>
        <span><?php echo $row['product_quantity'] ?></span>
      <?php endif; ?>
    </td>

    <td>
      <?php if ($row['option1'] !== null && $row['quantity_1'] !== null): ?>
        <span><?php echo $row['option1'] ?> X <?php echo $row['quantity_1'] ?></span>
      <?php endif; ?>
    </td>

    <td>
      <?php if ($row['option2'] !== null && $row['quantity_2'] !== null): ?>
        <span><?php echo $row['option2'] ?> X <?php echo $row['quantity_2'] ?></span>
      <?php endif; ?>
    </td>

    <td>
      <?php if ($row['option3'] !== null && $row['quantity_3'] !== null): ?>
        <span><?php echo $row['option3'] ?> X <?php echo $row['quantity_3'] ?></span>
      <?php endif; ?>
    </td>

    <td>
      <?php if ($row['option4'] !== null): ?>
        <img src="data:image/jpeg;base64,<?php echo base64_encode($row['option4']) ?>" alt="Product Image" style="width: 100px; height: 100px;">
      <?php endif; ?>
    </td>
  </tr>
<?php } ?>



        </table>
      </section>

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