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
      <div class="col-sm-10 bg-light border">
        <h1 class="text-center">Créez votre compte</h1>
        <div class="d-flex justify-content-start">Créez votre compte rapidement et retrouvez toutes les informations sur vos annonces postées et vos favoris</div>

        <div class="row justify-content-around">
<div class="col-sm-3 bg-light">
    <label class="form-label mt-2 d-flex justify-content-start"> Nom :</label>
    <input type="name" class="form-control box" id="yourName">
    <span id="messageInfosName"></span> 
</div>

<div class="col-sm-3 bg-light">
    <label class="form-label mt-2 d-flex justify-content-start"> Prénom :</label>
    <input type="firstname" class="form-control box" id="yourFirstName">
    <span id="messageInfosFirstName"></span> 
</div>

<div class="col-sm-3 bg-light">
    <label class="form-label mt-2 d-flex justify-content-start"> Adresse email :</label>
    <input type="name" class="form-control box" id="yourEmail">
    <span id="messageInfosEmail"></span> 
</div>
</div>


<div class="row justify-content-center">
    <div class="col-sm-3 bg-light">
        <label class="form-label mt-2 d-flex justify-content-start"> Ville :</label>
        <input type="name" class="form-control box" id="yourCity">
        <span id="messageInfosCity"></span> 
    </div>
    
    <div class="col-sm-3 bg-light">
        <label class="form-label mt-2 d-flex justify-content-start"> Code postale :</label>
        <input type="firstname" class="form-control box" id="yourPostalCode">
        <span id="messageInfosPostalCode"></span> 
    </div>
    
    </div>

    <div class="row justify-content-center">
        <div class="col-sm-3 bg-light">
            <label class="form-label mt-2 d-flex justify-content-start"> Mot de passe :</label>
            <input type="name" class="form-control box" id="yourPassword">
            <span id="messageInfosPassword"></span>
        </div>
        
        <div class="col-sm-3 bg-light">
            <label class="form-label mt-2 d-flex justify-content-start"> Confirmation du mot de passe :</label>
            <input type="firstname" class="form-control box" id="yourConfirmPassword">
            <span id="messageInfosConfirmPassword"></span>
            <span id="messageInfosNotSamePassword"></span>
        </div>
        
        </div>

        <div class="row justify-content-center">
            <div class="col-sm-3d-flex justify-content-center">
        <button type="submit" class="btn text-white bg-primary mt-3 mb-3">Valider mes informations</button>
    </div>
    </div>



      </div>
    </div>


    
  <script>

    const regexName = new RegExp(/^([a-zA-Z ]+)$/);
    const regexPostal = new RegExp("^[0-9]{1,10}$");
    const regexEmail = new RegExp("[^@ \t\r\n]+@[^@ \t\r\n]+\.[^@ \t\r\n]+");
    const button = document.querySelector('button');
    const regexCity = new RegExp(/^([a-zA-Z ]+)$/);
    const regexPassword = new RegExp(/^([a-zA-Z ]+)$/); //a modifier
    
    
    yourName.addEventListener("keyup", function () {
      if (!regexName.test(yourName.value) && yourName.value != "") {
        // J'écris le message dans l'element span et je lui attribue une classe
        messageInfosName.innerHTML = "Mauvais format" 
        messageInfosName.className = "error"
        button.disabled = true
      } else {
        // dans le cas contraire j'efface le message et je retire la classe
        messageInfosName.innerHTML = ""
        messageInfosName.classList.remove("error")
        button.disabled = false
      }
    })
    
    yourFirstName.addEventListener("keyup", function () {
      if (!regexName.test(yourFirstName.value) && yourFirstName.value != "") {
        // J'écris le message dans l'element span et je lui attribue une classe
        messageInfosFirstName.innerHTML = "Mauvais format"
        messageInfosFirstName.className = "error"
        button.disabled = true
      } else {
        // dans le cas contraire j'efface le message et je retire la classe
        messageInfosFirstName.innerHTML = ""
        messageInfosFirstName.classList.remove("error")
        button.disabled = false
      }
    })
    
    yourCity.addEventListener("keyup", function () {
      if (!regexCity.test(yourCity.value) && yourCity.value != "") {
        // J'écris le message dans l'element span et je lui attribue une classe
        messageInfosCity.innerHTML = "Mauvais format"
        messageInfosCity.className = "error"
        button.disabled = true
      } else {
        // dans le cas contraire j'efface le message et je retire la classe
        messageInfosCity.innerHTML = ""
        messageInfosCity.classList.remove("error")
        button.disabled = false
      }
    })

    yourPostalCode.addEventListener("keyup", function () {
      if (!regexPostal.test(yourPostalCode.value) && yourPostalCode.value != "") {
        // J'écris le message dans l'element span et je lui attribue une classe
        messageInfosPostalCode.innerHTML = "Mauvais format"
        messageInfosPostalCode.className = "error"
        button.disabled = true
      } else {
        // dans le cas contraire j'efface le message et je retire la classe
        messageInfosPostalCode.innerHTML = ""
        messageInfosPostalCode.classList.remove("error")
        button.disabled = false
      }
    })

    
    yourEmail.addEventListener("keyup", function () {
      if (!regexEmail.test(yourEmail.value) && yourEmail.value != "") {
        // J'écris le message dans l'element span et je lui attribue une classe
        messageInfosEmail.innerHTML = "Mauvais format"
        messageInfosEmail.className = "error"
        button.disabled = true
      } else {
        // dans le cas contraire j'efface le message et je retire la classe
        messageInfosEmail.innerHTML = ""
        messageInfosEmail.classList.remove("error")
        button.disabled = false
      }
    })

    yourPassword.addEventListener("keyup", function () {
      if (!regexPassword.test(yourPassword.value) && yourPassword.value != "") {
        // J'écris le message dans l'element span et je lui attribue une classe
        messageInfosPassword.innerHTML = "Mauvais format"
        messageInfosPassword.className = "error"
        button.disabled = true
      } else {
        // dans le cas contraire j'efface le message et je retire la classe
        messageInfosPassword.innerHTML = ""
        messageInfosPassword.classList.remove("error")
        button.disabled = false
      }
    })

    yourConfirmPassword.addEventListener("keyup", function () {
      if (!regexPassword.test(yourConfirmPassword.value) && yourConfirmPassword.value != "") {
        // J'écris le message dans l'element span et je lui attribue une classe
        messageInfosConfirmPassword.innerHTML = "Mauvais format"
        messageInfosConfirmPassword.className = "error"
        button.disabled = true
      } if (yourConfirmPassword.value != yourPassword.value) {
        messageInfosConfirmPassword.innerHTML = "Mot de passe différent du premier"
        messageInfosConfirmPassword.className = "error"
        button.disabled = true
      } else {
        // dans le cas contraire j'efface le message et je retire la classe
        messageInfosConfirmPassword.innerHTML = ""
        messageInfosConfirmPassword.classList.remove("error")
        button.disabled = false
      }
    })
    
    
      </script>



<div class="row footer-size align-items-center">
  <div class="col-md-3">
    <a class="nav-link active text-white">Nous contacter</a>
    <img src="/assets/img/envelope.svg" alt="heart" width="25px">
  </div>
  <div class="col-md-6">
    <a class="nav-link active text-white">Mentions légales - Conditions générales d'utilisation - Gestion des données personnelles</a>
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