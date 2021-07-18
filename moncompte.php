<?php require 'views/header.php'; ?>

<body>
  

  <div class="container-fluid centerPage text-center">

    <div class="row justify-content-center">
      <div class="col-sm-10 bg-light border">
        <h1 class="text-center">Mes informations personnelles</h1>



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


        <div class="row justify-content-around mb-3">
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

          <div class="col-sm-3 bg-light">
            <label class="form-label mt-2 d-flex justify-content-start"> Statut :</label>
            <input type="name" class="form-control box" id="yourPassword">
            <span id="messageInfosPassword"></span>
          </div>

        </div>

      </div>
    </div>

    <div class="row justify-content-around mt-5">


      <div class="col-sm-4">
        <a href="mespublications.php">
          <button type="button" class="btn btn-primary btn-lg">Mes publications <br> <i class="bi bi-newspaper"></i>
          </button>
        </a>
      </div>


      <div class="col-sm-4" href="favoris.php">
        <a href="favoris.php">
          <button type="button" class="btn btn-primary btn-lg">Mes favoris <br> <i class="bi bi-heart"></i> </button>
        </a>
      </div>


      <div class="col-sm-4">
        <a href="messages.php">
          <button type="button" class="btn btn-primary btn-lg">Mes messages <br> <i class="bi bi-envelope"></i>
          </button>
        </a>
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
          }
          if (yourConfirmPassword.value != yourPassword.value) {
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


<?php require 'views/footer.php'; ?>

      <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
      </script>

</body>

</html>