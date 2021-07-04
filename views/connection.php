<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="stylesheet" href="/assets/css/style.css">
  <title>Bricoleur du Dimanche</title>
</head>

<body>

<?php require 'header.php'; ?>

  <div class="container-fluid centerPage text-center">

    <div class="row justify-content-center">
      <div class="col-sm-3 bg-light border">
        <h1>Connectez-vous à votre compte</h1>

        <label class="form-label mt-4 d-flex justify-content-start"> Adresse email :</label>
        <input type="email" class="form-control box">

        <label class="form-label mt-2 d-flex justify-content-start">Mot de passe :</label>
        <input type="password" class="form-control box">

        <button type="submit" class="btn text-white bg-primary mt-3">Se connecter</button>
        <a href="/views/creationcpt.php">
        <div class="mt-4 mb-3">Pas encore membre ? Créez votre compte !</div>
        </a>
      </div>
    </div>



    <div class="row footer-size align-items-center">
      <div class="col-md-3">
        <a class="nav-link active text-white">Nous contacter</a>
        <img src="/assets/img/envelope.svg" alt="heart" width="25px">
      </div>
      <div class="col-md-6">
        <a class="nav-link active text-white">Mentions légales - Conditions générales d'utilisation - Gestion des
          données personnelles</a>
      </div>
      <div class="col-md-3">
        <a class="nav-link active text-white">Rejoignez nous !</a>
        <img src="/assets/img/facebook.svg" alt="heart" width="25px">
        <img src="/assets/img/instagram.svg" alt="heart" width="25px">
        <img src="/assets/img/twitter.svg" alt="heart" width="25px">
      </div>
    </div>

  </div>




  <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
  </script>

</body>

</html>