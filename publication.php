<?php require 'views/header.php';

require './controllers/controller.php';

?>

<body>

  <div class="container-fluid centerPage text-center">
    <div class="row justify-content-center">
      <div class="col-sm-10 border shadowblock">
        <h1 class="text-center">Votre annonce</h1>
        <form action="" method="post" enctype="multipart/form-data">
          <div class="row justify-content-around">
            <div class="col-sm-6">
              <div class="row">
                <div class="col-sm-10 mt-3">
                  <label class="form-label mt-2 d-flex justify-content-start"> Titre de l'annonce :</label>
                  <input type="text" class="form-control box" id="yourTitle" name="yourTitle" maxlength="40">
                </div>
              </div>
              <div class="row mt-4">
                <div class="col-sm-5 mt-2">
                  <select class="form-select" aria-label="Default select example" id="yourCategory" name="yourCategory">
                    <option selected disabled>Catégorie :</option>
                    <option value="1">Carrelage, parquet, sol</option>
                    <option value="2">Peinture et droguerie</option>
                    <option value="3">Matériaux de construction</option>
                  </select>
                </div>
                <div class="col-sm-5 mt-2">
                  <select class="form-select" aria-label="Default select example" id="yourState" name="yourState">
                    <option selected disabled>Etat du produit :</option>
                    <option value="1">Neuf</option>
                    <option value="2">Bon état</option>
                    <option value="3">Etat satisfaisant</option>
                  </select>
                </div>
              </div>


              <div class="row mt-3">
                <div class="col-sm-10">
                  <label for="customRange3" class="form-label mt-2">Quantité restante comparée au produit neuf : </label>
                  <span id="resultRange" class="fw-bold" name="yourQuantity"></span>
                  <span class="fw-bold">%</span>
                  <input type="range" class=form-range mt-2 min="1" max="100" value="50" id="yourQuantity" name="yourQuantity">
                </div>
              </div>


              <div class="row mt-1">
                <div class="col-sm-4">
                  <label class="form-label mt-2 d-flex justify-content-start"> Date d'achat :</label>
                  <input type="date" class="form-control box" id="yourBuyDate" name="yourBuyDate">
                  <span id="messageInfosTitle"></span>
                </div>
                <div class="col-sm-3">
                  <label class="form-label mt-2 d-flex justify-content-start"> Prix de vente :</label>
                  <input type="number" class="form-control box" id="yourPrice" name="yourPrice" min="1" max="10000">
                  <span id="messageInfosTitle"></span>
                </div>
              </div>
              <div class="row mt-3">
                <div class="col-sm-10">
                  <label for="exampleFormControlTextarea1" class="form-label mt-2 d-flex justify-content-start">Description du produit :</label>
                  <textarea class="form-control2" id="yourDescription" name="yourDescription" rows="5" maxlength="170"></textarea>
                  <span id="messageInfosTitle"></span>
                </div>
              </div>
            </div>



            <div class="col-sm-5 mt-3">
              <div class="row">
                <label class="form-label mt-2 d-flex justify-content-center"> Ajoutez vos photos :</label>
              </div>

              <div class="row justify-content-center">
                <div class="col-sm-5 imgUp">
                  <div class="imagePreview"><img class="imagePreview" class="mx-auto d-block" width="100%" id="imgPreview"></div>
                  <label class="btn btn-primary">
                    Upload<input type="file" class="uploadFile img" value="Upload Photo1" id="fileToUpload" name="fileToUpload" style="width: 0px;height: 0px;overflow: hidden;">
                  </label>
                </div>
              </div>

              <div class="row justify-content-center">
                <div class="col-sm-5 imgUp">
                  <div class="imagePreview"><img class="imagePreview" class="mx-auto d-block" width="100%" id="imgPreview2"></div>
                  <label class="btn btn-primary">
                    Upload<input type="file" class="uploadFile img" value="Upload Photo2" id="fileToUpload2" name="fileToUpload2" style="width: 0px;height: 0px;overflow: hidden;">
                  </label>
                </div>
              </div>

              <div class="row justify-content-center">
                <div class="col-sm-5 imgUp">
                  <div class="imagePreview"><img class="imagePreview" class="mx-auto d-block" width="100%" id="imgPreview3"></div>
                  <label class="btn btn-primary">
                    Upload<input type="file" class="uploadFile img" value="Upload Photo3" id="fileToUpload3" name="fileToUpload3" style="width: 0px;height: 0px;overflow: hidden;">
                  </label>
                </div>
              </div>



            </div>

            <div class="row justify-content-center">
              <div class="col-sm-3 d-flex justify-content-center">
                <button type="submit" class="btn btnConnect mt-5 mb-3" id="validPublication" name="validPublication">Valider ma publication</button>
              </div>
              <span id='buttonInformation' style="font-style: italic">Veuillez remplir tous les champs et 3 photos pour valider votre annonce</span>
            </div>
          </div>
        </form>
      </div>

      <br>



      <?php require 'views/footer.php'; ?>

      <script type="text/javascript" src="./assets/js/scriptPubli.js"></script>

    </div>


    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php

    //après avoir validé l'annonce tu lances le message de confirmation et au clic sur ok tu renvoi sur la page de mes publications
    if (isset($_POST['validPublication']) && $emptyPublication == 0) { ?>

      <script>
        Swal.fire({
          title: "Annonce ajoutée !",
          text: "Votre annonce a bien été enregistrée, elle sera validée sous 24h avant sa publication",
          icon: "success",
          confirmButtonColor: '#000'
        }).then(function() {
          window.location = "mespublications.php";
        });
      </script>



    <?php } ?>

</body>

</html>