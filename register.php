<?php
session_start();
include('server/connection.php');

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // If password don't match
    if ($password !== $confirmPassword) {
        header('location: register.php?error=password dont match');
    } 
    // If password is less than 6 characters
    else if (strlen($password) < 6) {  
        header('location: register.php?error=password must be at least 6 characters');
    } 
    // If there is no error
    else {
        // Check whether there is a user with this email or not
        $stmt1 = $conn->prepare("SELECT count(*) FROM users WHERE user_email=?");
        $stmt1->bind_param('s', $email);
        $stmt1->execute();
        $stmt1->bind_result($num_rows);
        $stmt1->store_result();
        $stmt1->fetch();

        // If there is a user registered with this email
        if ($num_rows != 0) { 
            header('location: register.php?error=user with this email already exists');
        } 
        // If no user registered with this email before
        else {
            // Create new user
            $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_password)
                VALUES (?, ?, ?)");
            
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password
            $stmt->bind_param('sss', $name, $email, $hashedPassword);

            // If account was created successfully
            if ($stmt->execute()) {
                $_SESSION['user_email'] = $email;
                $_SESSION['user_name'] = $name;
                $_SESSION['logged_in'] = true;

                header('location: account.php?register=You registered successfully');
            } 
            // Account could not be created
            else {
                header('location: register.php?error=Could not create an account at the moment');
            }
        }
    }
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
    <link rel="stylesheet" href="assets/css/register.css">
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



      <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-3">
          <h2 class="form-weight-bold">Registration</h2>
          <hr class="mx-auto line">
          <div class="mx-auto container">
            <form id="register-form" method="POST" action="register.php">

              <p style="color: red;">
                <?php
                  if(isset($_GET['error'])) {echo $_GET['error']; }
                ?>
              </p>

              <div class="form-group">
                <label>Name</label>
                <input type="text" class="form-control" id='register-name' name="name" required>
                   
              </div>
              <div class="form-group">
                <label>Email</label>
                <input type="email" class="form-control" id='register-email' name="email" required>
               
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" class="form-control" id='register-password' name="password" required>
              </div>
              <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" class="form-control" id='register-confirm-password' name="confirmPassword" required>
              </div>
              
              <div class="form-group">
                <input type="submit" class="btn" id="register-button" name="register" value="Register">
              </div>
              <div class="form-group">
                <a id="register-url" class="btn">Vous avez deja un compte ?</a>
              </div>
            </form>
          </div>
        </div>
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