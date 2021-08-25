<?php require 'views/header.php'; 

// connection à la base de données, en cas de problème message d'erreur
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=bddproject;charset=utf8mb4', 'root', '');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}


// je récupère via le GET le numéro de la categorie concernée pour afficher les bons articles sur la page

$idcategory = $_GET['idcategory'];
  
$consult = $bdd->prepare("SELECT A.*,
                          B.CATEGORY_NAME
FROM article as A left join category as B on A.CATEGORY_ID = B.CATEGORY_ID WHERE A.CATEGORY_ID = :idcategory");
$consult->execute(array( ':idcategory' => $idcategory ) );



// obligé de refaire une requête pour afficher le titre de la catégorie sur la page car en repartant de la première requête cela m'efface la première annonce

$consultbis = $bdd->prepare("SELECT A.*,
                          B.CATEGORY_NAME
FROM article as A left join category as B on A.CATEGORY_ID = B.CATEGORY_ID WHERE A.CATEGORY_ID = :idcategory");
$consultbis->execute(array( ':idcategory' => $idcategory ) );


$display = $consultbis->fetch();
$categoryName = $display['CATEGORY_NAME'];

?>

<body>

<div class="container-fluid text-center">
    <div class="row">
      <div class="col-6 col-lg-4 lastPublication">
      <?=$categoryName?>
      </div>
    </div>

    <div class="row justify-content-start">


<?php  while ($display = $consult->fetch()) {

    $articleTitle = $display['ARTICLE_TITLE'];
    $articleDescription = $display['ARTICLE_DESCRIPTION'];
    $articlePrice = $display['ARTICLE_PRICE'];
  

?>
 

      <div class="col-md-2 p-4">
        <div class="card" style="width: 14rem;">
          <img src="/assets/img/peinture.jpg" class="card-img-top" alt="paint">
          <div class="card-body">
            <h5 class="card-title"><?=$articleTitle?></h5>
            <p class="card-text"><?=$articleDescription?></p>
            <div class="row">
              <div class="col-md-3">
                <a style="font-weight : bold"><?=$articlePrice?>€</a>
              </div>
              <div class="col-md-5">
                <img src="/assets/img/geo-alt.svg" alt="heart" width="20px">
                <a>Le Havre</a>
              </div>
              <div class="col-md-4">
                <img src="/assets/img/heart.svg" alt="heart" width="20px" href="addfavorite.php?idfavorite=<?php echo $display['ARTICLE_ID'];?>">
              </div>
            </div>
          </div>
        </div>
      </div>


    <!-- </div> -->


    <?php  } $consult->closeCursor(); require 'views/footer.php'; ?>


  </div>


      <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
      </script>


</body>

</html>