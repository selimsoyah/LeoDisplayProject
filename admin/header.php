<?php

session_start();

?>


<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  </head>
  <body>

  <header class="navbar navbar-dark sticky-top bg-dark fles-md-nowrap p-0 shadow">
    <a href="#" class="navbar-brand cold-md-3 col-lg-2 me-0 px-3">Company name</a> 
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
  </body>
</html>

  