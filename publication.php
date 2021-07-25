<?php require 'views/header.php'; ?>

<body>

  <div class="container-fluid centerPage text-center">
    <div class="row justify-content-center">
      <div class="col-sm-10 bg-light border shadowblock">
        <h1 class="text-center">Votre annonce</h1>
        <div class="row justify-content-around">
          <div class="col-sm-6">
            <div class="row">
              <div class="col-sm-10 mt-3">
                <label class="form-label mt-2 d-flex justify-content-start"> Titre de l'annonce :</label>
                <input type="text" class="form-control box" id="yourTitle" maxlength="40">
              </div>
            </div>
            <div class="row mt-4">
              <div class="col-sm-5 mt-2">
                <select class="form-select" aria-label="Default select example" id="yourCategory">
                  <option selected disabled>Catégorie :</option>
                  <option value="1">Carrelage, parquet, sol</option>
                  <option value="2">Peinture et droguerie</option>
                  <option value="3">Matériaux de construction</option>
                </select>
              </div>
              <div class="col-sm-5 mt-2">
                <select class="form-select" aria-label="Default select example" id="yourState">
                  <option selected disabled>Etat du produit :</option>
                  <option value="1">Neuf</option>
                  <option value="2">Bon état</option>
                  <option value="3">Etat satisfaisant</option>
                </select>
              </div>
            </div>


            <div class="row mt-3">
              <div class="col-sm-10">
                <label for="customRange3" class="form-label mt-2">Quantité restante comparée au produit neuf</label>
                <input type="range" class=form-range mt-2 min="1" max="100" value="50" id="yourQuantity">
              </div>
            </div>

            <div class="row mt-3">
              <div class="col-sm-10">
              <span id="resultRange" class="fw-bold"></span>
            <span class="fw-bold">%</span>
              </div>
            </div>

            

            <!-- form-range  custom-range-->

            <div class="row mt-1">
              <div class="col-sm-4">
                <label class="form-label mt-2 d-flex justify-content-start"> Date d'achat :</label>
                <input type="date" class="form-control box" id="yourBuyDate">
                <span id="messageInfosTitle"></span>
              </div>
              <div class="col-sm-3">
                <label class="form-label mt-2 d-flex justify-content-start"> Prix de vente :</label>
                <input type="number" class="form-control box" id="yourPrice" min="1" max="10000">
                <span id="messageInfosTitle"></span>
              </div>
              <div class="col-sm-2">
                <label class="form-check-label mt-2 d-flex justify-content-start">Je donne!</label>
                <input type="checkbox" class="form-check-input mt-2" id="youGive">
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-sm-10">
                <label for="exampleFormControlTextarea1"
                  class="form-label mt-2 d-flex justify-content-start">Description du produit :</label>
                <textarea class="form-control2" id="yourDescription" rows="5" maxlength="170"></textarea>
                <span id="messageInfosTitle"></span>
              </div>
            </div>
          </div>
          <div class="col-sm-4 mt-3">
            <div class="row">
              <label class="form-label mt-2 d-flex justify-content-center"> Ajoutez vos photos :</label>
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
              <button type="submit" class="btn btnConnect mt-5 mb-3" id="validPublication">Valider ma
                publication</button>
            </div>
          </div>
        </div>
      </div>


      <?php require 'views/footer.php'; ?>

      <script type="text/javascript" src="/assets/js/scriptPubli.js"></script>

    </div>


    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

</body>

</html>