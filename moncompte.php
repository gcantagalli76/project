<?php require 'views/header.php'; 

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=bddproject;charset=utf8mb4', 'root', '');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
        echo('test');
}

$reponse = $bdd->query('SELECT A.*,
                               B.status_name
                        FROM _user as A left join _status as B on A.status_id = B.status_id');

while ($donnees = $reponse->fetch()) {

  if ($_COOKIE['email'] == $donnees['USER_EMAIL']) {
    $firstname = $donnees['USER_FIRSTNAME'];
    $lastname = $donnees['USER_LASTNAME'];
    $mail = $donnees['USER_EMAIL'];
    $city = $donnees['USER_CITY'];
    $postalcode = $donnees['USER_ZIPCODE'];
    $status = $donnees['status_name'];
  }

}

$reponse->closeCursor();

if (isset($_POST['disconnect'])) {
  setcookie('email');
    unset($_COOKIE['email']);
  header("location: index.php");
}


?>


<body>
  

  <div class="container-fluid centerPage text-center">

      <div class="col-sm-10 bg-light shadowblock">
        <h1 class="text-center">Mes informations personnelles</h1>

        <div class="row justify-content-around">
          <div class="col-sm-3 bg-light">
            <label class="form-label mt-2 d-flex justify-content-start"> Nom :</label>
            <div> <?=$lastname?> </div>
          </div>

          <div class="col-sm-3 bg-light">
            <label class="form-label mt-2 d-flex justify-content-start"> Prénom :</label>
            <div><?=$firstname?></div>
          </div>

          <div class="col-sm-3 bg-light">
            <label class="form-label mt-2 d-flex justify-content-start"> Adresse email :</label>
            <div><?=$mail?></div>
          </div>
        </div>


        <div class="row justify-content-around mb-3">
          <div class="col-sm-3 bg-light">
            <label class="form-label mt-2 d-flex justify-content-start"> Ville :</label>
            <div><?=$city?></div>
          </div>

          <div class="col-sm-3 bg-light">
            <label class="form-label mt-2 d-flex justify-content-start"> Code postale :</label>
            <div><?=$postalcode?></div>
          </div>

          <div class="col-sm-3 bg-light">
            <label class="form-label mt-2 d-flex justify-content-start"> Statut :</label>
            <div><?=$status?></div>
          </div>

        </div>

      </div>

    <div class="row justify-content-center mt-5">


      <div class="col-sm-3">
        <a href="mespublications.php">
          <button type="button" class="btn btn-primary btn-lg">Mes publications <br> <i class="bi bi-newspaper"></i>
          </button>
        </a>
      </div>


      <div class="col-sm-3" href="favoris.php">
        <a href="favoris.php">
          <button type="button" class="btn btn-primary btn-lg">Mes favoris <br> <i class="bi bi-heart"></i> </button>
        </a>
      </div>


      <div class="col-sm-3">
        <a href="messages.php">
          <button type="button" class="btn btn-primary btn-lg">Mes messages <br> <i class="bi bi-envelope"></i>
          </button>
        </a>
      </div>

      <form class="col-sm-3" action="" method="post">
          <button type="submit" class="btn btn-primary btn-lg" id="disconnect" name="disconnect">Se deconnecter <br> <i class="bi bi-box-arrow-right"></i>
          </button>
          </form>

      </div>


<?php require 'views/footer.php'; ?>

      <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
      </script>

</body>

</html>