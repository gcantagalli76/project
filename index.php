<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="./assets/css/style.css">
  <title>Bricoleur du Dimanche</title>
</head>

<body>

  <?php require './views/header.php'; ?>

  <div class="container-fluid">
    <img src="./assets/img/header.png" alt="depot" width="100%">
    <div class="col-sm-4">
      <form class="d-flex searchBar">
        <input class="form-control me-2" type="search" placeholder="Rechercher..." aria-label="Search">
        <button class="btn btn-outline-white bg-white" type="submit"><img src="./assets/img/search.svg"
            alt="search"></button>
      </form>
    </div>
    <div class="col-sm-2 text-center">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle navbarDropdown2" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
          aria-expanded="false">
          Catégories
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item">Carrelage, parquet, sol</a></li>
          <li><a class="dropdown-item">Peinture et droguerie</a></li>
          <li><a class="dropdown-item">Matériaux de construction</a></li>
        </ul>
      </li>
    </div>
  </div>


  <div class="container-fluid centerPage text-center">
    <div class="row">
      <div class="col-6 col-lg-4 lastPublication">
        Les dernières publications
      </div>

    </div>

    <div class="row justify-content-center">

      <div class="col-md-2">
        <div class="card" style="width: 14rem;">
          <img src="./assets/img/peinture.jpg" class="card-img-top" alt="paint">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
              content.</p>
            <div class="row">
              <div class="col-md-3">
                <a style="font-weight : bold">50€</a>
              </div>
              <div class="col-md-5">
                <img src="./assets/img/geo-alt.svg" alt="heart" width="20px">
                <a>Le Havre</a>
              </div>
              <div class="col-md-4">
                <img src="./assets/img/heart.svg" alt="heart" width="20px">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-2 carte">
        <div class="card" style="width: 14rem;">
          <img src="./assets/img/peinture.jpg" class="card-img-top" alt="paint">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
              content.</p>
            <div class="row">
              <div class="col-md-3">
                <a style="font-weight : bold">50€</a>
              </div>
              <div class="col-md-5">
                <img src="./assets/img/geo-alt.svg" alt="heart" width="20px">
                <a>Le Havre</a>
              </div>
              <div class="col-md-4">
                <img src="./assets/img/heart.svg" alt="heart" width="20px">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-2 carte">
        <div class="card" style="width: 14rem;">
          <img src="./assets/img/peinture.jpg" class="card-img-top" alt="paint">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
              content.</p>
            <div class="row">
              <div class="col-md-3">
                <a style="font-weight : bold">50€</a>
              </div>
              <div class="col-md-5">
                <img src="./assets/img/geo-alt.svg" alt="heart" width="20px">
                <a>Le Havre</a>
              </div>
              <div class="col-md-4">
                <img src="./assets/img/heart.svg" alt="heart" width="20px">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-2 carte">
        <div class="card" style="width: 14rem;">
          <img src="./assets/img/peinture.jpg" class="card-img-top" alt="paint">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
              content.</p>
            <div class="row">
              <div class="col-md-3">
                <a style="font-weight : bold">50€</a>
              </div>
              <div class="col-md-5">
                <img src="./assets/img/geo-alt.svg" alt="heart" width="20px">
                <a>Le Havre</a>
              </div>
              <div class="col-md-4">
                <img src="./assets/img/heart.svg" alt="heart" width="20px">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="col-md-2 carte">
        <div class="card" style="width: 14rem;">
          <img src="./assets/img/peinture.jpg" class="card-img-top" alt="paint">
          <div class="card-body">
            <h5 class="card-title">Card title</h5>
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
              content.</p>
            <div class="row">
              <div class="col-md-3">
                <a style="font-weight : bold">50€</a>
              </div>
              <div class="col-md-5">
                <img src="./assets/img/geo-alt.svg" alt="heart" width="20px">
                <a>Le Havre</a>
              </div>
              <div class="col-md-4">
                <img src="./assets/img/heart.svg" alt="heart" width="20px">
              </div>
            </div>
          </div>
        </div>
      </div>

    </div>



      <div class="row">
        <div class="col-md-12 centerPage">
          <h2 class="mb-0">Nos idées récup</h2><br>
          <h5>Même avec peu de produit on peut quand même faire plein de chose !</h5>
        </div>
      </div>



      <div class="row">
        <div class="col-md-4 mt-5">
          <img src="./assets/img/paint.JPG" alt="wc" width="350px" height="232px" class="Pictures">
          <div class="astucesText">Rien ne sert de peindre toute une pièce, vous pouvez simplement peindre un pant de mur ou même la moitié</div>
        </div>
        <div class="col-md-4 offset-md-4 mt-5">
          <img src="./assets/img/meubletv.jpg" alt="lm" width="350px" height="232px" class="Pictures">
          <div class="astucesText">Pour un rendu original et chaleureu, récupérez vos planches de parquet en trop et faite en un meuble tv</div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-4 mt-5">
          <img src="./assets/img/carrelagelm.jpg" alt="wc" width="350px" height="232px" class="Pictures">
          <div class="astucesText">Rien de tel que quelques carreaux de carrelage pour habiller votre lave main et éviter les éclaboussures sur le mur !</div>
        </div>
        <div class="col-md-4 centerPicture">
          <img src="./assets/img/wc2.jpg" alt="wc" width="450px" height="300px" class="Pictures">
          <div class="astucesText">Habiller votre wc suspendu avec du parquet et donnez du style à vos toilettes !</div>
        </div>
        <div class="col-md-4 mt-5">
          <img src="./assets/img/tetelit.jpg" alt="lm" width="350px" height="232px" class="Pictures">
          <div class="astucesText">Quelques lame de parquet en guize de tête de lite suffiront pour créer une ambiance naturelle à votre chambre</div>
        </div>
      </div>

   


    <div class="row footer-size align-items-center">
      <div class="col-md-3">
        <a class="nav-link active text-white">Nous contacter</a>
        <img src="./assets/img/envelope.svg" alt="heart" width="25px">
      </div>
      <div class="col-md-6">
        <a class="nav-link active text-white">Mentions légales - Conditions générales d'utilisation - Gestion des données personnelles</a>
      </div>
      <div class="col-md-3">
        <a class="nav-link active text-white">Rejoignez nous !</a>
        <img src="./assets/img/facebook.svg" alt="heart" width="25px">
        <img src="./assets/img/instagram.svg" alt="heart" width="25px">
        <img src="./assets/img/twitter.svg" alt="heart" width="25px">
      </div>

    </div>


  </div>



      <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
      </script>


</body>

</html>