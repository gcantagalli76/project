<?php require 'views/header.php';

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

        <button class="card col-sm-3 shadowbutton" type="submit" name="publiToValid">
          <div class="card-body">
            <h3 class="bi bi-newspaper d-flex justify-content-start"></h3>
            <h4 class="card-title d-flex justify-content-start">Publications à valider</h4>
          </div>
        </button>

        <button class="card col-sm-3 shadowbutton" type="submit" name="userGestion">
          <div class="card-body">
            <h3 class="bi bi-people d-flex justify-content-start"></h3>
            <h4 class="card-title d-flex justify-content-start">Gestion comptes utilisateurs</h4>
          </div>
        </button>

        <div>
          <button class="btn bg-white border-0" type="submit" name="disconnect"><b>Me déconnecter <i class="bi bi-box-arrow-right"></i></b></button>
        </div>

      </div>
    </form>

  </div>

  <!-- -------------- -->
  <!--  UNIQUE MODALE -->
  <!-- -------------- -->
  <div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title text-white" id="exampleModalLabel">Suppression de votre compte</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          <p>Êtes vous sûre de vouloir supprimer votre compte utilisateur ???</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <form action="" method="POST">
            <button id="deleteUser" name="deleteUser" type="submit" class="btn btn-danger">Supprimer</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- -------------- -->
  <!--  UNIQUE MODALE -->
  <!-- -------------- -->


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


  <?php
  //après avoir validé le coeur tu confirmes que l'annonce a bien été ajoutée aux favoris si l'utilisateur à bien une sessions d'ouverte
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
  //après avoir cliqué sur le bouton suppression du User tu lances le message de confirmation et au clic sur ok tu renvoi sur la page d'accueil
  if (isset($_POST['deleteUser'])) { ?>

    <script>
      Swal.fire({
        title: "Suppression de votre compte !",
        text: "Votre compte utilisateur a bien été supprimé !",
        icon: "success",
        confirmButtonColor: '#000'
      }).then(function() {
        window.location = "index.php";
      });
    </script>

  <?php } ?>

</body>

</html>