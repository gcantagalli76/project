<?php require 'views/header.php';

require './controllers/controller.php';

?>


<body>

  <h1 class="text-center p-5 countCategoryTitle">Gestion des comptes utilisateurs</h1>


  <div class="container-fluid">
    <?php foreach ($displayAllUser as $user) { ?>
      <div class="card mb-3 favorite" style="width: 55%;">
        <div class="row g-0">

          <div class="col-md-5 p-3">
            <div class="card-body">
              <h4 class="card-title" id="<?= $user['USER_ID'] ?>-user" class="card-title"><?= $user['USER_FIRSTNAME'] ?> <?= $user['USER_LASTNAME'] ?></h4>
              <p class="card-text"><?= $user['USER_EMAIL'] ?></p>
              <p class="card-text"><small class="text-muted">Ville: <?= $user['USER_CITY'] ?></small></p>
            </div>
          </div>

          <form class="col-md-3 card-body" method="post">
            <h6 class=" d-flex justify-content-center">Statut utilisateur</h6>
            <select class="form-select mt-3" aria-label="" id="userStatut" name="userStatut">
              <option selected disabled>Satut de l'utilisateur :</option>
              <option value="1" <?= ($user['STATUS_ID'] == 1) || (isset($_POST['userStatut']) && $_POST['userStatut'] == 1) ? 'selected' : '' ?>>Admin</option>
              <option value="2" <?= ($user['STATUS_ID'] == 2) || (isset($_POST['userStatut']) && $_POST['userStatut'] == 2) ? 'selected' : '' ?>>Utilisateur</option>
            </select>
            <button type="submit" class="btn btnStatut mt-2" name="validChangeStatut" value="<?php echo $user['USER_ID'] ?>">Valider le changement de statut</button>
          </form>
          <div class="col-md-4 mt-2">
            <div class="card-body">
              <div class="d-flex align-items-center p-3 justify-content-center">
                <div class="btn bi bi-trash ms-2 deletebtn" id="deletebtn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-user-id="<?= $user['USER_ID'] ?>"> Supprimer le compte utilisateur</div>
              </div>
            </div>
          </div>
        </div>
      </div>

  </div>

  <!-- -------------- -->
  <!--  UNIQUE MODALE -->
  <!-- -------------- -->
  <div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title text-white" id="exampleModalLabel">Suppression d'un utilisateur</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          <p>??tes vous s??re de vouloir supprimer l'utilisateur <b><span id="userNameDelete"></span></b></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <form action="" method="POST">
            <button id="idUserDelete" name="idUserDelete" type="submit" class="btn btn-danger">Supprimer</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- -------------- -->
  <!--  UNIQUE MODALE -->
  <!-- -------------- -->


<?php }
    require 'views/footer.php'; ?>


<script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
</script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  // Mise en place de la swal pour indiquer que l'utilisateur a ??t?? supprim??e
  if (<?= $deleteSuccess ?>) {
    Swal.fire({
      icon: 'success',
      text: 'Votre utilisateur a bien ??t?? supprim??e !',
      confirmButtonColor: '#000'
    })
  };

  // mise en place d'un array regroupant tous les boutons de la classe .deletebtn
  const trashButtonsArray = document.querySelectorAll('.deletebtn')

  // on ajoute un ??couteur d'??v??nement sur chaque bouton au click
  trashButtonsArray.forEach(element => {
    element.addEventListener('click', function() {
      // on recupere la valeur du data pour l'inserer dans la value du button correspondant
      document.getElementById('idUserDelete').value = this.dataset.userId
      // on recupere la valeur des id contenant les nom et prenoms pour l'ins??rer dans la div
      document.getElementById('userNameDelete').innerHTML = document.getElementById(this.dataset.userId + '-user').innerText;
    })
  });
</script>

<?php

//apr??s avoir modifi?? le statut de l'utilisateur tu lances le message de confirmation 

if (isset($_POST['validChangeStatut'])) { ?>

  <script>
    Swal.fire({
      title: "Changement effectu??",
      text: "Le changement de statut a bien ??t?? r??alis??",
      icon: "success",
      confirmButtonColor: '#000'
    });
  </script>

<?php } ?>

</body>

</html>