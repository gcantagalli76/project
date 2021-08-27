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
        <form class="col-md-2 p-4" method="POST" action="Annonce.php">
          <button class="card" style="width: 14rem" type="submit" name="idArticleConsult" value="<?php echo $display['ARTICLE_ID'] ?>" >
            <img src="/assets/img/peinture.jpg" class="card-img-top" alt="paint">
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
                  <a class="btn bi bi-heart" type="submit" alt="heart" width="20px" href="Categorie.php?idfavorite=<?php echo $display['ARTICLE_ID'] ?>"> </a>
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

</body>

</html>