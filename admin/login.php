<?php

session_start();

include('../server/connection.php');

if(isset($_SESSION['admin_logged_in'])){
  header('location: index.php');
  exit;
}


if(isset($_POST['login_btn'])){


  $email = $_POST['email'];
  $password = md5($_POST['password']);
  
  $stmt =$conn->prepare("SELECT admin_id, admin_name, admin_email, admin_password FROM admin WHERE admin_email = ? AND admin_password = ? LIMIT 1");

  $stmt-> bind_param('ss', $email, $password);

  if($stmt->execute()){

    $stmt->bind_result($admin_id, $admin_name, $admin_email, $admin_password);
    $stmt->store_result();

      if($stmt->num_rows() == 1){
        $row = $stmt->fetch();

        $_SESSION['admin_id'] = $user_id;
        $_SESSION['admin_name'] = $user_name;
        $_SESSION['admin_email'] = $user_email;
        $_SESSION['admin_logged_in'] = true;

        header('location: index.php?login_success=Logged in successfully');

      }else{
        header('location: login.php?error=Could not verify your account');
      }
  }else{
    //error
    header('location: login.php?error= Something went wrong');
  }


}



?>


<!DOCTYPE html>
<html>
<head>
  <title>Admin Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
    }

    h1 {
      text-align: center;
    }

    .login-form {
      max-width: 300px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .form-group {
      margin-bottom: 10px;
    }

    .form-group label {
      display: block;
      margin-bottom: 5px;
      font-weight: bold;
    }

    .form-group input {
      width: 100%;
      padding: 5px;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    .form-group button {
      width: 100%;
      padding: 10px;
      background-color: #4CAF50;
      color: #fff;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <h1>Admin Login</h1>
  <div class="login-form">
    <form method="POST" action="login.php">
      <div class="form-group">
        <label for="username">Email:</label>
        <input type="text" id="username" name="email" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div class="form-group">
        <button type="submit" name="login_btn">Login</button>
      </div>
    </form>
  </div>
</body>
</html>
