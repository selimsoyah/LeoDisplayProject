<?php

session_start();
include('server/connection.php');

//if user already registred then take user to account page
//   if(isset($_SESSION['logged_in'])){

//     header('location: account.php');
//     exit;

// }


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
            
            // $hashedPassword = password_hash($password, PASSWORD_DEFAULT); // Hash the password
            $stmt->bind_param('sss', $name, $email, md5($password));

            // If account was created successfully
            if ($stmt->execute()) {
                $user_id = $stmt->insert_id;
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_email'] = $email;
                $_SESSION['user_name'] = $name;
                $_SESSION['logged_in'] = true;

                header('location: admin/index.php?register_success=You registered successfully');
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
    <style>
      /* Additional CSS styles for the phone number and address */
      .contact-info {
        position: fixed;
        top: 50%;
        right: 0;
        transform: translateY(-50%);
        background-color: #fff;
        padding: 20px;
        text-align: center;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }
    </style>
</head>
<body>
    <!--Navbar-->
    <header class="navbar navbar-dark sticky-top bg-dark fles-md-nowrap p-0 shadow">
      <a href="#" class="navbar-brand cold-md-3 col-lg-2 me-0 px-3">LeoDisplay admin</a> 
      <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggler="collapsed">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="navbar-nav">
        <div class="nav-item text-nowrap">
          <?php if(isset($_SESSION['admin_logged_in'])){ ?>
            <a href="logout.php?logout=1" class="nav-link px-3">Sign out</a>
          <?php } ?>
        </div>
      </div>
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

            <!-- Phone number and address inputs -->
            <div class="form-group">
              <label>Phone Number</label>
              <input type="tel" class="form-control" id='register-phone' name="phone" required>
            </div>
            <div class="form-group">
              <label>Address</label>
              <input type="text" class="form-control" id='register-address' name="address" required>
            </div>
            
            <div class="form-group">
              <input type="submit" class="btn" id="register-button" name="register" value="Register">
            </div>
          </form>
        </div>
      </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>
</html>
