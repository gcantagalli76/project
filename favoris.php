<?php require 'views/header.php';

require './controllers/controller.php';

?>

<body>


  <h1 class="text-center p-5">Mes favoris</h1>


  <div class="container-fluid">
    <?php foreach ($displayFavoriteArticleArray as $display) { ?>
      <div class="card mb-3 favorite" style="width: 95%;">
        <div class="row g-0">

          <a class="col-md-2 d-flex align-items-center justify-content-center btn" type="submit" href="Annonce.php?idarticle=<?php echo $display['ARTICLE_ID'] ?>">
            <img src="data:image/png;base64, <?= $display['picture1'] ?>" alt="picture1" width="150px" style="max-height: 150px;">
          </a>

          <a class="col-md-3 btn" type="submit" href="Annonce.php?idarticle=<?php echo $display['ARTICLE_ID'] ?>">
            <div class="card-body">
              <h4 id="<?= $display['ARTICLE_ID'] ?>-article" class="card-title"><?= $display['ARTICLE_TITLE'] ?></h4>
              <p class="card-text"><?= $display['ARTICLE_PRICE'] ?>€</p>
              <p class="card-text"><small class="text-muted">CATEGORIE: <?= $display['CATEGORY_NAME'] ?></small></p>
            </div>
          </a>

          <a class="col-md-4 btn" type="submit" href="Annonce.php?idarticle=<?php echo $display['ARTICLE_ID'] ?>">
            <div class="card-body">
              <h6 class="card-title">Descriptif :</h6>
              <p class="card-text"><?= $display['ARTICLE_DESCRIPTION'] ?></p>
            </div>
          </a>


          <div class="col-md-3">
            <div class="card-body">

              <div class="d-flex align-items-center p-3 justify-content-center">
                <div class="btn bi bi-trash ms-2 deletebtn" id="deletebtn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-article-id="<?= $display['ARTICLE_ID'] ?>"> Supprimer</div>
              </div>

              <!-- <div class="d-flex align-items-center p-3 justify-content-center">
                <i class="bi bi-envelope"></i>
                <div class="ms-2">Envoyer un message</div>
              </div> -->

              <div class="d-flex align-items-center p-3 justify-content-center btn" data-bs-toggle="modal" data-bs-target="#messageModal">
                <i class="bi bi-envelope"></i>
                <div class="ms-2">Envoyer un message</div>
              </div>

              <!-- <div class="col-md-6 text-center">
                <button type="submit" class="btn btnConnect mt-3 mb-3" data-bs-toggle="modal" data-bs-target="#messageModal"><i class="bi bi-envelope"></i> Contacter le vendeur</button>
              </div> -->

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
            <button id="idArticleDelete" name="idArticleFavoriteDelete" type="submit" class="btn btn-danger">Supprimer</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- -------------- -->
  <!--  UNIQUE MODALE -->
  <!-- -------------- -->

  <!-- -------------- -->
  <!-- MODALE MESSAGE -->
  <!-- -------------- -->

  <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="messageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form class="modal-content" method="POST">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Votre message</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <div class="mb-3">
            <label for="message-text" class="col-form-label">Message:</label>
            <textarea class="form-control" id="message-text" name="textMessage" style="height: 10em;"></textarea>
          </div>

        </div>
        <div class="modal-footer">
          <button id="sendMessage" name="sendMessageInFavorite" type="submit" class="btn btnConnect">Envoyer votre message</button>
          <input type="hidden" name="articleId" value="<?= $display['ARTICLE_ID'] ?>">
        </div>


      </form>
    </div>
  </div>

  <!-- -------------- -->
  <!-- MODALE MESSAGE -->
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

//après avoir validé l'envoi du message tu indiques à l'utilisateur que le message a bien été envoyé
if (isset($_POST['sendMessageInFavorite'])) { ?>

  <script>
    Swal.fire({
      title: "Message envoyé",
      text: "Votre message a bien été envoyé au vendeur de cet article",
      icon: "success",
      confirmButtonColor: '#000'
    });
  </script>

<?php } ?>

</body>

</html>