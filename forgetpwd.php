<?php require './views/header.php';

require './controllers/controller-changepwd.php';


?>

<body>


    <div class="container-fluid centerPage text-center">

      <div class="row justify-content-center">
        <div class="col-sm-4 bg-light border shadowblock">
          <h1>Mot de passe oublié</h1>
          <form method="POST">
            <label class="form-label mt-4 d-flex justify-content-start"> Adresse email :</label>
            <input type="email" class="form-control box" name="yourEmail">

            <button type="submit" class="btn btnConnect mt-5" name="createToken">Créer un nouveau mot de passe</button>

          </form>
        </div>
      </div>
    </div>


  <?php require './views/footer.php'; ?>

  <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
  </script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <?php 

  if (isset($_POST['createToken'])) {?>

    <script> Swal.fire("<?= $infoMessage ?>", "<?= $bodyInfoMessage ?>", "<?= $colorInfoMessage ?>") </script> 

  <?php } ?>

</body>

</html>