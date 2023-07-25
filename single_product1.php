<?php

session_start();
include('server/connection.php');

if (isset($_GET['product_id']) || isset($_POST['add_product'])) {
  if (isset($_POST['add_product'])) {
    $product_id = $_POST['product_id'];
    $product_image = $_POST['product_image'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];

    $option1 = isset($_POST['option1']) ? $_POST['option1'] : null;
    $option2 = isset($_POST['option2']) ? $_POST['option2'] : null;
    $option3 = isset($_POST['option3']) ? $_POST['option3'] : null;
    $quantity_1 = isset($_POST['quantity_1']) ? $_POST['quantity_1'] : null;
    $quantity_2 = isset($_POST['quantity_2']) ? $_POST['quantity_2'] : null;
    $quantity_3 = isset($_POST['quantity_3']) ? $_POST['quantity_3'] : null;

    if (!empty($_FILES['option4']['name'])) {
      $imageName = $_FILES['option4']['name'];
      $imageTmpName = $_FILES['option4']['tmp_name'];
      $option4 = file_get_contents($imageTmpName);
    } else {
      $option4 = null;
    }


    $product_array = array(
      'product_id' => $product_id,
      'product_image' => $product_image,
      'product_name' => $product_name,
      'product_price' => $product_price,
      'option1' => $option1,
      'option2' => $option2,
      'option3' => $option3,
      'option4' => $option4,
      'quantity_1' => $quantity_1,
      'quantity_2' => $quantity_2,
      'quantity_3' => $quantity_3,
    );

    if (!empty($product_array)) {
      $_SESSION['cart'][] = $product_array;
    }
  }

  // calculateTotal();
  $product_id = 1;

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


 
  <!-- Right Arrow Button -->

  <form action="single_product2.php" method="GET">
  <input type="hidden" name="product_id" value="2">
  <span class="arrow-label-right">StandParapluie</span> <!-- Added label -->
  <button type='submit' class="arrow-button right-arrow">
    <i class="fas fa-chevron-right"></i>
  </button>
  </form>



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
      border:none;
      /* z-index: 999; */
    }
  .right-arrow {
      right: 10px;
    }
    .arrow-label-right {
    position: relative;
    top:330px; /* Adjust this value as per your desired position */
    transform: translateY(-100%); /* Position above the button */
    left: 1405px; /* Adjust this value to center the label */
    font-size: 14px;
    color: orange; /* Customize the label color */
  }
  </style>

  <?php while ($row = $products->fetch_assoc()) { ?>

    <form method="POST" action='single_product1.php' enctype="multipart/form-data">
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
            
              <div class="option-container">
                <h4>Choisissez le type de drapeau : </h4>
                <label>
                  <input type="radio" name="option1" value="Courbé" onclick="toggleInputGroup('input-group1')">
                  <img src="assets/imgs//2m50.png" alt="2m50">
                </label>

                <label>
                  <input type="radio" name="option1" value="Droit" onclick="toggleInputGroup('input-group1')">
                  <img src="assets/imgs/2m80.png" alt="2m80">
                </label>

                <label>
                  <input type="radio" name="option1" value="Incliné" onclick="toggleInputGroup('input-group1')">
                  <img src="assets/imgs/3m20.png" alt="3m20">
                </label>

                <label>
                  <input type="radio" name="option1" value="Rectangulaire" onclick="toggleInputGroup('input-group1')">
                  <img src="assets/imgs/3m80.png" alt="3m80">
                </label>

                <div class="input-group" id="input-group1" style="display: none;">
                  <input type="number" name="quantity_1" value="1">
                  <input type="submit" name="add_product" class="buy-btn" value="Ajouter Au Pannier">
                  <button type="button" class="btn btn-danger remove-btn" onclick="removeFromCart('option1','input-group1')">Remove from Cart</button>
                </div>
              </div>

              <h3 class="py-4"><hr></h3>
              <div class="option-container">
                <h4>Choissisez La Taille : </h4>
                <label>
                  <input type="radio" name="option2" value="2m50" onclick="toggleInputGroup('input-group2')">
                  <img src="assets/imgs//2m50.png" alt="2m50">
                </label>

                <label>
                  <input type="radio" name="option2" value="2m80" onclick="toggleInputGroup('input-group2')">
                  <img src="assets/imgs/2m80.png" alt="2m80">
                </label>

                <label>
                  <input type="radio" name="option2" value="3m20" onclick="toggleInputGroup('input-group2')">
                  <img src="assets/imgs/3m20.png" alt="3m20">
                </label>

                <label>
                  <input type="radio" name="option2" value="3m80" onclick="toggleInputGroup('input-group2')">
                  <img src="assets/imgs/3m80.png" alt="3m80">
                </label>


                <div class="input-group" id="input-group2" style="display: none;">
                  <input type="number" name="quantity_2" value="1">
                  <input type="submit" name="add_product" class="buy-btn" value="Ajouter Au Pannier">
                  <button type="button" class="btn btn-danger remove-btn" onclick="removeFromCart('option2','input-group2')">Remove from Cart</button>
                </div>
              </div>

              <h3 class="py-4"><hr></h3>
              <div class="option-container">
                <h4>Choissisez La Base (Optionnelle) :</h4>
                <div class="base">
                  <label>
                    <input type="radio" name="option3" value="Water Base" onclick="toggleInputGroup('input-group3')">
                    <img src="assets/imgs/baseAEau.png" alt="Base">
                  </label>

                  <label>
                    <input type="radio" name="option3" value="Beton base" onclick="toggleInputGroup('input-group3')">
                    <img src="assets/imgs/baseBeton.png" alt="Base">
                  </label>

                  <label>
                    <input type="radio" name="option3" value="Metal Base 7Kg" onclick="toggleInputGroup('input-group3')">
                    <img src="assets/imgs/baseMetalique.png" alt="Base">
                  </label>

                  <label>
                    <input type="radio" name="option3" value="Metal Base 7.5Kg" onclick="toggleInputGroup('input-group3')">
                    <img src="assets/imgs/baseAEau.png" alt="Base">
                  </label>

                  <label>
                    <input type="radio" name="option3" value="Metal Base 10Kg" onclick="toggleInputGroup('input-group3')">
                    <img src="assets/imgs/baseAEau.png" alt="Base">
                  </label>
                  <div class="input-group" id="input-group3" style="display: none;">
                    <input type="number" name="quantity_3" value='1'>
                    <input type="submit" name="add_product" class="buy-btn" value="Ajouter Au Pannier">
                    <button type="button" class="btn btn-danger remove-btn" onclick="removeFromCart('option3','input-group3')">Remove from Cart</button>
                  </div>
                </div>


              </div>

              <h3 class="py-4"><hr></h3>
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
                  <!-- <input type='number' name='quantity_1' value='1'> -->
                  <input type="submit" name='add_product' class="buy-btn" value="Ajouter Au Pannier">
                </div>
              </div>
            </div>

          

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

              function removeFromCart(optionName,inputGroupId) {
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