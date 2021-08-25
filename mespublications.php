<?php require 'views/header.php'; 

require './controllers/controller.php';

?>


<body>

<h1 class="text-center p-5">Mes publications</h1>
  

  <div class="container-fluid">
  <?php foreach ($displayUserArticleArray as $articles) { ?>
  <div class="card mb-3 favorite" style="width: 95%;">
  <div class="row g-0">
    <div class="col-md-2 d-flex align-items-center justify-content-center">
    <img src="/assets/img/peinture.jpg" alt="paint" width="150px" style="max-height: 150px;">
    </div>
    <div class="col-md-2">
      <div class="card-body">
        <h4 class="card-title"><?php echo $articles['ARTICLE_TITLE']?></h4>
        <p class="card-text"><?php echo $articles['ARTICLE_PRICE']?></p>
        <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
      </div>
    </div>
    <div class="col-md-5">
      <div class="card-body">
      <h6 class="card-title">Descriptif :</h6>
        <p class="card-text"><?php echo $articles['ARTICLE_DESCRIPTION']?></p>
      </div>
    </div>

    <form class="col-md-3" action="" method="post">
      <div class="card-body">

      <div class="d-flex align-items-center p-3 justify-content-center" >
         <a type="submit" class=" btn bi bi-trash ms-2" name="delete" href="delete.php?iddelete=<?php echo $articles['ARTICLE_ID'];?>">   Supprimer</a> 
        </div>

        <div class="d-flex align-items-center p-3 justify-content-center">
        <a type="submit" class="bi bi-pencil ms-2" name="modify" href="publicationmodify.php?idmodify=<?php echo $articles['ARTICLE_ID'];?>">   Modifier</a>
        </div>

      </div>
  </form>
  </div>
</div>

  </div>


  <?php } require 'views/footer.php'; ?>


  <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
  </script>

</body>

</html>