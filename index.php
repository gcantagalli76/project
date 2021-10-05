<?php require './views/header.php';

require './controllers/controller.php';

?>




<div id="width">
  <img width="100%" id="descriptionSite">
</div>
<div class="container-fluid centerPage text-center">
  <div class="row">
    <div class="col-md-6 lastPublication justify-content-center">
      Les dernières publications
    </div>
  </div>
  <div class="row justify-content-center">

    <?php foreach ($display5ArticleArray as $display) { ?>

      <form class="col-md-2 d-flex justify-content-center" method="GET" action="Annonce.php">
        <button class="card" style="width: 14rem;" name="idArticleConsult" id="idArticleConsult" value="<?php echo $display['ARTICLE_ID'] ?>">
          <img src="data:image/png;base64, <?= $display['picture1'] ?>" class="card-img-top imagePreview" alt="picture1">
          <div class="card-body">
            <h5 class="card-title twoLines"><?= $display['ARTICLE_TITLE'] ?></h5>
            <div class="row d-flex align-items-center">
              <div class="col-md-6">
                <b><?= $display['ARTICLE_PRICE'] ?>€</b>
              </div>
              <div class="col-md-6">
                <a class="btn bi bi-heart" type="submit" alt="heart" href="index.php?idfavorite=<?php echo $display['ARTICLE_ID'] ?>&amp;category_id=<?php echo $display['CATEGORY_ID'] ?>"> </a>
              </div>
            </div>
            <div class="row mt-2">
              <div class="col-md-12">
                <img src="./assets/img/geo-alt.svg" alt="geo" width="20px">
                <a><?= $display['ARTICLE_CITY'] ?></a>
              </div>
            </div>
          </div>
        </button>
      </form>

    <?php } ?>

  </div>

  <div class="row mb-5">
    <div class="col-md-12 centerPage">
      <h2 class="recyclingTitle">Nos idées récup'</h2><br> <img src='./assets/img/upcycling.svg' id="recyclingImg">
      <h5 class="mt-3 recyclingSubTitle">Même avec peu de produit, on peut quand même faire plein de choses !</h5>
    </div>
  </div>
  <div class="row gallery-content" data-masonry='{"percentPosition": true }'>
    <div class="col-sm-6 col-lg-4 mb-4">
      <div class="card">
        <img src='./assets/img/paint.JPG' class="card-img-top" width="100%" aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false">
        <div class="card-body">
          <h5 class="card-title">Peinture murale</h5>
          <p class="card-text">Rien ne sert de peindre toute une pièce, vous pouvez simplement peindre un seul pant de mur ou simplement la moitié</p>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-lg-4 mb-4">
      <div class="card">
        <img src='./assets/img/tvGetM.jpg' class="card-img-top" width="100%" role="img" aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false">
        <div class="card-body">
          <h5 class="card-title">Meuble TV</h5>
          <p class="card-text">Pour un rendu original et chaleureux, récupérez vos planches de parquet en trop et faite en un meuble tv</p>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-lg-4 mb-4">
      <div class="card">
        <img src='./assets/img/carrelagelm.jpg' class="card-img-top" width="100%" role="img" aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false">
        <div class="card-body">
          <h5 class="card-title">Lave main</h5>
          <p class="card-text">Rien de tel que quelques carreaux de carrelage pour habiller votre lave main et éviter les éclaboussures sur le mur !</p>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-lg-4 mb-4">
      <img src='./assets/img/6935-[Converti].png' width="100%" role="img" aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false">
    </div>
    <div class="col-sm-6 col-lg-4 mb-4">
      <div class="card">
        <img src='./assets/img/wcGetM.jpg' class="card-img-top" width="100%" role="img" aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false">
        <div class="card-body">
          <h5 class="card-title">WC suspendu</h5>
          <p class="card-text">Habiller votre wc suspendu avec du parquet et donnez du style à vos toilettes !</p>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-lg-4 mb-4">
      <div class="card">
        <img src='./assets/img/tetelit.jpg' class="card-img-top" width="100%" role="img" aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false">
        <div class="card-body">
          <h5 class="card-title">Tête de lit</h5>
          <p class="card-text">Quelques lame de parquet en guise de tête de lite suffiront pour créer une ambiance naturelle dans votre chambre</p>
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-lg-4 mb-4">
      <div class="card">
        <img src='./assets/img/sdbGetM.jpg' class="card-img-top" width="100%" role="img" aria-label="Placeholder: Image cap" preserveAspectRatio="xMidYMid slice" focusable="false">
        <div class="card-body">
          <h5 class="card-title">Douche</h5>
          <p class="card-text">Habillez les murs de votre douche avec les restes de votre faillance</p>
        </div>
      </div>
    </div>
  </div>
</div>

<?php require './views/footer.php'; ?>

<script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/masonry-layout@4.2.2/dist/masonry.pkgd.min.js" integrity="sha384-GNFwBvfVxBkLMJpYMOABq3c+d3KnQxudP/mGPkzpZSTYykLBNsZEnG2D9G/X/+7D" crossorigin="anonymous" async>
</script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
  // fonction permettant d'adapter l'image selon le format de l'écran
  const widthOutput = document.querySelector('#width');

  function reportWindowSize() {
    if (window.innerWidth < 500) {
      document.getElementById("descriptionSite").src = "./assets/img/header-small.png";
      document.getElementById('recyclingImg').style.width = '30%';
    } else if (window.innerWidth > 500) {
      document.getElementById("descriptionSite").src = "./assets/img/header.png";
      document.getElementById('recyclingImg').style.width = '10%';
    }
  }

  reportWindowSize();

  window.onresize = reportWindowSize;
</script>


<?php

//après avoir validé le coeur tu confirmes que l'annonce a bien été ajoutée aux favoris si l'utilisateur à bien une sessions d'ouverte
if (isset($_GET['idfavorite']) && isset($_SESSION['email'])) { ?>

  <script>
    Swal.fire({
      title: "<?= $titleSweet ?>",
      text: "<?= $textSweet ?>",
      icon: "<?= $iconSweet ?>",
      confirmButtonColor: '#000'
    })
  </script>
<?php } elseif (isset($_GET['idfavorite']) && !isset($_SESSION['email'])) { ?>
  <script>
    Swal.fire({
      title: "Veuillez vous connecter !",
      text: "Vous devez vous connecter ou créer un compte pour rajouter un article dans vos favoris",
      icon: 'error',
      confirmButtonColor: '#000'
    }).then(function() {
      window.location = "connection.php";
    });
  </script>
<?php } ?>


</body>

</html>