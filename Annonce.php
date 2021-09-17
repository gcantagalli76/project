<?php require 'views/header.php';

require './controllers/controller.php';

?>

<div class="container-fluid centerPage">


  <div class="row d-flex justify-content-center Annonce">

    <div class="col-md-5">

      <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <?php foreach ($displayDetailsArticleArray as $articles) { ?>
          <div class="carousel-inner p-2">
            <div class="carousel-item active carrousselHeight">
              <img src="data:image/png;base64, <?= $articles['picture1'] ?>" alt="picture1" class="d-block w-100 carrousselPicture">
            </div>
            <div class="carousel-item p-2 carrousselHeight">
              <img src="data:image/png;base64, <?= $articles['picture2'] ?>" alt="picture2" class="d-block w-100 carrousselPicture">
            </div>
            <div class="carousel-item p-2 carrousselHeight">
              <img src="data:image/png;base64, <?= $articles['picture3'] ?>" alt="picture3" class="d-block w-100 carrousselPicture">
            </div>
          </div>
          <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </button>
      </div>
    </div>


    <div class="col-md-6">

      <h2 id="<?= $articles['ARTICLE_ID'] ?>-article" class="text-center mt-3"><?= $articles['ARTICLE_TITLE'] ?></h2>
      <div class="border-bottom p-2">
        <div class="mt-4">Acheté le <?= $articles['ARTICLE_PURCHASEDATE'] ?> - <?= $articles['CONDITION_NAME'] ?></div>
        <h4><?= $articles['ARTICLE_PRICE'] ?>€</h4>
        <div class="mb-1">Publié par : <?= $articles['USER_FIRSTNAME'] ?></div>
        <img src="./assets/img/geo-alt.svg" alt="geo" width="20px">
        <a><?= $articles['USER_CITY'] ?></a>
      </div>

      <div class="border-bottom">
        <h6 class="mt-2">Description</h6>
        <div class="mt-3"><?= $articles['ARTICLE_DESCRIPTION'] ?></div>
        <div class="mt-4 mb-2">Quantitée restante comparée au produit neuf : <?= $articles['ARTICLE_QUANTITY'] ?>%</div>
      </div>

      <div class="row mt-5">
        <form class="col-md-6 text-center" method="post">
          <button type="submit" class="btn btnConnect mt-3 mb-3" name="addFavorite" value="<?= $articles['ARTICLE_ID'] ?>"><i class="bi bi-heart"></i> Ajouter aux favoris</button>
        </form>

        <div class="col-md-6 text-center">
          <button type="submit" class="btn btnConnect mt-3 mb-3" data-bs-toggle="modal" data-bs-target="#messageModal"><i class="bi bi-envelope"></i> Contacter le vendeur</button>
        </div>

      </div>

      <?php if (isset($_SESSION['statusId']) && $_SESSION['statusId'] == 1 && isset($_GET['idarticle'])) { ?>
        <div class="row mt-2 ">
          <form class="col-md-6 text-center" method="post">
            <button type="submit" class="btn btnConnect" name="validArticleBtn" value="<?= $articles['ARTICLE_ID'] ?>"><i class="bi bi-check-circle"></i> Valider l'annonce</button>
          </form>


          <div class="col-md-6 text-center">
            <div class="btn bi bi-trash deletebtn btnConnect" id="deletebtn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-article-id="<?= $articles['ARTICLE_ID'] ?>"> Supprimer l'annonce</div>
          </div>
          </div>
        
      <?php } ?>

      <?php if (isset($_SESSION['statusId']) && $_SESSION['statusId'] == 1 && isset($_GET['idArticleConsult'])) { ?>
        <div class="row mt-2 ">
        <div class="col-md-6 text-center">
          <div class="btn bi bi-trash deletebtn btnConnect" id="deletebtn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-article-id="<?= $articles['ARTICLE_ID'] ?>"> Supprimer l'annonce</div>
        </div>
        </div>
        

  <?php } ?>

  </div>


  <!-- -------------- -->
  <!--  MODALE DELETE -->
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
  <!--  MODALE DELETE -->
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
          <button id="sendMessage" name="sendMessage" type="submit" class="btn btnConnect">Envoyer votre message</button>
          <input type="hidden" name="articleId" value="<?= $articles['ARTICLE_ID'] ?>">
        </div>


      </form>
    </div>
  </div>

  <!-- -------------- -->
  <!-- MODALE MESSAGE -->
  <!-- -------------- -->

  </div>

</div>
</div>



<?php }
        require 'views/footer.php'; ?>

</div>


<script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
</script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php

//après avoir validé le coeur tu confirmes que l'annonce a bien été ajoutée aux favoris si l'utilisateur à bien une sessions d'ouverte
if (isset($_POST['addFavorite']) && isset($_SESSION['email'])) { ?>

  <script>
    Swal.fire({
      title: "<?= $titleSweet ?>",
      text: "<?= $textSweet ?>",
      icon: "<?= $iconSweet ?>",
      confirmButtonColor: '#000'
    })
  </script>

<?php } elseif (isset($_POST['addFavorite']) && !isset($_SESSION['email'])) { ?>
  <script>
    Swal.fire({
      title: "Veuillez vous connecter !",
      text: "Vous devez vous connecter ou créer un compte pour rajouter un article dans vos favoris",
      icon: 'error',
      confirmButtonColor: '#000'
    }).then(function() {
      window.location = "connection.php";
    });
  </script>
<?php } ?>

<script>
  // Mise en place de la swal pour indiquer que l'annonce a été supprimée
  if (<?= $deleteSuccess ?>) {
    Swal.fire({
      icon: 'success',
      text: 'Cette annonce a bien été supprimée !',
      confirmButtonColor: '#000'
    }).then(function() {
      window.location = "publitovalid.php";
    });
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

<?php

//après avoir validé l'envoi du message tu indiques à l'utilisateur que le message a bien été envoyé
if (isset($_POST['sendMessage'])) { ?>

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