<?php require 'views/header.php';

require './controllers/controller.php';

?>


<body>


  <?php if (empty($displayAdminArticleArray)) { ?>
    <h1 class="text-center p-5 countCategoryTitle">Vous n'avez pas de publications à valider</h1>
  <?php } else { ?>
    <h1 class="text-center p-5 countCategoryTitle">Publications à valider</h1>
  <?php } ?>


  <div class="container-fluid">
    <?php foreach ($displayAdminArticleArray as $articles) { ?>
      <div class="card mb-3 favorite" style="width: 95%;">
        <div class="row g-0">

          <a class="col-md-2 d-flex align-items-center justify-content-center btn" type="submit" href="Annonce.php?idarticle=<?php echo $articles['ARTICLE_ID'] ?>">
            <img src="data:image/png;base64, <?= $articles['picture1'] ?>" alt="picture1" width="150px" style="max-height: 150px;">
          </a>

          <a class="col-md-2 btn" type="submit" href="Annonce.php?idarticle=<?php echo $articles['ARTICLE_ID'] ?>">
            <div class="card-body">
              <h4 id="<?= $articles['ARTICLE_ID'] ?>-article" class="card-title"><?= $articles['ARTICLE_TITLE'] ?></h4>
              <p class="card-text"><?= $articles['ARTICLE_PRICE'] ?>€</p>
              <p class="card-text"><small class="text-muted">CATEGORIE: <?= $articles['CATEGORY_NAME'] ?></small></p>
            </div>
          </a>


          <a class="col-md-5 btn" type="submit" href="Annonce.php?idarticle=<?php echo $articles['ARTICLE_ID'] ?>">
            <div class="card-body">
              <h6 class="card-title">Descriptif :</h6>
              <p class="card-text"><?php echo $articles['ARTICLE_DESCRIPTION'] ?></p>
            </div>
          </a>

          <div class="col-md-3">
            <div class="card-body">

              <div class="d-flex align-items-center p-3 justify-content-center">
                <div class="btn bi bi-trash ms-2 deletebtn" id="deletebtn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-article-id="<?= $articles['ARTICLE_ID'] ?>"> Supprimer</div>
              </div>

              <form class="d-flex align-items-center p-3 justify-content-center" action="" method="post">
                <button type="submit" class="btn bi bi-check-circle  ms-2" name="validArticleBtn" value="<?php echo $articles['ARTICLE_ID'] ?>"> Valider</button>
              </form>

            </div>
          </div>
        </div>
      </div>

  </div>

  <!-- -------------- -->
  <!--  UNIQUE MODALE -->
  <!-- -------------- -->
  <div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-danger">
          <h5 class="modal-title text-white" id="exampleModalLabel">Suppression d'une annonce</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          <p>Êtes vous sûre de vouloir supprimer l'annonce <b><span id="articleNameDelete"></span></b></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
          <form action="" method="POST">
            <button id="idArticleDelete" name="idArticleDelete" type="submit" class="btn btn-danger">Supprimer</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- -------------- -->
  <!--  UNIQUE MODALE -->
  <!-- -------------- -->


<?php }
    require 'views/footer.php'; ?>


<script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
</script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
  // Mise en place de la swal pour indiquer que l'annonce a été supprimée
  if (<?= $deleteSuccess ?>) {
    Swal.fire({
      icon: 'success',
      text: 'Votre annonce a bien été supprimée !',
      confirmButtonColor: '#000'
    })
  };

  // mise en place d'un array regroupant tous les boutons de la classe .deletebtn
  const trashButtonsArray = document.querySelectorAll('.deletebtn')

  // on ajoute un écouteur d'événement sur chaque bouton au click
  trashButtonsArray.forEach(element => {
    element.addEventListener('click', function() {
      // on recupere la valeur du data pour l'inserer dans la value du button correspondant
      document.getElementById('idArticleDelete').value = this.dataset.articleId
      // on recupere la valeur des id contenant les nom et prenoms pour l'insérer dans la div
      document.getElementById('articleNameDelete').innerHTML = document.getElementById(this.dataset.articleId + '-article').innerText;
    })
  });
</script>

<?php

//après avoir validé la publication par l'admin tu lances le message de confirmation et au clic sur ok tu renvoi sur la page des articles à valider
if (isset($_POST['validArticleBtn'])) { ?>

  <script>
    Swal.fire({
      title: "Article validé",
      text: "Cet article va être publié sur le site suite à votre validation",
      icon: "success",
      confirmButtonColor: '#000'
    }).then(function() {
      window.location = "publitovalid.php";
    });
  </script>

<?php } ?>

</body>

</html>