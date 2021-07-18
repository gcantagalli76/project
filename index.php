
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
      <div class="col-6 lastPublication">
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

    </div>

    <div class="row mb-5">
      <div class="col-md-12 centerPage">
        <h2 class="mb-0">Nos idées récup</h2><br>
        <h5>Même avec peu de produit on peut quand même faire plein de chose !</h5>
      </div>
    </div>

    <div class="row gallery-content" data-masonry='{"percentPosition": true }'>
      <div class="col-sm-6 col-lg-4 mb-4">
        <div class="card">
          <a href="">
            <img src='./assets/img/paint.JPG' class="card-img-top" width="100%" role="img"
              aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false">
          </a>
          <div class="card-body">
            <h5 class="card-title">Peinture murale</h5>
            <p class="card-text">Rien ne sert de peindre toute une pièce, vous pouvez simplement peindre un seul pant de mur ou simplement la moitié</p>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4 mb-4">
        <div class="card">
          <a href="">
            <img src='./assets/img/tvGetM.jpg' class="card-img-top" width="100%" role="img"
              aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false">
          </a>
          <div class="card-body">
            <h5 class="card-title">Meuble TV</h5>
            <p class="card-text">Pour un rendu original et chaleureu, récupérez vos planches de parquet en trop et faite en un meuble tv</p>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4 mb-4">
        <div class="card">
          <a href="">
            <img src='./assets/img/carrelagelm.jpg' class="card-img-top" width="100%" role="img"
              aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false">
          </a>
          <div class="card-body">
            <h5 class="card-title">Lave main</h5>
            <p class="card-text">Rien de tel que quelques carreaux de carrelage pour habiller votre lave main et éviter les éclaboussures sur le mur !</p>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4 mb-4">
      <div class="card bg-primary text-white text-center p-3">
        <figure class="mb-0">
          <blockquote class="blockquote">
            <p>La devise du bricoleur du dimanche : « <cite> Rien n'est parfois plus utile dans ce monde que les choses qui ont l'air de ne servir à rien </cite> ».</p>
          </blockquote>
        </figure>
      </div>
    </div>
      <div class="col-sm-6 col-lg-4 mb-4">
        <div class="card">
          <a href="">
            <img src='./assets/img/wcGetM.jpg' class="card-img-top" width="100%" role="img"
              aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false">
          </a>
          <div class="card-body">
            <h5 class="card-title">WC suspendu</h5>
            <p class="card-text">Habiller votre wc suspendu avec du parquet et donnez du style à vos toilettes !</p>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4 mb-4">
        <div class="card">
          <a href="">
            <img src='./assets/img/tetelit.jpg' class="card-img-top" width="100%" role="img"
              aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false">
          </a>
          <div class="card-body">
            <h5 class="card-title">Tête de lit</h5>
            <p class="card-text">Quelques lame de parquet en guize de tête de lite suffiront pour créer une ambiance naturelle à votre chambre</p>
          </div>
        </div>
      </div>
      <div class="col-sm-6 col-lg-4 mb-4">
        <div class="card">
          <a href="">
            <img src='./assets/img/sdbGetM.jpg' class="card-img-top" width="100%" role="img"
              aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false">
          </a>
          <div class="card-body">
            <h5 class="card-title">Douche</h5>
            <p class="card-text">Habillez les murs de votre douche avec les restes de votre faillance</p>
          </div>
        </div>
      </div>
    </div>


  <?php require './views/footer.php'; ?>

  </div>



  <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js"
    integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async>
  </script>


</body>

</html>