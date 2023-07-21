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
                    <a class="nav-link nav-links" href="#shop">Shop</a>
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

        <section class="container single-product my-5 pt-5">
            
           <div class="row mt-5">
                <div class="col-lg-5 col-md-6 col-sm-12" >
                    <img class="img-fluid w-100 pb-1" src="assets/imgs/StandModulaire.png" id="main-image" alt="Stand Modulaire">
                    <div class="small-img-group">
                        <div class="small-image-col">
                            <img src="assets/imgs/popup.png" width="124" class="small-img" alt="Popup">
                        </div>
                        <div class="small-image-col">
                            <img src="assets/imgs/popup.png" width="124" class="small-img" alt="Popup">
                        </div>
                        <div class="small-image-col">
                            <img src="assets/imgs/popup.png" width="124" class="small-img" alt="Popup">
                        </div>
                        <div class="small-image-col">
                            <img src="assets/imgs/popup.png" width="124" class="small-img" alt="Popup">
                        </div>
                        
                    </div>
                  </div> 
                  <div class="boxx col-lg-6 col-md-12 col-sm-12">
                   <h6>
                     Stand Modulaire
                   </h6>
                   <h3 class="py-4">Etape 1</h3>
                   <!-- <h2>240 DT</h2> -->
                   <!-- <input type="number" value="1" > -->
                   
                   <form class="radioForm">
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
    <script>
     var mainImage =  document.getElementById('main-image');
     var smallImage = document.getElementsByClassName("small-img");
    for (let i = 0; i <4; i++)
    {
      smallImage[i].onclick = function(){
     let late = mainImage.src;
      mainImage.src = smallImage[i].src;
     smallImage[i].src= late
      
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