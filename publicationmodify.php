<?php require 'views/header.php'; 


// si il n'y a pas d'email dans les cookies alors tu renvois l'utilisateur direct sur la page connectpourpubli sinon tu lances le reste
if (!isset($_COOKIE['email'])) {
  header("Location: connectforpublication.php");
}else {


// connection à la base de données, en cas de problème message d'erreur
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=bddproject;charset=utf8mb4', 'root', '');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

// je récupère via le GET le numéro de l'article concerné pour afficher les infos de l'article à modifier sur la page

if (isset($_GET['idmodify'])) {

  $id = $_GET['idmodify'];
  
  $consult = $bdd->prepare("SELECT *, left(ARTICLE_PURCHASEDATE,10) as ARTICLE_BUYDATE FROM article WHERE ARTICLE_ID = :id");
  $consult->execute(array( ':id' => $id ) );

  while ($display = $consult->fetch()) {

      $articleTitle = $display['ARTICLE_TITLE'];
      $articleQuantity = $display['ARTICLE_QUANTITY'];
      $articleDescription = $display['ARTICLE_DESCRIPTION'];
      $articlePrice = $display['ARTICLE_PRICE'];
      $articlePurchasedate = $display['ARTICLE_BUYDATE'];
      $articleGive= $display['ARTICLE_GIVE'];
  
  // }

  // }

// si il valide la publication alors tu récupère les différents post et les mets dans des variables
//   if (isset($_POST['validModification'])) {

//     $title = $_POST["yourTitle"];
//     $category = $_POST["yourCategory"];
//     $state = $_POST["yourState"];
//     $quantity = $_POST["yourQuantity"];
//     $buyDate = $_POST["yourBuyDate"];
//     $price = $_POST["yourPrice"];
//     $description = $_POST["yourDescription"];

// // si l'utilisateur coche je donne alors tu attribut 1 à give, sinon tu mets 0
//     if (isset($_POST['youGive'])) {
//       $give = 1;
//     } else {
//       $give = 0;
//       }
 

//  // on récupère les informations dans la table _user pour pouvoir récupérer le user_id correspondant au cookie et donc à l'utilisateur connecté     

// $reponse = $bdd->query('SELECT * FROM _user');

// while ($donnees = $reponse->fetch()) {

// if ($_COOKIE['email'] == $donnees['USER_EMAIL']) {
// $userId = $donnees['USER_ID'];
// }}

// //on récupère les données remplies sur la publication pour les insérer dans la table article de notre base de données
//       $req = $bdd->prepare('INSERT INTO article(article_title,article_quantity,article_purchasedate,article_price,article_give,article_description,category_id,condition_id,user_id)
//       VALUES( :title, :quantity, :buyDate, :price, :give, :description, :category, :state, :userId)');


// $req->execute(array(
// 	'title' => $title,
//   'quantity' => $quantity,
//   'buyDate' => $buyDate,
// 	'price' => $price,
//   'give' => $give,
//   'description' => $description,
//   'category' => $category,
//   'state' => $state,
//   'userId' => $userId
// 	));


// };

?>

<body>

  <div class="container-fluid centerPage text-center">
    <div class="row justify-content-center">
      <div class="col-sm-10 bg-light border shadowblock">
        <h1 class="text-center">Votre annonce à modifier</h1>
        <form action="" method="post">
        <div class="row justify-content-around">
          <div class="col-sm-6">
            <div class="row">
              <div class="col-sm-10 mt-3">
                <label class="form-label mt-2 d-flex justify-content-start"> Titre de l'annonce :</label>
                <input type="text" class="form-control box" id="yourTitle" name="yourTitle" maxlength="40" value="<?=$articleTitle?>">
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
                <label for="customRange3" class="form-label mt-2">Quantité restante comparée au produit neuf</label>
                <input type="range" class=form-range mt-2 min="1" max="100" value="<?=$articleQuantity?>" id="yourQuantity" name="yourQuantity">
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
                <input type="date" class="form-control box" id="yourBuyDate" name="yourBuyDate" value="<?=$articlePurchasedate?>">
                <span id="messageInfosTitle"></span>
              </div>
              <div class="col-sm-3">
                <label class="form-label mt-2 d-flex justify-content-start"> Prix de vente :</label>
                <input type="number" class="form-control box" id="yourPrice" name="yourPrice" min="1" max="10000" value="<?=$articlePrice?>">
                <span id="messageInfosTitle"></span>
              </div>
              <div class="col-sm-2">
                <label class="form-check-label mt-2 d-flex justify-content-start">Je donne!</label>
                <input type="checkbox" class="form-check-input mt-2" id="youGive" name="youGive" value="<?=$articleGive?>">
              </div>
            </div>
            <div class="row mt-3">
              <div class="col-sm-10">
                <label for="exampleFormControlTextarea1"
                  class="form-label mt-2 d-flex justify-content-start">Description du produit :</label>
                <textarea class="form-control2" id="yourDescription" name="yourDescription" rows="5" maxlength="170"><?=$articleDescription?></textarea> 
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
              <button type="submit" class="btn btnConnect mt-5 mb-3" id="validPublication" name="validPublication">Valider ma modification</button>
            </div>
          </div>
        </div>
        </form>
      </div>


      <?php }
      
    
    }?>
    
    <script type="text/javascript" src="/assets/js/scriptPubli.js"></script>
    
    <?php } require 'views/footer.php'; ?>

    <script type="text/javascript" src="/assets/js/scriptPubli.js"></script>

    </div>


    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>

</body>

</html>