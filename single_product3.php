<?php

session_start();
include('server/connection.php');
$prixUTC = array(
  'Drapeau Courbé' => array(
    '2m50' => 42.260,
    '2m80' => 44.400,
    '3m20' => 47.000,
    '3m80' => 59.900,
    // ... Add other sizes and prices ...
  ),
  'Drapeau Droit' => array(
    '2m50' => 43.260,
    '2m80' => 45.600,
    '3m20' => 48.200,
    '3m80' => 61.000,
    // ... Add other sizes and prices ...
  ),
  'Drapeau Rectangulaire' => array(
    '2m50' => 51.200,
    '2m80' => 55.200,
    '3m20' => 61.800,
    '3m80' => 67.500,
    // ... Add other sizes and prices ...
  ),
  'base' => array(
    'Water Base' => 52.082,
    'Beton base' => 56.932,
    'Metal Base 7Kg' => 71.500,
    'Metal Base 7.5Kg' => 77.800,
    'Metal Base 10Kg' => 94.200,
    // ... Add other sizes and prices ...
  ),
  // ... Add other flag types and their prices ...
);
$prix20 = array(
  'Drapeau Courbé' => array(
    '2m50' => 35.900,
    '2m80' => 44.400,
    '3m20' => 47.000,
    '3m80' => 59.900,
    // ... Add other sizes and prices ...
  ),
  'Drapeau Droit' => array(
    '2m50' => 43.260,
    '2m80' => 45.600,
    '3m20' => 48.200,
    '3m80' => 61.000,
    // ... Add other sizes and prices ...
  ),
  'Drapeau Rectangulaire' => array(
    '2m50' => 44.300,
    '2m80' => 47.700,
    '3m20' => 53.300,
    '3m80' => 62.200,
    // ... Add other sizes and prices ...
  ),
  'base' => array(
    'Water Base' => 46.874,
    'Beton base' => 56.932,
    'Metal Base 7Kg' => 67.900,
    'Metal Base 7.5Kg' => 73.900,
    'Metal Base 10Kg' => 84.780,
    // ... Add other sizes and prices ...
  ),
  // ... Add other flag types and their prices ...
);
$prixImp = array(
  'Drapeau Courbé' => array(
    '2m50' => 54.266,
    '2m80' => 59.314,
    '3m20' => 74.458,
    '3m80' => 91.537,
    '4m50' => 119.637,
    '5m00' => 130.238,
    // ... Add other sizes and prices ...
  ),
  'Drapeau Droit' => array(
    '2m50' => 43260,
    '2m80' => 45600,
    '3m20' => 48200,
    '3m80' => 61000,
    // ... Add other sizes and prices ...
  ),
  'Drapeau Rectangulaire' => array(
    '2m50' => 47.900,
    '2m80' => 61.700,
    '3m20' => 82.400,
    '3m80' => 112.400,
    // ... Add other sizes and prices ...
  ),
  
 
);

if (isset($_GET['product_id']) || isset($_POST['add_product'])) {
  if (isset($_POST['add_product'])) {
    $product_id = $_POST['product_id'];
    $product_image = $_POST['product_image'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $option1 = isset($_POST['option1']) ? $_POST['option1'] : null;
    $option2 = isset($_POST['option2']) ? $_POST['option2'] : null;
    $option3 = isset($_POST['option3']) ? $_POST['option3'] : null;
    $option5 = isset($_POST['option5']) ? $_POST['option5'] : 0;
    $quantity_1 = isset($_POST['quantity_1']) ? $_POST['quantity_1'] : null;
    $quantity_2 = isset($_POST['quantity_2']) ? $_POST['quantity_2'] : null;
    $quantity_3 = isset($_POST['quantity_3']) ? $_POST['quantity_3'] : null;
    $quantity_5 = isset($_POST['quantity_5']) ? $_POST['quantity_5'] : null;
    if (!empty($_FILES['option4']['name'])) {
      $imageName = $_FILES['option4']['name'];
      $imageTmpName = $_FILES['option4']['tmp_name'];
      $option4 = file_get_contents($imageTmpName);
    } else {
      $option4 = null;
    }
    function calculateFlagPrice($option1, $option2,$option3,$quantity_3, $option4,$prixUTC,$prixImp,$quantity_2,$prix20) {
      
      if ($option4 == null) {
        $finalresult = 0.0;
    
        if ($quantity_2 <= 20 || $quantity_3 <= 20) {
            if (isset($prixUTC[$option1]) && isset($prixUTC[$option1][$option2])) {
                $result1 = $prixUTC[$option1][$option2];
                $finalresult = $finalresult + ($result1 * $quantity_2);
            }
    
            if (isset($prixUTC['base']) && isset($prixUTC['base'][$option3])) {
                $result2 = $prixUTC['base'][$option3];
                $finalresult = $finalresult + ($result2 * $quantity_3);
            }
        } elseif ($quantity_2 > 20 || $quantity_3 > 20) {
            if (isset($prix20[$option1]) && isset($prix20[$option1][$option2])) {
                $result3 = $prix20[$option1][$option2];
                $finalresult = $finalresult + ($result3 * $quantity_2);
            }
    
            if (isset($prix20['base']) && isset($prix20['base'][$option3])) {
                $result4 = $prix20['base'][$option3];
                $finalresult = $finalresult + ($result4 * $quantity_3);
            }
        }
    
        return $finalresult;
    }
    elseif ($option4 != null) {
      $finalresult = 0.0;
  
      if (isset($prixImp[$option1]) && isset($prixImp[$option1][$option2])) {
          $result1 = $prixImp[$option1][$option2];
          $finalresult = $finalresult + ($result1 * $quantity_2);
      }
  
      if ($quantity_3 <= 20) {
        if (isset($prixUTC['base']) && isset($prixUTC['base'][$option3])) {
            $result2 = $prixUTC['base'][$option3];
            $finalresult = $finalresult + ($result2 * $quantity_3);
        }
    } elseif ( $quantity_3 > 20) {
        if (isset($prix20['base']) && isset($prix20['base'][$option3])) {
            $result4 = $prix20['base'][$option3];
            $finalresult = $finalresult + ($result4 * $quantity_3);
        }
    }
      return $finalresult;
  }
      else {
        return 0; // Default flag price or error handling
      }
    }

    $flagPrice = calculateFlagPrice( $option1,$option2,$option3,$quantity_3,$option4,$prixUTC,$prixImp,$quantity_2,$prix20);

    $product_array = array(
      'product_id' => $product_id,
      'product_image' => $product_image,
      'product_name' => $product_name,
      'product_price' => $product_price,
      'option1' => $option1,
      'option2' => $option2,
      'option3' => $option3,
      'option4' => $option4,
      'option5' => $option5,
      'quantity_1' => $quantity_1,
      'quantity_2' => $quantity_2,
      'quantity_3' => $quantity_3,
      'quantity_5' => $quantity_5,
      'flagPrice'=>$flagPrice,
    );

    if (!empty($product_array)) {
      $_SESSION['cart'][] = $product_array;
    }


    
  }

  // calculateTotal();
  $product_id = 3;

  $request = $conn->prepare('SELECT * FROM products WHERE product_id = ? ');
  $request->bind_param("i", $product_id);

  $request->execute();
  $products = $request->get_result();
} else {

  header('location:accueil.php');
}






?>




<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>LeoDisplay</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
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
          <a href="accueil.php" style="text-decoration:none;">
            <h1 class="text-success brand-title">LeoDisplay</h1>
          </a>
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
                  <a class="nav-link nav-links" href="accueil.php#shop">Shop</a>
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


  <form action="single_product2.php" method="GET">
    <input type="hidden" name="product_id" value="2">
    <span class="arrow-label-left">Stand<br> Parapluie</span> <!-- Added label -->
    <button type='submit' class="arrow-button left-arrow">
      <i class="fas fa-chevron-left"></i>
    </button>
  </form>
  <!-- Right Arrow Button -->




  <script src="https://kit.fontawesome.com/bf14b68fbc.js" crossorigin="anonymous"></script>
  <script src="assets/js/main.js"></script>
  <style>
    .arrow-button {
      position: absolute;
      top: 70%;
      transform: translateY(-50%);
      width: 40px;
      height: 40px;
      background-color: #FFA500;
      color: #fff;
      border-radius: 50%;
      text-align: center;
      line-height: 40px;
      font-size: 18px;
      border: none;
      /* z-index: 999; */
    }

    .left-arrow {
      left: 10px;
    }

    .arrow-label-left {
      position: relative;
      top: 330px;
      /* Adjust this value as per your desired position */
      transform: translateY(-100%);
      /* Position above the button */
      left: 5px;
      /* Adjust this value to center the label */
      font-size: 14px;
      color: orange;
      /* Customize the label color */
    }
  </style>


  <style>
    /* Remove default arrow styles */
    input[type="number"] {
      -webkit-appearance: none;
      /* Safari and Chrome */
      -moz-appearance: textfield;
      /* Firefox */
      width: 50px;
      /* Adjust the width as needed */
      padding: 5px;
      text-align: center;
      border: 1px solid #ccc;
      background-color: white;
      /* Set the background color */
    }

    /* Custom "+" and "-" symbols */
    input[type="number"]::-webkit-inner-spin-button,
    input[type="number"]::-webkit-outer-spin-button {
      -webkit-appearance: none;
    }

    input[type="number"]::before {
      content: "+";
      /* Unicode for the plus symbol */
      position: absolute;
      top: 0;
      left: 0;
      width: 20px;
      height: 100%;
      text-align: center;
      line-height: 30px;
      background-color: black;
      border: 1px solid #ccc;
      border-right: none;
      cursor: pointer;
    }

    input[type="number"]::after {
      content: "-";
      /* Unicode for the minus symbol */
      position: absolute;
      top: 0;
      right: 0;
      width: 50px;
      height: 100%;
      text-align: center;
      line-height: 30px;
      background-color: #ddd;
      border: 1px solid #ccc;
      border-left: none;
      cursor: pointer;
    }

    /* Remove arrows for Firefox */
    input[type="number"] {
      -moz-appearance: textfield;
    }
  </style>


  <?php while ($row = $products->fetch_assoc()) { ?>

    <form method="POST" action='single_product3.php' enctype="multipart/form-data">
      <input type='hidden' name="product_id" value='<?php echo $row['product_id'] ?>' />
      <input type='hidden' name="product_image" value='<?php echo $row['product_image'] ?>' />
      <input type='hidden' name="product_name" value='<?php echo $row['product_name'] ?>' />
      <input type='hidden' name="product_price" value='<?php echo $row['product_price'] ?>' />
      <section class="container single-product my-5 pt-5">
        <div class="row mt-5">
          <div class="col-lg-5 col-md-6 col-sm-12">
            <img class="img-fluid w-100 pb-1" src="<?php echo $row['product_image'] ?>" id="main-image" alt="Stand Modulaire">
            <div class="small-img-group">
              <div class="small-image-col">
                <img src="<?php echo $row['product_image'] ?>" width="124" class="small-img" alt="Popup">
              </div>
              <div class="small-image-col">
                <img src="<?php echo $row['product_image'] ?>" width="124" class="small-img" alt="Popup">
              </div>
              <div class="small-image-col">
                <img src="<?php echo $row['product_image'] ?>" width="124" class="small-img" alt="Popup">
              </div>
              <div class="small-image-col">
                <img src="<?php echo $row['product_image'] ?>" width="124" class="small-img" alt="Popup">
              </div>

            </div>
          </div>

          <div class="boxx col-lg-6 col-md-12 col-sm-12">
            <h6 style="color:coral; font-size:20px; margin-bottom:30px;">
              <?php echo $row['product_name'] ?>
            </h6>


            <!-- <form class="radioForm"> -->
            <div class="radioForm">

              <div class="option-container" >
                <h4>Choisissez le type de drapeau : </h4>
                <label>
                  <input type="radio" name="option1" value="Drapeau Courbé" onclick="toggleInputGroup('input-group1')">
                  <!-- <img src="assets/imgs//2m50.png" alt="2m50"> -->
                  Courbé
                </label>

                <label>
                  <input type="radio" name="option1" value="Drapeau Droit" onclick="toggleInputGroup('input-group1')">
                  <!-- <img src="assets/imgs/2m80.png" alt="2m80"> -->
                  Droit
                </label>

                <label>
                  <input type="radio" name="option1" value="Drapeau Incliné" onclick="toggleInputGroup('input-group1')">
                  <!-- <img src="assets/imgs/3m20.png" alt="3m20"> -->
                  Incliné
                </label>

                <label>
                  <input type="radio" name="option1" value="Drapeau Rectangulaire" onclick="toggleInputGroup('input-group1')">
                  <!-- <img src="assets/imgs/3m80.png" alt="3m80"> -->
                  Rectangulaire
                </label>

                <!-- <div class="input-group" id="input-group1" style="display: none;">
      <input type="number" name="quantity_1" value="0">
      <input type="submit" name="add_product" class="buy-btn" value="Ajouter Au Pannier">
      <button type="button" class="btn btn-danger remove-btn" onclick="removeFromCart('option1','input-group1')">Remove from Cart</button>
    </div> -->
              </div>
              <h3 class="py-2">
              <hr>
              </h3>
              
              <div class="option-container" style="border:dotted 1px grey; padding:20px; border-radius:30px;">
                <h4>Choissisez La Taille : </h4>
                <label>
                  <input type="radio" name="option2" value="2m50" min="1" onclick="toggleInputGroup('input-group2')">
                  <!-- <img src="assets/imgs//2m50.png" alt="2m50"> -->
                  2m50
                </label>

                <label>
                  <input type="radio" name="option2" value="2m80" onclick="toggleInputGroup('input-group2')">
                  <!-- <img src="assets/imgs/2m80.png" alt="2m80"> -->
                  2m80
                </label>

                <label>
                  <input type="radio" name="option2" value="3m20" onclick="toggleInputGroup('input-group2')">
                  <!-- <img src="assets/imgs/3m20.png" alt="3m20"> -->
                  3m20
                </label>

                <label>
                  <input type="radio" name="option2" value="3m80" onclick="toggleInputGroup('input-group2')">
                  <!-- <img src="assets/imgs/3m80.png" alt="3m80"> -->
                  3m80
                </label>

                <div class="input-group" id="input-group2" style="display: none;">
                  <!-- <button type="button" class="quantity-btn minus-btn">-</button> -->
                  <input type="number" name="quantity_2" value="1" min="1">
                  <button class="plus-button" >+</button>
  <button class="minus-button" >-</button>
                  <!-- <button type="button" class="quantity-btn plus-btn">+</button> -->
                  <input type="submit" name="add_product" class="buy-btn addToCartButton" value="Ajouter Au Pannier">
                  <button type="button" class="btn btn-danger remove-btn" onclick="removeFromCart('option2','input-group2')">Remove from Cart</button>
                  <!-- <a href="" id="pdf-download-link" download>
    <button type="button">Download Gabari</button>
  </a> -->
                </div>
              </div>

              <h3 class="py-2">
                
              </h3>
              <div class="option-container" style="border:dotted 1px grey; padding: 19.4px; border-radius:30px;">
                <h4>Choissisez La Base :</h4>
                <div class="base">
                  <label>
                    <input type="radio" name="option3" value="Water Base" onclick="toggleInputGroup('input-group3')">
                    <!-- <img src="assets/imgs/baseAEau.png" alt="Base"> -->
                    Water Base
                  </label>

                  <label>
                    <input type="radio" name="option3" value="Beton base" onclick="toggleInputGroup('input-group3')">
                    <!-- <img src="assets/imgs/baseBeton.png" alt="Base"> -->
                    Beton Base
                  </label>

                  <label>
                    <input type="radio" name="option3" value="Metal Base 7Kg" onclick="toggleInputGroup('input-group3')">
                    <!-- <img src="assets/imgs/baseMetalique.png" alt="Base"> -->
                    Metal Base 7Kg
                  </label>

                  <label>
                    <input type="radio" name="option3" value="Metal Base 7.5Kg" onclick="toggleInputGroup('input-group3')">
                    <!-- <img src="assets/imgs/baseAEau.png" alt="Base"> -->
                    Metal Base 7.5Kg
                  </label>

                  <label>
                    <input type="radio" name="option3" value="Metal Base 10Kg" onclick="toggleInputGroup('input-group3')">
                    <!-- <img src="assets/imgs/baseAEau.png" alt="Base"> -->
                    Metal Base 10Kg
                  </label>

                  <div class="input-group" id="input-group3" style="display: none;">
                    <!-- <button type="button" class="quantity-btn minus-btn">-</button> -->
                    <input type="number" id='q3'name="quantity_3" value="1" min="1">
                    <button class="plus-button1" >+</button>
                  <button class="minus-button1" >-</button>
                    <!-- <button type="button" class="quantity-btn plus-btn">+</button> -->
                    <input type="submit" name="add_product" class="buy-btn addToCartButton" value="Ajouter Au Pannier">
                    <button type="button" class="btn btn-danger remove-btn" onclick="removeFromCart('option3','input-group3')">Remove from Cart</button>
                  </div>
                </div>
              </div>

              <h3 class="py-2">
                <hr>
              </h3>
              <div class="option-container">
                <h4>Avec Bare Metalique  :</h4>
                <div class="base">
                  <label>
                    <input type="radio" name="option5" value="1" onclick="toggleInputGroup('input-group5')">
                    <!-- <img src="assets/imgs/baseAEau.png" alt="Base"> -->
                    OUI
                  </label>
                  <div class="input-group" id="input-group5" style="display: none;">
                    <input type="number" name="quantity_5" value="1" min="1">
                    <input type="submit" name="add_product" class="buy-btn addToCartButton" value="Ajouter Au Pannier">
                    <button type="button" class="btn btn-danger remove-btn" onclick="removeFromCart('option5','input-group5')">Remove from Cart</button>
                  </div>
                </div>
              </div>

              <h3 class="py-2">
                
              </h3>
              <div class="option-container">
                <h4>Insérez Votre Image :</h4>
                <div class="mainUpContainer">
                  <label for="photo-upload" class="upload-container">
                    <span>Click here to upload a photo</span>
                    <input type="file" id="photo-upload" accept="image/*" name="option4">
                  </label>
                  <div class="uploaded-image-container">
                    <img class="uploaded-image" id="uploaded-image-preview" src="#" alt="Uploaded Image">
                  </div>
                </div>
                <div class="buttonContainer">
                  <input type="submit" name="add_product" class="buy-btn " value="Ajouter Au Pannier">
                </div>
              </div>
            </div>
            <div id="notification" class="notification-container">
              <i class="far fa-circle-check notification-icon"></i>
              Added to Cart
            </div>


            <!-- <script>
              document.addEventListener('DOMContentLoaded', function() {
                const quantity2Input = document.querySelector('[name="quantity_2"]');
                const quantity3Input = document.querySelector('[name="quantity_3"]');
                const minusButtons = document.querySelectorAll('.minus-btn');
                const plusButtons = document.querySelectorAll('.plus-btn');
                let userChangedQuantity3 = false;
                // Initialize synchronization
                synchronizeQuantities();

                // Synchronize inputs
                function synchronizeQuantities() {
                  if (!userChangedQuantity3) {
                    quantity3Input.value = quantity2Input.value;
                  }
                }
            
                // Plus and minus button event handlers for quantity_3 only
                function adjustQuantities(amount) {
                  const currentQuantity = parseInt(quantity3Input.value);
                  const newQuantity = Math.max(currentQuantity + amount, 1);
                  quantity3Input.value = newQuantity;
                  synchronizeQuantities();
                }
             
                minusButtons.forEach(button => {
                  button.addEventListener('click', () => {
                    adjustQuantities(-1);
                  });
                });

                plusButtons.forEach(button => {
                  button.addEventListener('click', () => {
                    adjustQuantities(1);
                  });
                });
                
              });
            </script> -->
            <style>
              /* Styles for the notification container */
              .notification-container {
                position: fixed;
                bottom: 20px;
                right: 20px;
                background-color: #ff9800;
                color: #fff;
                padding: 10px 20px;
                border-radius: 5px;
                display: none;
                box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
                align-items: center;
              }
              .notification-icon {
      font-size: 24px;
      margin-right: 10px;
      color: #78d13d;
    }
            </style>


<style>
  .download-container {
    text-align: left;
    margin-right:100px;
  }
  .download-link {
    text-decoration: none;
    color: orange;
    cursor: pointer;
    text-align:left;
  }
  .pdf-links {
    display: none;
    margin-top: 10px;
  }
</style>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const pdfLinks = document.querySelector('.pdf-links');
    pdfLinks.style.display = 'none'; // Initially hide the PDF links

    const downloadLink = document.querySelector('.download-link');
    downloadLink.addEventListener('click', function(event) {
      event.preventDefault();
      pdfLinks.style.display = 'block'; // Show the PDF links
    });
  });
</script>
</head>
<body>
  <div class="download-container">
    <h2><a class="download-link" href="#">Download all Gabaris</a></h2>
    <div class="pdf-links">
      <a href="assets\Gabari\Gabarit_Flag-2m50-Drapeau Courbé.pdf" target="_blank" download  style="text-decoration:none; color:grey;">Gabarit_Flag-2m50-Drapeau Courbé</a><br>
      <a href="assets\Gabari\Gabarit_Flag-2m50-Drapeau Droit.pdf" target="_blank" download style="text-decoration:none; color:grey;">Gabarit_Flag-2m50-Drapeau Droit</a><br>
      <a href="assets\Gabari\Gabarit_Flag-2m50-Drapeau Incliné.pdf" target="_blank" download style="text-decoration:none; color:grey;">Gabarit_Flag-2m50-Drapeau Incliné</a><br>
      <!-- Add more PDF links as needed -->
    </div>
  </div>

<script>
  // Get references to the buttons and notification element
  const addToCartButtons = document.querySelectorAll('.addToCartButton');
  const notification = document.getElementById('notification');

  // Function to show the notification
  function showNotification() {
    notification.style.display = 'flex';

    // Save the expiration time to session storage
    const expirationTime = Date.now() + 3000; // 3 seconds from now
    sessionStorage.setItem('notificationExpiration', expirationTime);

    // Hide the notification after 3 seconds
    setTimeout(() => {
      notification.style.display = 'none';
    }, 3000);
  }

  // Retrieve and display the notification if not expired
  const expirationTime = sessionStorage.getItem('notificationExpiration');
  if (expirationTime && Date.now() < expirationTime) {
    notification.style.display = 'flex';

    // Hide the notification after 3 seconds
    setTimeout(() => {
      notification.style.display = 'none';
    }, 3000);
  }

  // Add click event listeners to each button
  addToCartButtons.forEach(button => {
    button.addEventListener('click', () => {
      const itemName = button.textContent.replace('Add ', '').replace(' to Cart', '');
      showNotification();
    });
  });
</script> 

            <!-- <script>
              document.addEventListener('DOMContentLoaded', function() {
                const quantity2Input = document.querySelector('[name="quantity_2"]');
                const quantity3Input = document.querySelector('[name="quantity_3"]');

                // Flag to track user-initiated changes
                let userChangedQuantity3 = false;

                // Function to synchronize the values of quantity_2 and quantity_3
                function synchronizeQuantities() {
                  if (!userChangedQuantity3) {
                    quantity3Input.value = quantity2Input.value;
                  }
                }

                // Add event listeners to input events of both quantity inputs
                quantity2Input.addEventListener('input', synchronizeQuantities);
                quantity3Input.addEventListener('input', () => {
                  userChangedQuantity3 = true;
                  synchronizeQuantities();
                });
              });
            </script> -->
            <script>
  document.addEventListener('DOMContentLoaded', function() {
    const quantityInput = document.getElementById('q3');
    const plusButton1 = document.querySelector('.plus-button1');
    const minusButton1 = document.querySelector('.minus-button1');

    plusButton1.addEventListener('click', (event) => {
      event.preventDefault(); // Prevent default behavior
      quantityInput.value = parseInt(quantityInput.value) + 1;
    });

    minusButton1.addEventListener('click', (event) => {
      event.preventDefault(); // Prevent default behavior
      if (parseInt(quantityInput.value) > 0) {
        quantityInput.value = parseInt(quantityInput.value) - 1;
      }
    });
  });
</script>
            <script>
  document.addEventListener('DOMContentLoaded', function() {
    const quantity2Input = document.querySelector('[name="quantity_2"]');
    const quantity3Input = document.querySelector('[name="quantity_3"]');
    const plusButton = document.querySelector('.plus-button');
    const minusButton = document.querySelector('.minus-button');

    // Flag to track user-initiated changes
    let userChangedQuantity3 = false;

    // Function to synchronize the values of quantity_2 and quantity_3
    function synchronizeQuantities() {
      if (!userChangedQuantity3) {
        quantity3Input.value = quantity2Input.value;
      }
    }

    // Add event listeners to input events of both quantity inputs
    quantity2Input.addEventListener('input', synchronizeQuantities);
    quantity3Input.addEventListener('input', () => {
      userChangedQuantity3 = true;
      synchronizeQuantities();
    });

    // Add event listeners to plus and minus buttons
    plusButton.addEventListener('click', (event) => {
      event.preventDefault(); // Prevent default behavior
      quantity2Input.value = parseInt(quantity2Input.value) + 1;
      synchronizeQuantities();
    });

    minusButton.addEventListener('click', (event) => {
      event.preventDefault(); // Prevent default behavior
      if (parseInt(quantity2Input.value) > 0) {
        quantity2Input.value = parseInt(quantity2Input.value) - 1;
        synchronizeQuantities();
      }
    });
  });
</script>

            <script>
              function generatePDFDownloadLink() {
                var option1Value = document.querySelector('input[name="option1"]:checked').value;
                var option2Value = document.querySelector('input[name="option2"]:checked').value;

                var pdfPath = 'assets/Gabari/Gabarit_Flag-' + option2Value + '-' + option1Value + '.pdf';
                var downloadLink = document.getElementById('pdf-download-link');
                downloadLink.href = pdfPath;
              }

              // Call the function when the selected values change
              var option1Radios = document.querySelectorAll('input[name="option1"]');
              var option2Radios = document.querySelectorAll('input[name="option2"]');
              for (var i = 0; i < option1Radios.length; i++) {
                option1Radios[i].addEventListener('click', generatePDFDownloadLink);
              }
              for (var j = 0; j < option2Radios.length; j++) {
                option2Radios[j].addEventListener('click', generatePDFDownloadLink);
              }

              // Generate initial PDF download link based on initial selected values
              generatePDFDownloadLink();
            </script>


            <script>
              // Add event listeners to radio buttons
              var radioButtons = document.querySelectorAll('input[type="radio"]');
              for (var i = 0; i < radioButtons.length; i++) {
                radioButtons[i].addEventListener('click', function() {
                  // Remove 'checked' class from all radio buttons
                  for (var j = 0; j < radioButtons.length; j++) {
                    radioButtons[j].parentNode.classList.remove('checked');
                  }
                  // Add 'checked' class to the clicked radio button
                  this.parentNode.classList.add('checked');
                });
              }
            </script>

            <script>
              var lastSelectedOption = null;

              function toggleInputGroup(inputGroupId) {

                var inputGroup = document.getElementById(inputGroupId);
                inputGroup.style.display = 'flex';




                if (lastSelectedOption !== null && lastSelectedOption !== inputGroup) {
                  lastSelectedOption.querySelector('[name="add_product"]').style.display = 'none';
                }

                lastSelectedOption = inputGroup;
                lastSelectedOption.querySelector('[name="add_product"]').style.display = 'flex';
              }
            </script>



            <script>
              function addToCart(optionName) {
                // Add to cart functionality
                console.log('Added ' + optionName + ' to cart');
              }

              function removeFromCart(optionName, inputGroupId) {
                // Remove from cart functionality
                console.log('Removed ' + optionName + ' from cart');

                // Clear radio selection
                const radioButtons = document.getElementsByName(optionName);
                radioButtons.forEach((radioButton) => {
                  radioButton.checked = false;
                });

                var inputGroup = document.getElementById(inputGroupId);
                inputGroup.style.display = 'none';


                var inputGroup = document.getElementById(optionName).closest('.option-container');
                inputGroup.querySelector('[name="add_product"]').style.display = 'flex';
              }
            </script>

            <!-- </form>    -->
          </div>
        </div>



      </section>
    </form>

  <?php } ?>


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
  <script>
    var mainImage = document.getElementById('main-image');
    var smallImage = document.getElementsByClassName("small-img");
    for (let i = 0; i < 4; i++) {
      smallImage[i].onclick = function() {
        let late = mainImage.src;
        mainImage.src = smallImage[i].src;
        smallImage[i].src = late

      }
    }
  </script>
  <script>
    const photoUpload = document.getElementById('photo-upload');
    const imagePreviewContainer = document.querySelector('.uploaded-image-container');
    const imagePreview = document.getElementById('uploaded-image-preview');

    photoUpload.addEventListener('change', function(e) {
      const file = e.target.files[0];
      const reader = new FileReader();

      reader.onload = function(e) {
        imagePreview.src = e.target.result;
      }

      if (file) {
        reader.readAsDataURL(file);
        imagePreviewContainer.style.display = 'block';
      } else {
        imagePreviewContainer.style.display = 'none';
      }
    });
  </script>

</body>

</html>