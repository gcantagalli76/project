<?php require 'views/header.php';

require './controllers/controller.php';

?>


<body>


  <div class="container-fluid centerPage text-center">

    <div class="col-sm-10 bg-light shadowblock">
      <h1 class="text-center">Mes informations personnelles</h1>
      <?php foreach ($displayUserArray as $user) {
        if ($_SESSION['email'] == $user['USER_EMAIL']) { ?>
          <div class="row justify-content-around">
            <div class="col-sm-3 bg-light">
              <label class="form-label mt-2 d-flex justify-content-start"> Nom :</label>
              <div> <?= $user['USER_LASTNAME'] ?> </div>
            </div>
            <div class="col-sm-3 bg-light">
              <label class="form-label mt-2 d-flex justify-content-start"> Prénom :</label>
              <div><?= $user['USER_FIRSTNAME'] ?></div>
            </div>
            <div class="col-sm-3 bg-light">
              <label class="form-label mt-2 d-flex justify-content-start"> Adresse email :</label>
              <div><?= $user['USER_EMAIL'] ?></div>
            </div>
          </div>


          <div class="row justify-content-around mb-3">
            <div class="col-sm-3 bg-light">
              <label class="form-label mt-2 d-flex justify-content-start"> Ville :</label>
              <div><?= $user['USER_CITY'] ?></div>
            </div>

            <div class="col-sm-3 bg-light">
              <label class="form-label mt-2 d-flex justify-content-start"> Code postale :</label>
              <div><?= $user['USER_ZIPCODE'] ?></div>
            </div>

            <div class="col-sm-3 bg-light">
              <label class="form-label mt-2 d-flex justify-content-start"> Statut :</label>
              <div><?= $user['status_name'] ?></div>
            </div>
        <?php }
      } ?>
          </div>

    </div>

    <div class="row justify-content-center mt-5">


      <form class="col-sm-3" action="mespublications.php" method="post">
        <button type="submit" class="btn btn-primary btn-lg" name="myPublications">Mes publications <br> <i class="bi bi-newspaper"></i></button>
      </form>


      <form class="col-sm-3" action="favoris.php" method="post">
        <button type="submit" class="btn btn-primary btn-lg" name="myFavorite">Mes favoris <br> <i class="bi bi-heart"></i> </button>
      </form>


      <div class="col-sm-3">
        <a href="messages.php">
          <button type="button" class="btn btn-primary btn-lg">Mes messages <br> <i class="bi bi-envelope"></i>
          </button>
        </a>
      </div>

      <form class="col-sm-3" method="post">
        <button type="submit" class="btn btn-primary btn-lg" id="disconnect" name="disconnect">Se deconnecter <br> <i class="bi bi-box-arrow-right"></i>
        </button>
      </form>

    </div>


    <?php require 'views/footer.php'; ?>

    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

</body>

</html>