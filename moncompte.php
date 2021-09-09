<?php require 'views/header.php';

require './controllers/controller.php';

?>


<body>


  <div class="container-fluid centerPage text-center">

<form action="" method="post">

    <div class="col-sm-10 bg-light shadowblock" >
      <h1 class="text-center">Mes informations personnelles</h1>
      <?php foreach ($displayUserArray as $user) {
        if ($_SESSION['email'] == $user['USER_EMAIL']) { ?>
          <div class="row justify-content-around">

            <div class="col-sm-3 bg-light">
              <label class="form-label mt-2 d-flex justify-content-start"> Nom :</label>
              <input <?= $disabled ?> type="text" class="form-control box" id="lastName" name="lastName" maxlength="40" value="<?= $user['USER_LASTNAME'] ?>">
            </div>

            <div class="col-sm-3 bg-light">
              <label class="form-label mt-2 d-flex justify-content-start"> Prénom :</label>
              <input <?= $disabled ?> type="text" class="form-control box" id="firstName" name="firstName" maxlength="40" value="<?= $user['USER_FIRSTNAME'] ?>">
            </div>

            <div class="col-sm-3 bg-light">
              <label class="form-label mt-2 d-flex justify-content-start"> Adresse email :</label>
              <input <?= $disabled ?> type="text" class="form-control box" id="mail" name="mail" maxlength="40" value="<?= $user['USER_EMAIL'] ?>">
            </div>

          </div>


          <div class="row justify-content-around mb-3">

            <div class="col-sm-3 bg-light">
              <label class="form-label mt-2 d-flex justify-content-start"> Ville :</label>
              <input <?= $disabled ?> type="text" class="form-control box" id="city" name="city" maxlength="40" value="<?= $user['USER_CITY'] ?>">
            </div>

            <div class="col-sm-3 bg-light">
              <label class="form-label mt-2 d-flex justify-content-start"> Code postale :</label>
              <input <?= $disabled ?> type="text" class="form-control box" id="zipCode" name="zipCode" maxlength="40" value="<?= $user['USER_ZIPCODE'] ?>">
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


      <div class="col-sm-2">
        <button type="submit" class="btn btn-primary btn-lg" name="myPublications">Mes publications <br> <i class="bi bi-newspaper"></i></button>
    </div>


      <div class="col-sm-2">
        <button type="submit" class="btn btn-primary btn-lg" name="myFavorite">Mes favoris <br> <i class="bi bi-heart"></i> </button>
    </div>

      <div class="col-sm-2">
        <button type="submit" class="btn btn-lg <?= $colorButton ?>" name="<?= $nameButton ?>"><?= $textButton ?><br> <i class="bi bi-heart"></i> </button>
    </div>

      </form>


      <div class="col-sm-2">
        <a href="messages.php">
          <button type="button" class="btn btn-primary btn-lg">Mes messages <br> <i class="bi bi-envelope"></i>
          </button>
        </a>
      </div>

      <form class="col-sm-2" method="post">
        <button type="submit" class="btn btn-primary btn-lg" id="disconnect" name="disconnect">Se deconnecter <br> <i class="bi bi-box-arrow-right"></i>
        </button>
      </form>

    </div>

    

    <?php require 'views/footer.php'; ?>

    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php

    //après avoir cliqué sur le bouton déconnecté tu lances le message de confirmation et au clic sur ok tu renvoi sur la page d'accueil
    if (isset($_POST['disconnect'])) { ?>

      <script>
        Swal.fire({
          title: "Deconnection !",
          text: "Vous avez bien été déconnecté de votre compte personnel",
          icon: "success",
          confirmButtonColor: '#000'
        }).then(function() {
          window.location = "index.php";
        });
      </script>



    <?php } ?>

</body>

</html>