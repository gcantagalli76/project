<?php require './views/header.php';

require './controllers/controller.php';

?>


<body>


  <div class="container-fluid text-center mt-5">

    <form action="" method="post">

      <?php foreach ($displayUserArray as $user) {
        if ($_SESSION['userId'] == $user['USER_ID']) { ?>
          <h1 class="text-center countCategoryTitle">Bonjour <?= $user['USER_FIRSTNAME'] ?></h1>
      <?php }
      } ?>


      <div class="row justify-content-center mt-4">

        <button class="card col-sm-3 shadowbutton" type="submit" name="myPublications">
          <div class="card-body">
            <h3 class="bi bi-newspaper d-flex justify-content-start"></h3>
            <h4 class="card-title d-flex justify-content-start">Mes publications</h4>
          </div>
        </button>

        <button class="card col-sm-3 shadowbutton" type="submit" name="myFavorite">
          <div class="card-body">
            <h3 class="bi bi-heart d-flex justify-content-start"></h3>
            <h4 class="card-title d-flex justify-content-start">Mes favoris</h4>
          </div>
        </button>

        <button class="card col-sm-3 shadowbutton" type="submit" name="myMessages">
          <div class="card-body">
            <h3 class="bi bi-envelope d-flex justify-content-start"></h3>
            <h4 class="card-title d-flex justify-content-start">Mes messages</h4>
          </div>
        </button>

        <button class="card col-sm-3 shadowbutton" type="submit" name="changeYourInformation">
          <div class="card-body">
            <h3 class="bi bi-file-earmark-person d-flex justify-content-start"></h3>
            <h4 class="card-title d-flex justify-content-start">Modifier mon profil</h4>
          </div>
        </button>

        <button class="card col-sm-3 shadowbutton" type="submit" name="changePwd">
          <div class="card-body">
            <h3 class="bi bi-key d-flex justify-content-start"></h3>
            <h4 class="card-title d-flex justify-content-start">Changer mon mot de passe</h4>
          </div>
        </button>


        <button class="card col-sm-3 shadowbutton" type="button" data-bs-toggle="modal" data-bs-target="#deleteModal">
          <div class="card-body">
            <h3 class="bi bi-person-x d-flex justify-content-start"></h3>
            <h4 class="card-title d-flex justify-content-start">Supprimer mon compte</h4>
          </div>
        </button>


        <div>
          <button class="btn bg-white border-0" type="submit" name="disconnect"><b>Me d??connecter <i class="bi bi-box-arrow-right"></i></b></button>
        </div>



      </div>
    </form>

  </div>


  <!-- Modal delete count--------------------------------------------------->


  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form class="modal-content" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Veuillez saisir votre mot de passe pour confirmer la suppression</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Mot de passe:</label>
            <input class="form-control" id="message-text" type="password" name="password"></input>
          </div>
        </div>
        <div class="modal-footer justify-content-center">
          <button type="submit" class="btn btnConnect" name="deleteUser">Valider</button>
        </div>
      </form>
    </div>

  </div>


  <?php require './views/footer.php'; ?>

  <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
  </script>

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <?php

  //apr??s avoir cliqu?? sur le bouton d??connect?? tu lances le message de confirmation et au clic sur ok tu renvoi sur la page d'accueil
  if (isset($_POST['disconnect'])) { ?>

    <script>
      Swal.fire({
        title: "Deconnection !",
        text: "Vous avez bien ??t?? d??connect?? de votre compte personnel",
        icon: "success",
        confirmButtonColor: '#000'
      }).then(function() {
        window.location = "index.php";
      });
    </script>

  <?php } ?>


  <?php
  //apr??s avoir valid?? les modif tu confirme que c'est ok
  if (isset($_POST['validModify'])) { ?>

    <script>
      Swal.fire({
        title: "<?= $titleSweet ?>",
        text: "<?= $textSweet ?>",
        icon: "<?= $iconSweet ?>",
        confirmButtonColor: '#000'
      })
    </script>

  <?php } ?>

  <?php
  //apr??s avoir cliqu?? sur le bouton suppression du User tu lances le message de confirmation et au clic sur ok tu renvoi sur la page d'accueil
  if (isset($_POST['deleteUser'])) { ?>

    <script>
      Swal.fire({
        title: "<?= $titleSweetDelete ?>",
        text: "<?= $textSweetDelete ?>",
        icon: "<?= $iconSweetDelete ?>",
        confirmButtonColor: '#000'
      }).then(function() {
        window.location = "<?= $redirectionSweetDelete ?>";
      });
    </script>

  <?php } ?>

</body>

</html>