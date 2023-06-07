<?php

include('server/connection.php');

if (isset($_GET['product_id'])) {



  $product_id = $_GET['product_id'];

  $request = $conn->prepare('SELECT * FROM products WHERE product_id = ? ');
  $request->bind_param("i", $product_id);

  $request->execute();
  $products = $request->get_result();
} else {
  header('location:accueille.php');
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
  <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
  <link rel="stylesheet" href="assets/css/accueille.css">
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary py-4 fixed-top">
    <div class="container-fluid">

      <img src="assets/imgs/logo.jpeg" alt="">

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="accueille.html">Home</a>
          </li>


          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Categories
            </a>

            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="#">Beach flag</a></li>
              <li><a class="dropdown-item" href="#">Pop-Up Stand</a></li>
              <li><a class="dropdown-item" href="#">Counter</a></li>
            </ul>

          </li>

          <li class="nav-item">
            <a class="nav-link active">Disabled</a>
          </li>

        </ul>
        <form class="d-flex" role="search">
          <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success" type="submit">Search</button>
        </form>
      </div>
    </div>
  </nav>



  <?php while ($row = $products->fetch_assoc()) { ?>

    <form>
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
            <h6>
             <?php echo $row['product_name'] ?>
            </h6>


            <!-- <form class="radioForm"> -->
            <div class="radioForm">
              <h3 class="py-4">Etape 1</h3>
              <!-- <h2>240 DT</h2> -->
              <!-- <input type="number" value="1" > -->
              <h4>Choisissez le type de drapeau : </h4>

              <label>
                <input type="radio" name="type" value="2m50">
                <img src="assets/imgs//2m50.png" alt="2m50">
              </label>

              <label>
                <input type="radio" name="type" value="2m80">
                <img src="assets/imgs/2m80.png" alt="2m80">
              </label>

              <label>
                <input type="radio" name="type" value="3m20">
                <img src="assets/imgs/3m20.png" alt="3m20">
              </label>
              <label>
                <input type="radio" name="type" value="3m80">
                <img src="assets/imgs/3m80.png" alt="3m80">
              </label>
              <label>
                <input type="radio" name="type" value="4m50">
                <img src="assets/imgs/4m50.png" alt="4m50">
              </label>
              <label>
                <input type="radio" name="type" value="5m">
                <img src="assets/imgs/5m.png" alt="5m">
              </label>
              <h3 class="py-4">Etape 2</h3>
              <h4>Choissisez La Taille : </h4>
              <label>
                <input type="radio" name="taille" value="2m50">
                <img src="assets/imgs//2m50.png" alt="2m50">
              </label>

              <label>
                <input type="radio" name="taille" value="2m80">
                <img src="assets/imgs/2m80.png" alt="2m80">
              </label>

              <label>
                <input type="radio" name="taille" value="3m20">
                <img src="assets/imgs/3m20.png" alt="3m20">
              </label>
              <label>
                <input type="radio" name="taille" value="3m80">
                <img src="assets/imgs/3m80.png" alt="3m80">
              </label>
              <label>
                <input type="radio" name="taille" value="4m50">
                <img src="assets/imgs/4m50.png" alt="4m50">
              </label>
              <label>
                <input type="radio" name="taille" value="5m">
                <img src="assets/imgs/5m.png" alt="5m">
              </label>

              <h3 class="py-4">Etape 3</h3>
              <h4>Choissisez La Base ( Optionelle ) : </h4>
              <div class="base">

                <label>
                  <input type="radio" name="base" value="2m50">
                  <img src="assets/imgs/baseAEau.png" alt="Base">
                </label>

                <label>
                  <input type="radio" name="base" value="2m80">
                  <img src="assets/imgs/baseBeton.png" alt="Base">
                </label>

                <label>
                  <input type="radio" name="base" value="3m20">
                  <img src="assets/imgs/baseMetalique.png" alt="Base">
                </label>
                <label>
                  <input type="radio" name="base" value="3m80">
                  <img src="assets/imgs/baseAEau.png" alt="Base">
                </label>
                <label>
                  <input type="radio" name="base" value="4m50">
                  <img src="assets/imgs/baseAEau.png" alt="Base">
                </label>


              </div>
              <h3 class="py-4">Etape 4</h3>
              <h4> Inserez Votre Image : </h4>
              <div class="mainUpContainer">
                <label for="photo-upload" class="upload-container">
                  <span>Click here to upload a photo</span>
                  <input type="file" id="photo-upload" accept="image/*">
                </label>

                <div class="uploaded-image-container">
                  <img class="uploaded-image" id="uploaded-image-preview" src="#" alt="Uploaded Image">
                </div>
              </div>

              <div class="buttonContainer">
                <input type="submit" class="buy-btn" value="Ajouter Au Pannier">
              </div>
            </div>
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

    <!--<hr style="border: none; height: 2px; background-color: #ffffff;">-->
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
  </footer>









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