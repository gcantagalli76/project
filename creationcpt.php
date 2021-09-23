<?php require 'views/header.php';

require './controllers/controller.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response'])) {

    $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
    $recaptcha_secret = '6LdWb3wcAAAAABa5myVJze51bGXtk0basocwQcCg';
    $recaptcha_response = $_POST['recaptcha_response'];
  
    $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
    $recaptcha = json_decode($recaptcha);
  }

?>

<script src="https://www.google.com/recaptcha/api.js?render=6LdWb3wcAAAAAH20lIKO6PfbrDFQF6HibZNcSX2R">
  </script>
  <script>
    grecaptcha.ready(function() {
      grecaptcha.execute('6LdWb3wcAAAAAH20lIKO6PfbrDFQF6HibZNcSX2R', {
        action: 'label'
      }).then(function(token) {
        var recaptchaResponse = document.getElementById('recaptchaResponse');
        recaptchaResponse.value = token;
      });
    });
  </script>



<div class="container-fluid centerPage text-center">

    <div class="col justify-content-center">
        <div class="col-sm-6 bg-light border shadowblock">
            <h1 class="text-center">Créez votre compte</h1>
            <div class="d-flex justify-content-start">Créez votre compte rapidement et retrouvez toutes les informations
                sur vos annonces postées et vos favoris</div>

            <form action="" method="post" id="createcount">

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
                        <span id="messageInfosEmail" name="occupedEmail"></span>
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
                        <input type="password" class="form-control box mb-2" id="yourPassword" name="yourPassword">
                        <span id="messageInfosPassword"></span>
                        <span id='pwdInformation' class="informationPwd">5 caractères minimum / une majuscule / 1 chiffre minimum  / 1 caractère spécial</span>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-sm-5 bg-light">
                        <label class="form-label mt-2 d-flex justify-content-start"> Confirmation du mot de passe
                            :</label>
                        <input type="password" class="form-control box" id="yourConfirmPassword" name="yourConfirmPassword">
                        <span id="messageInfosConfirmPassword"></span>
                        <span id="messageInfosNotSamePassword"></span>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-sm-3d-flex justify-content-center">
                        <button type="submit" class="btn btnConnect mt-5 mb-3" id='myButton' name="myButton">Valider mes informations</button>

                    </div>
                    <span id='buttonInformation' style="font-style: italic">Veuillez remplir tous les champs pour valider</span>
                </div>
                <input type="hidden" name="recaptcha_response" id="recaptchaResponse">
            </form>

        </div>
    </div>
</div>

<?php require 'views/footer.php'; ?>


<script type="text/javascript" src="/assets/js/script.js"></script>

<script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
</script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php

//après avoir validé le formulaire tu lances le message de confirmation et au clic sur ok tu renvoi sur la page de connection
if (isset($_POST['myButton']) && $error == 0) { ?>

    <script>
        Swal.fire({
                title: "<?= $titleSweet ?>",
                text: "<?= $textSweet ?>",
                icon: "<?= $iconSweet ?>",
                confirmButtonColor: '#000'
            })
            .then(function() {
                window.location = "<?= $redirectionSweet ?>";
            });
    </script>

<?php } ?>



</body>

</html>