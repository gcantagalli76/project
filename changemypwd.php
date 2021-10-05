<?php require './views/header.php';

require './controllers/controller.php';

?>

<body>

  <div class="container-fluid centerPage text-center">

    <div class="row justify-content-center">
      <div class="col-sm-4 bg-light border shadowblock">
        <h1>Création d'un nouveau mot de passe</h1>
        <form method="POST">

          <div class="row justify-content-center">
            <label class="form-label mt-2 d-flex justify-content-start"> Ancien mot de passe :</label>
            <input type="password" class="form-control box" name="yourExPassword" id="yourExPassword">
            <span id="messageInfosExPassword"></span>
          </div>

          <div class="row justify-content-center">
            <label class="form-label mt-2 d-flex justify-content-start"> Nouveau mot de passe :</label>
            <input type="password" class="form-control box" name="yourNewPassword" id="yourNewPassword">
            <span id="messageInfosPassword"></span>
          </div>

          <div class="row justify-content-center">
            <label class="form-label mt-2 d-flex justify-content-start"> Confirmation du mot de passe :</label>
            <input type="password" class="form-control box" name="yourConfirmNewPassword" id="yourConfirmNewPassword">
            <span id="messageInfosConfirmPassword"></span>
            <span id="messageInfosNotSamePassword"></span>
          </div>

          <div class="row justify-content-center">
            <button type="submit" class="btn btnConnect mt-3" name="changeMyPwd" id="changeMyPwd">Changer le mot de passe</button>
            <span id='buttonInformation' style="font-style: italic">Veuillez remplir tous les champs pour valider</span>
          </div>

        </form>
      </div>
    </div>
  </div>


  <?php require './views/footer.php'; ?>

  <script type="text/javascript" src="/assets/js/scriptChangePwd.js"></script>

  <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
  </script>

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <?php

  //après avoir validé le formulaire tu lances le message de confirmation et au clic sur ok tu renvoi sur la page de connection
  if (isset($_POST['changeMyPwd']) && $emptyModifPwd == 0) { ?>

    <script>
      Swal.fire({
        title: "<?= $titleSweet ?>",
        text: "<?= $textSweet ?>",
        icon: "<?= $iconSweet ?>",
        confirmButtonColor: '#000'
      }).then(function() {
            window.location = "<?= $redirectionSweet ?>";
        });
    </script>

  <?php } ?>


</body>

</html>