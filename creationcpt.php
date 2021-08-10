<?php require 'views/header.php'; 

if (isset($_POST['myButton'])) {

    $name = $_POST["yourName"];
    $firstname = $_POST["yourFirstName"];
    $mail = $_POST["yourEmail"];
    $city = $_POST["yourCity"];
    $postalcode = $_POST["yourPostalCode"];
    $yourpassword = $_POST["yourPassword"];

    //   if (!empty($name)) {
    //     setcookie('utilisateur', $name, time() + (60 * 60 * 24));
    //   };
    //   if (!empty($firstname)) {
    //     setcookie("surname", $firstname, time() + (60 * 60 * 24));
    //   };
      if (!empty($mail)) {
        setcookie("email", $mail, time() + (60 * 60 * 24));
      };
    //   if (!empty($city)) {
    //     setcookie("city", $city, time() + (60 * 60 * 24));
    //   };
    //   if (!empty($postalcode)) {
    //     setcookie("postalcode", $postalcode, time() + (60 * 60 * 24));
    //   };


      try
      {
          $bdd = new PDO('mysql:host=localhost;dbname=bddproject;charset=utf8mb4', 'root', '');
      }
      catch (Exception $e)
      {
              die('Erreur : ' . $e->getMessage());
              echo('test');
      }

      $req = $bdd->prepare('INSERT INTO _user(user_firstname, user_lastname, user_email, user_city, user_zipcode, user_password, status_id) 
      VALUES( :firstname, :lastname, :email, :city, :postalcode, :password, 2)');

$req->execute(array(
	'firstname' => $firstname,
	':lastname' => $name,
	'email' => $mail,
	'city' => $city,
	'postalcode' => $postalcode,
	'password' => $yourpassword
	));

    
      header("Location: moncompte.php");

};


?>

<div class="container-fluid centerPage text-center">

    <div class="col justify-content-center">
        <div class="col-sm-6 bg-light border shadowblock">
            <h1 class="text-center">Créez votre compte</h1>
            <div class="d-flex justify-content-start">Créez votre compte rapidement et retrouvez toutes les informations
                sur vos annonces postées et vos favoris</div>

            <form action="" method="post">

                <div class="row justify-content-center">
                    <div class="col-sm-5 bg-light">
                        <label class="form-label mt-3 d-flex justify-content-start"> Nom :</label>
                        <input type="text" class="form-control box" name="yourName" id="yourName">
                        <span id="messageInfosName"></span>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-sm-5 bg-light">
                        <label class="form-label mt-2 d-flex justify-content-start"> Prénom :</label>
                        <input type="text" class="form-control box" id="yourFirstName" name="yourFirstName">
                        <span id="messageInfosFirstName"></span>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-sm-5 bg-light">
                        <label class="form-label mt-2 d-flex justify-content-start"> Adresse email :</label>
                        <input type="text" class="form-control box" id="yourEmail" name="yourEmail">
                        <span id="messageInfosEmail"></span>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-sm-5 bg-light">
                        <label class="form-label mt-2 d-flex justify-content-start"> Ville :</label>
                        <input type="text" class="form-control box" id="yourCity" name="yourCity">
                        <span id="messageInfosCity"></span>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-sm-5 bg-light">
                        <label class="form-label mt-2 d-flex justify-content-start"> Code postale :</label>
                        <input type="text" class="form-control box" id="yourPostalCode" name="yourPostalCode">
                        <span id="messageInfosPostalCode"></span>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-sm-5 bg-light">
                        <label class="form-label mt-2 d-flex justify-content-start"> Mot de passe :</label>
                        <input type="password" class="form-control box" id="yourPassword" name="yourPassword">
                        <span id="messageInfosPassword"></span>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-sm-5 bg-light">
                        <label class="form-label mt-2 d-flex justify-content-start"> Confirmation du mot de passe
                            :</label>
                        <input type="password" class="form-control box" id="yourConfirmPassword">
                        <span id="messageInfosConfirmPassword"></span>
                        <span id="messageInfosNotSamePassword"></span>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-sm-3d-flex justify-content-center">
                        <button type="submit" class="btn btnConnect mt-5 mb-3" id='myButton' name="myButton">Valider mes
                            informations</button>
                        <span id="messageInfosProb"></span>
                    </div>
                </div>

            </form>

        </div>
    </div>
</div>

<?php require 'views/footer.php'; ?>


<script type="text/javascript" src="/assets/js/script.js"></script>

<script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
</script>

</body>

</html>