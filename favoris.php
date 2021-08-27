<?php require 'views/header.php';

require './controllers/controller.php';

?>

<body>


  <h1 class="text-center p-5">Mes favoris</h1>


  <div class="container-fluid">
    <?php foreach ($displayFavoriteArticleArray as $display) { ?>
      <div class="card mb-3 favorite" style="width: 95%;">
        <div class="row g-0">

          <a class="col-md-2 d-flex align-items-center justify-content-center btn" type="submit" href="Annonce.php?idarticle=<?php echo $display['ARTICLE_ID'] ?>">
            <img src="/assets/img/peinture.jpg" alt="paint" width="150px" style="max-height: 150px;">
          </a>

          <a class="col-md-3 btn" type="submit" href="Annonce.php?idarticle=<?php echo $display['ARTICLE_ID'] ?>">
            <div class="card-body">
              <h4 class="card-title"><?= $display['ARTICLE_TITLE'] ?></h4>
              <p class="card-text"><?= $display['ARTICLE_PRICE'] ?>€</p>
              <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
            </div>
          </a>

          <a class="col-md-4 btn" type="submit" href="Annonce.php?idarticle=<?php echo $display['ARTICLE_ID'] ?>">
            <div class="card-body">
              <h6 class="card-title">Descriptif :</h6>
              <p class="card-text"><?= $display['ARTICLE_DESCRIPTION'] ?></p>
            </div>
          </a>


          <div class="col-md-3">
            <div class="card-body">

              <form class="d-flex align-items-center p-3 justify-content-center" method="post">
                <button type="submit" class="btn bi bi-trash ms-2" name="idArticleFavoriteDelete" value="<?php echo $display['ARTICLE_ID'] ?>"> Supprimer</button>
              </form>

              <div class="d-flex align-items-center p-3 justify-content-center">
                <i class="bi bi-envelope"></i>
                <div class="ms-2">Envoyer un message</div>
              </div>

            </div>
          </div>
        </div>
      </div>


  </div>

<?php }
    require 'views/footer.php'; ?>



<script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
</script>

</body>

</html>