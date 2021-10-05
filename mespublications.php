<?php require './views/header.php';

require './controllers/controller.php'; ?>


<?php if (empty($displayUserArticleArray)) { ?>
  <h1 class="text-center p-5 countCategoryTitle">Aucune annonce publiée pour le moment</h1>
<?php } else { ?>
  <h1 class="text-center p-5 countCategoryTitle">Mes publications</h1>
<?php } ?>


<div class="container-fluid">
  <?php foreach ($displayUserArticleArray as $articles) { ?>
    <div class="card mb-3 favorite" style="width: 100%;">
      <div class="row g-0">
        <div class="col-md-2 d-flex align-items-center justify-content-center">
          <img src="data:image/png;base64, <?= $articles['picture1'] ?>" alt="picture1" width="150px" style="max-height: 150px;">
        </div>
        <div class="col-md-2">
          <div class="card-body">
            <h4 id="<?= $articles['ARTICLE_ID'] ?>-article" class="card-title"><?php echo $articles['ARTICLE_TITLE'] ?></h4>
            <p class="card-text"><?php echo $articles['ARTICLE_PRICE'] ?>€</p>
            <p class="card-text"><small class="text-muted">CATEGORIE: <?= $articles['CATEGORY_NAME'] ?></small></p>
          </div>
        </div>
        <div class="col-md-5">
          <div class="card-body">
            <h6 class="card-title">Descriptif :</h6>
            <p class="card-text"><?php echo $articles['ARTICLE_DESCRIPTION'] ?></p>
          </div>
        </div>

        <div class="col-md-3">
          <div class="card-body">
            <div class="d-flex justify-content-center text-<?= $articles['valid'] == 1 ? 'success' : 'danger' ?>"><?= $articles['valid'] == 1 ? 'Article publié' : 'Article en attente de validation' ?></div>
            <div class="d-flex align-items-center p-3 justify-content-center">
              <div class="btn bi bi-trash ms-2 deletebtn" id="deletebtn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-article-id="<?= $articles['ARTICLE_ID'] ?>"> Supprimer</div>
            </div>

            <form class="d-flex align-items-center p-3 justify-content-center" action="publicationmodify.php" method="post">
              <button type="submit" class="btn bi bi-pencil ms-2" name="idArticleModify" value="<?php echo $articles['ARTICLE_ID'] ?>"> Modifier</button>
            </form>

          </div>
        </div>
      </div>
    </div>
    <?php } ?>
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



  <?php require './views/footer.php'; ?>


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

</body>

</html>