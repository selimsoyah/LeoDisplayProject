<?php

session_start();

include('server/connection.php');


if(!isset($_SESSION['logged_in'])){
  header('location: login.php');
  exit;

}

if(isset($_GET['logout'])){
  if(isset($_SESSION['logged_in'])){
    unset($_SESSION['logged_in']);
    unset($_SESSION['user_email']);
    unset($_SESSION['user_name']);

    header('location: login.php');
    exit;
  }
}



if(isset($_POST['change_password'])){
  $password = $_POST['password'];
  $confirmPassword = $_POST['confirmPassword'];
  $user_email = $_SESSION['user_email'];

  
  // If password don't match
  if ($password !== $confirmPassword) {
    header('location: account.php?error=password dont match');
  } 
  // If password is less than 6 characters
  else if (strlen($password) < 6) {  
    header('location: account.php?error=password must be at least 6 characters');
  }

    //no errors
    else{

      $stmt = $conn->prepare("UPDATE users SET user_password = ? WHERE user_email = ?");
      $stmt->bind_param('ss', md5($password), $user_email);

      if($stmt->execute()){
        header('location: account.php?message=Password has been updated successfully');
        
      }else{
        header('location: account.php?error=Could not update the password');
      }

    }

}


//get orders
if(isset($_SESSION['logged_in'])){

  $user_id = $_SESSION['user_id'];
  $stmt = $conn->prepare("SELECT * FROM orders WHERE user_id=? ");

  $stmt->bind_param('i', $user_id);
  $stmt->execute();

  $orders = $stmt->get_result();
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
                  <a class="nav-link nav-links" href="#">About</a>
                </li>
                <li class="nav-item nav-items">
                  <a class="nav-link nav-links" href="#">Shop</a>
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
              <div class="position-absolute rounded-circle cart"><span>7</span></div>
              <div class="position-absolute rounded-circle user"><span>+99</span></div>
            </div>
          </div>
        </nav>
      </div>
    </nav>

  </header>

      <section class="my-5 py-5">
        <div class="row container mx-auto">
            <div class="text-center mt-3 pt-5 col-lg-6 col-md-12 col-sm-12">
              <p class="text-center" style="color:green;"><?php  if(isset($_GET['register_success'])){echo $_GET['register_success']; }   ?></p>
              <p class="text-center" style="color:green;"><?php  if(isset($_GET['login_success'])){echo $_GET['login_success']; }   ?></p>
                <h3 class="font-weight-bold">Account Info</h3>
                <hr class="mx-auto">
              <div class="account-info">
                <p>Name : <span><?php if(isset($_SESSION['user_name'])){ echo $_SESSION['user_name']; } ?></span></p>        
                <p>Email : <span><?php if(isset($_SESSION['user_email'])){ echo $_SESSION['user_email']; }?></span></p>
                <p><a href="" id="orders-btn">Your Orders</a></p>     
                <p><a href="account.php?logout=1" id="logout-btn">Logout</a></p>          
              </div>
            </div>

            <div class="  mt-3 pt-4 col-lg-6 col-md-12 col-sm-12">
                <form id="account-form" method="POST" action="account.php">
                  <p class="text-center" style="color:red;"><?php  if(isset($_GET['error'])){echo $_GET['error']; }   ?></p>
                  <p class="text-center" style="color:green;"><?php  if(isset($_GET['message'])){echo $_GET['message']; }   ?></p>
                    <h3>Change Password</h3>
                    <hr class="mx-auto">
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" id="account-password" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" class="form-control" id="account-password-confirm" name="confirmPassword" placeholder="Confirm Password">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Change Password" name="change_password" class="btn" id="change-pass-btn">
                    </div>
                  </form>
            </div>
        </div>
      </section>

      <section id="orders" class="orders container my-5 py3">
        <div class="container mt-2">
          <h2 class="font-weight-bold text-center">Your Orders</h2>
          <hr class="mx-auto">
        </div>

        <table class="mt-5 py-5">

          <tr>
            <th>Order id</th>
            <th>Order cost</th>
            <th>Order status</th>
            <th>Order date</th>
            <th>Order details</th>
          </tr>


          <?php  while($row = $orders->fetch_assoc()){   ?>

          <tr>
            <td>
              <!--<div class="product-info">
                <img src="assets/imgs/StandModulaire.png" alt="StandModulaire">
                  <div>
                    <p class="mr-3"><?php echo $row['order_id'];  ?></p>
                  </div>
              </div> -->
              <span> <?php echo $row['order_id'];  ?> </span>
            </td>

            <td>
              <span> <?php echo $row['order_cost'];  ?> </span>
            </td>

            <td>
              <span> <?php echo $row['order_status'];  ?> </span>
            </td>

            <td>
              <span> <?php echo $row['order_date'];  ?> </span>
            </td>

            <td>
              <form action="">
                <input type="submit" class="btn order-details-btn" value="details">
              </form>
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