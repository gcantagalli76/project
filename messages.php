<?php require 'views/header.php';

require './controllers/controller.php'; ?>


<?php if (empty($displayUserMessages)) { ?>
  <h1 class="text-center p-5 countCategoryTitle">Vous n'avez pas de message</h1>
<?php } else { ?>
  <h1 class="text-center p-5 countCategoryTitle">Mes messages</h1>
<?php } ?>

<div class="container-fluid">
  <?php foreach ($displayUserMessages as $messages) { ?>
    <div class="card mb-3 favorite" style="width: 100%;">
      <div class="row g-0">
        <div class="col-md-2 d-flex align-items-center justify-content-center">
          <img src="data:image/png;base64, <?= $messages['picture1'] ?>" alt="picture1" width="150px" style="max-height: 150px;">
        </div>
        <div class="col-md-3 mt-2">
          <div class="card-body">
            <h4> <?= $messages['firstName'] ?> <?= $messages['lastName'] ?></h4>
            <h6> Annonce : <?= $messages['ARTICLE_TITLE'] ?></h6>
            <p class="card-text"><small class="text-muted">Date d'envoi: <?= $messages['SEND_DATE2'] ?></small></p>
          </div>
        </div>
        <div class="col-md-4 mt-2">
          <div class="card-body">
            <h6 class="card-title">Message :</h6>
            <p class="card-text"><?= $messages['CONVERSATION_TEXT'] ?></p>
          </div>
        </div>

        <div class="col-md-3">
          <div class="card-body">
            <div class="d-flex align-items-center p-3 justify-content-center">
              <div class="btn bi bi-trash ms-2 deletebtn" id="deletebtn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-article-id="<?= $messages['CONVERSATION_ID'] ?>"> Supprimer</div>
            </div>

            <form class="d-flex align-items-center p-3 justify-content-center" action="publicationmodify.php" method="post">
              <button type="submit" class="btn bi bi-pencil ms-2" name="idArticleModify" value="<?= $messages['CONVERSATION_ID'] ?>"> Répondre</button>
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
        <h5 class="modal-title text-white" id="exampleModalLabel">Suppression d'un message</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <p>Êtes vous sûre de vouloir supprimer ce message ?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
        <form action="" method="POST">
          <button id="idArticleDelete" name="messageDelete" type="submit" class="btn btn-danger">Supprimer</button>
          <input type="hidden" name="conversationId" value="<?= $messages['CONVERSATION_ID']  ?>">
        </form>
      </div>
    </div>
  </div>
</div>
<!-- -------------- -->
<!--  UNIQUE MODALE -->
<!-- -------------- -->


<?php require 'views/footer.php'; ?>


<script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
</script>


<!-- après avoir cliqué sur le bouton supprimer tu lances le message de confirmation -->

<script>
  if (<?= $deleteSuccess ?>) {
    Swal.fire({
      title: "Suppression !",
      text: "Votre message a bien été supprimé",
      icon: "success",
      confirmButtonColor: '#000'
    });
  }
</script>


</body>

</html>