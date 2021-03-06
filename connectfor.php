<?php require './views/header.php';

require './controllers/controller.php';

?>

<body>

  <form action="" method="post">

    <div class="container-fluid centerPage text-center">

      <div class="row justify-content-center">
        <div class="col-sm-7 border shadowblock ">
          <h1 class="countCategoryTitle">Connectez-vous ou créez votre compte <?= $_SESSION['connectFor'] ?? '' ?></h1>

          <button type="button" onclick="window.location.href = 'connection.php'" class="btn btnConnect mt-4" name="connectButton">Se connecter</button>

          <button type="button" onclick="window.location.href = 'creationcpt.php'" class="btn btnConnect mt-4">Créez votre compte</button>

        </div>
      </div>
    </div>

  </form>

  <?php require './views/footer.php'; ?>


  <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
  </script>

</body>

</html>