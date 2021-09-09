<?php require 'views/header.php';

require './controllers/controller.php';

?>

<body>

  <div class="container-fluid centerPage text-center">
    <div class="row justify-content-center">
      <div class="col-sm-10 bg-light border shadowblock">
        <h1 class="text-center">Votre annonce à modifier</h1>
        <form action="" method="post" enctype="multipart/form-data">
          <div class="row justify-content-around">
            <div class="col-sm-6">
              <?php foreach ($displayArticleToModifArray as $displayB4Modif) { ?>
                <div class="row">
                  <div class="col-sm-10 mt-3">
                    <label class="form-label mt-2 d-flex justify-content-start"> Titre de l'annonce :</label>
                    <input type="text" class="form-control box" id="yourTitle" name="yourTitle" maxlength="40" value="<?= isset($_POST['yourTitle']) ? $_POST['yourTitle'] : $displayB4Modif['ARTICLE_TITLE'] ?>">
                  </div>
                </div>
                <div class="row mt-4">
                  <div class="col-sm-5 mt-2">
                    <select class="form-select" aria-label="Default select example" id="yourCategory" name="yourCategory">
                      <option selected disabled>Catégorie :</option>
                      <option value="1" <?= ($displayB4Modif['CATEGORY_ID'] == 1) || ( isset($_POST['yourCategory']) && $_POST['yourCategory'] == 1) ? 'selected' : '' ?>>Carrelage, parquet, sol</option>
                      <option value="2" <?= ($displayB4Modif['CATEGORY_ID'] == 2) || ( isset($_POST['yourCategory']) && $_POST['yourCategory'] == 2) ? 'selected' : '' ?>>Peinture et droguerie</option>
                      <option value="3" <?= ($displayB4Modif['CATEGORY_ID'] == 3) || ( isset($_POST['yourCategory']) && $_POST['yourCategory'] == 3) ? 'selected' : '' ?>>Matériaux de construction</option>
                    </select>
                  </div>
                  <div class="col-sm-5 mt-2">
                    <select class="form-select" aria-label="Default select example" id="yourState" name="yourState">
                      <option selected disabled>Etat du produit :</option>
                      <option value="1" <?= ($displayB4Modif['CONDITION_ID'] == 1) || (isset($_POST['yourState']) && $_POST['yourState'] == 1) ? 'selected' : '' ?>>Neuf</option>
                      <option value="2" <?= ($displayB4Modif['CONDITION_ID'] == 2) || (isset($_POST['yourState']) && $_POST['yourState'] == 2) ? 'selected' : '' ?>>Bon état</option>
                      <option value="3" <?= ($displayB4Modif['CONDITION_ID'] == 3) || (isset($_POST['yourState']) && $_POST['yourState'] == 3) ? 'selected' : '' ?>>Etat satisfaisant</option>
                    </select>
                  </div>
                </div>


                <div class="row mt-3">
                  <div class="col-sm-10">
                    <label for="customRange3" class="form-label mt-2">Quantité restante comparée au produit neuf</label>
                    <input type="range" class=form-range mt-2 min="1" max="100" value="<?= isset($_POST['yourQuantity']) ? $_POST['yourQuantity'] : $displayB4Modif['ARTICLE_QUANTITY'] ?>" id="yourQuantity" name="yourQuantity">
                  </div>
                </div>

                <div class="row mt-3">
                  <div class="col-sm-10">
                    <span id="resultRange" class="fw-bold" name="yourQuantity"></span>
                    <span class="fw-bold">%</span>
                  </div>
                </div>



                <!-- form-range  custom-range-->

                <div class="row mt-1">
                  <div class="col-sm-4">
                    <label class="form-label mt-2 d-flex justify-content-start"> Date d'achat :</label>
                    <input type="date" class="form-control box" id="yourBuyDate" name="yourBuyDate" value="<?= isset($_POST['yourBuyDate']) ? $_POST['yourBuyDate'] : $displayB4Modif['ARTICLE_BUYDATE'] ?>">
                    <span id="messageInfosTitle"></span>
                  </div>
                  <div class="col-sm-3">
                    <label class="form-label mt-2 d-flex justify-content-start"> Prix de vente :</label>
                    <input type="number" class="form-control box" id="yourPrice" name="yourPrice" min="1" max="10000" value="<?= isset($_POST['yourPrice']) ? $_POST['yourPrice'] : $displayB4Modif['ARTICLE_PRICE'] ?>">
                    <span id="messageInfosTitle"></span>
                  </div>
                  <!-- <div class="col-sm-2">
                    <label class="form-check-label mt-2 d-flex justify-content-start">Je donne!</label>
                    <input type="checkbox" class="form-check-input mt-2" id="youGive" name="youGive" value="<?= $displayB4Modif['ARTICLE_GIVE'] ?>">
                  </div>  -->
                </div>
                <div class="row mt-3">
                  <div class="col-sm-10">
                    <label for="exampleFormControlTextarea1" class="form-label mt-2 d-flex justify-content-start">Description du produit :</label>
                    <textarea class="form-control2" id="yourDescription" name="yourDescription" rows="5" maxlength="170"><?= isset($_POST['yourDescription']) ? $_POST['yourDescription'] : $displayB4Modif['ARTICLE_DESCRIPTION'] ?></textarea>
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
                  <div class="imagePreview"><img src="data:image/png;base64, <?= $displayB4Modif['picture1'] ?>" alt="picture1" class="imagePreview" class="mx-auto d-block" width="100%" id="imgPreview"></div>
                  <label class="btn btn-primary">
                    Upload<input type="file" class="uploadFile img" value="Upload Photo1" id="fileToUpload" name="fileToUpload" style="width: 0px;height: 0px;overflow: hidden;">
                  </label>
                </div>
              </div>

              <div class="row justify-content-center">
                <div class="col-sm-5 imgUp">
                  <div class="imagePreview"><img src="data:image/png;base64, <?= $displayB4Modif['picture2'] ?>" alt="picture2" class="imagePreview" class="mx-auto d-block" width="100%" id="imgPreview2"></div>
                  <label class="btn btn-primary">
                    Upload<input type="file" class="uploadFile img" value="Upload Photo2" id="fileToUpload2" name="fileToUpload2" style="width: 0px;height: 0px;overflow: hidden;">
                  </label>
                </div>
              </div>

              <div class="row justify-content-center">
                <div class="col-sm-5 imgUp">
                  <div class="imagePreview"><img src="data:image/png;base64, <?= $displayB4Modif['picture3'] ?>" alt="picture3" class="imagePreview" class="mx-auto d-block" width="100%" id="imgPreview3"></div>
                  <label class="btn btn-primary">
                    Upload<input type="file" class="uploadFile img" value="Upload Photo3" id="fileToUpload3" name="fileToUpload3" style="width: 0px;height: 0px;overflow: hidden;">
                  </label>
                </div>
              </div>
            </div>



            <div class="row justify-content-center">
              <div class="col-sm-3 d-flex justify-content-center">
                <button type="submit" class="btn btnConnect mt-5 mb-3" id="validModification" name="validModification">Valider ma modification</button>
              </div>
            </div>
          </div>
          <!-- Je met un input invisible qui recupère l'id de larticle en mettant le même name pour qu'au raffraichissement des page au clic sur les boutons je ne perde pas le post detail -->
          <input type="hidden" name="idArticleModify" value="<?= $_POST['idArticleModify'] ?>">
        </form>
      </div>



      <script type="text/javascript" src="/assets/js/scriptPubliModify.js"></script>

    <?php }
              require 'views/footer.php'; ?>


    </div>


    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <?php

    //après avoir modifié l'annonce tu lances le message de confirmation et au clic sur ok tu renvoi sur la page de mes publications
    if (isset($_POST['validModification'])) { ?>

      <script>
        Swal.fire({
          title: "<?= $titleSweet ?>",
          text: "<?= $textSweet ?>",
          icon: "<?= $iconSweet ?>",
          confirmButtonColor: '#000'
        }).then(function() {
          if (<?= $swalRedirection ?>) {
            window.location = "mespublications.php"
          }
        })


        // if (!=<?= $swalRedirection ?>) {
        //   Swal.fire({
        //     title: "<?= $titleSweet ?>",
        //     text: "<?= $textSweet ?>",
        //     icon: "<?= $iconSweet ?>",
        //     confirmButtonColor: '#000'
        //   })
        // }
      </script>



    <?php } ?>

</body>

</html>