<?php require 'views/header.php'; ?>

<body>

  <div class="container-fluid centerPage text-center">
    <div class="row justify-content-center">
      <div class="col-sm-10 bg-light border">
        <h1 class="text-center">Votre annonce</h1>
        <div class="row justify-content-around">
          <div class="col-sm-6">
            <div class="row">
              <div class="col-sm-10">
                <label class="form-label mt-2 d-flex justify-content-start"> Titre de l'annonce :</label>
                <input type="name" class="form-control box" id="yourTitle" maxlength="30">
                <span id="messageInfosTitle"></span>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-5 mt-2">
                <select class="form-select" aria-label="Default select example">
                  <option selected disabled>Catégorie :</option>
                  <option value="1">Carrelage, parquet, sol</option>
                  <option value="2">Peinture et droguerie</option>
                  <option value="3">Matériaux de construction</option>
                </select>
              </div>
              <div class="col-sm-5 mt-2">
                <select class="form-select" aria-label="Default select example">
                  <option selected disabled>Etat du produit :</option>
                  <option value="1">Neuf</option>
                  <option value="2">Bon état</option>
                  <option value="3">Etat satisfaisant</option>
                </select>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-10">
                <label for="customRange3" class="form-label mt-2">Quantité restante comparée au produit neuf</label>
                <input type="range" class="form-range" min="0" max="5" step="0.5" id="customRange3">
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4">
                <label class="form-label mt-2 d-flex justify-content-start"> Date d'achat :</label>
                <input type="name" class="form-control box" id="yourTitle">
                <span id="messageInfosTitle"></span>
              </div>
              <div class="col-sm-2">
                <label class="form-label mt-2 d-flex justify-content-start"> Prix :</label>
                <input type="name" class="form-control box" id="yourTitle">
                <span id="messageInfosTitle"></span>
              </div>
              <div class="col-sm-2">
                <label class="form-check-label mt-2 d-flex justify-content-start">Je donne!</label>
                <input type="checkbox" class="form-check-input mt-2" id="flexCheckDefault">
              </div>
            </div>
            <div class="row">
              <div class="col-sm-10">
                <label for="exampleFormControlTextarea1"
                  class="form-label mt-2 d-flex justify-content-start">Description du produit :</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="5" maxlength="170"></textarea>
                <span id="messageInfosTitle"></span>
              </div>
            </div>
          </div>
          <div class="col-sm-4">
            <div class="row">
              <label class="form-label mt-2 d-flex justify-content-start"> Ajoutez vos photos :</label>
              <div class="text-center mt-1">
                <img src="/assets/img/carrelagelm.jpg" class="rounded" alt="..." width="200px">
              </div>
            </div>
            <div class="row">
              <div class="text-center mt-1">
                <img src="/assets/img/carrelagelm.jpg" class="rounded" alt="..." width="200px">
              </div>
            </div>
            <div class="row">
              <div class="text-center mt-1">
                <img src="/assets/img/carrelagelm.jpg" class="rounded" alt="..." width="200px">
              </div>
            </div>
          </div>
          <div class="row justify-content-center">
            <div class="col-sm-3 d-flex justify-content-center">
              <button type="submit" class="btn text-white bg-primary mt-3 mb-3">Valider ma publication</button>
            </div>
          </div>
        </div>
      </div>


      <?php require 'views/footer.php'; ?>


    </div>


    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

</body>

</html>