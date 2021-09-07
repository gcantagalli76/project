<?php require 'views/header.php';

require './controllers/controller.php';

?>

<body>

  <div class="container-fluid text-center">
    <div class="row">
      <div class="col-6 col-lg-4 lastPublication">
        <?= $categoryTitle ?>
      </div>
    </div>

    <div class="row justify-content-start">

      <?php foreach ($displayCategoryArticleArray as $display) { ?>
        <form class="col-md-2 p-4" method="GET" action="Annonce.php">
          <button class="card" style="width: 14rem" name="idArticleConsult" id="idArticleConsult" value="<?php echo $display['ARTICLE_ID'] ?>">
            <img src="data:image/png;base64, <?= $display['picture1'] ?>" alt="picture1" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title"><?= $display['ARTICLE_TITLE'] ?></h5>
              <p class="card-text"><?= $display['ARTICLE_DESCRIPTION'] ?></p>
              <div class="row">
                <div class="col-md-3">
                  <a style="font-weight : bold"><?= $display['ARTICLE_PRICE'] ?>€</a>
                </div>
                <div class="col-md-5">
                  <img src="/assets/img/geo-alt.svg" alt="heart" width="20px">
                  <a><?= $display['ARTICLE_CITY'] ?></a>
                </div>
                <div class="col-md-4">
                  <a class="btn bi bi-heart" type="submit" alt="heart" width="20px" href="Categorie.php?idfavorite=<?php echo $display['ARTICLE_ID'] ?>&amp;category_id=<?php echo $display['CATEGORY_ID'] ?>"> </a>
                </div>
              </div>
            </div>
          </button>
        </form>



      <?php  }
      require 'views/footer.php'; ?>
    </div>

    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
<?php } elseif (isset($_GET['idfavorite']) && !isset($_SESSION['email'])) {?>
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