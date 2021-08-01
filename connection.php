<?php require 'views/header.php'; 


if (isset($_POST['connectButton'])) {

  try
  {
      $bdd = new PDO('mysql:host=localhost;dbname=bddproject;charset=utf8mb4', 'root', '');
  }
  catch (Exception $e)
  {
          die('Erreur : ' . $e->getMessage());
          echo('test');
  }

  $reponse = $bdd->query('select * from _user');

  while ($donnees = $reponse->fetch()) {

    if ($_POST['yourEmail'] == $donnees['USER_EMAIL'] && $_POST['yourPassword'] == $donnees['USER_PASSWORD']) {
      header("Location: moncompte.php");
    }

}

$reponse->closeCursor();

}


?>

<body>

<form action="" method="post">

  <div class="container-fluid centerPage text-center">

    <div class="row justify-content-center">
      <div class="col-sm-3 bg-light border shadowblock">
        <h1>Connectez-vous à votre compte</h1>

        <label class="form-label mt-4 d-flex justify-content-start"> Adresse email :</label>
        <input type="email" class="form-control box" name="yourEmail">

        <label class="form-label mt-2 d-flex justify-content-start">Mot de passe :</label>
        <input type="password" class="form-control box" name="yourPassword">

        <button type="submit" class="btn btnConnect mt-5" name="connectButton">Se connecter</button>
        <a href="creationcpt.php">
        <div class="mt-4 mb-3">Pas encore membre ? Créez votre compte !</div>
        </a>
      </div>
    </div>
    </div>

</form>

    <?php require 'views/footer.php'; ?>

  


  <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
  </script>

</body>

</html>