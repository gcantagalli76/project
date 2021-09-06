<?php

require './models/user.php';
require './models/article.php';

$userObj = new User();
$articleObj = new Article();
$deleteSuccess = 0;

// si il n'y a pas de session d'ouverte tu peux ouvrir une session
if (!isset($_SESSION)) {
  session_start();
}

/////////////////////////////////////////////////////////////////////////////USER//////////////////////////////////////////////////////////////////////

// en cliquant sur le bouton qui valide l'ajout d'un compte, tu lances la fonction qui ajoute un utilisateur et tu enregistres son email en session puis tu renvois sur la page moncompte.php
if (isset($_POST['myButton']) && $userObj->displayEmail($_POST['yourEmail'])) {
  var_dump('Adresse email déjà utilisée');
} elseif (isset($_POST['myButton'])) {
  $addUserArray = $userObj->addUser();
  $_SESSION['email'] = $_POST["yourEmail"];
}

// si tu clics sur le bouton deconnecter cela supprimera la session et te renverra sur la page d'accueuil
if (isset($_POST['disconnect'])) {
  session_destroy();
  header("location: index.php");
}

// si tu as une session en cours avec un email alors tu peux afficher les données de l'utilisateur sur son compte et créer une session avec son id
if (isset($_SESSION['email'])) {
  $displayUserArray = $userObj->displayUser($_SESSION['email']);
}

// Si tu clics dans mon compte et que tu as une sessions email d'enregistrer alors tu rentres direct sur ton compte
// Sinon si tu clic sur le bouton connection on vérifie que ton mail et mdp est bien egal à ce qu'il y a en bdd on t'envoi sur ton compte et on enregistre un cookie email pour ne pas te reconnecter à chaque fois
// Sinon on affiche un message d'erreur pour indiquer que le mdp ou l'email n'est pas valide
if (isset($_SESSION['email']) && isset($_SESSION['userId']) && isset($_POST['myAcount'])) {
  header("Location: moncompte.php");
} else {
  if (isset($_POST['connectButton'])) {
    $connectionUserArray = $userObj->connectionUser();
    if ($_POST['yourEmail'] == $connectionUserArray['USER_EMAIL'] && $_POST['yourPassword'] == $connectionUserArray['USER_PASSWORD']) {
      header("Location: moncompte.php");
      $_SESSION['email'] = $_POST["yourEmail"];
      $_SESSION['userId'] = $connectionUserArray['USER_ID'];
    } else {
      $errorConnect = 'Adresse email ou mot de passe invalide';
    }
  }
}

/////////////////////////////////////////////////////////////////////////////ARTICLE//////////////////////////////////////////////////////////////////////

// si il n'y a pas d'email dans la session alors tu renvois l'utilisateur direct sur la page connectpourpubli sinon tu lances le reste
if (!isset($_SESSION['email']) && isset($_POST['newPublication'])) {
  header("Location: connectforpublication.php");
} else {
  // si il valide la publication alors tu récupère les différents post et photos et lance la fonction pour rajouter l'article dans la bdd
  if (isset($_POST['validPublication'])) {

    //changement de l'image1 au format base64 pour import dans la bdd
    $img_file = $_FILES['fileToUpload']['tmp_name'];
    $type = pathinfo($img_file, PATHINFO_EXTENSION);
    // Load file contents into variable
    $bin = file_get_contents($img_file);
    // Encode contents to Base64
    $picture1 = base64_encode($bin);

    //changement de l'image2 au format base64 pour import dans la bdd
    $img_file2 = $_FILES['fileToUpload2']['tmp_name'];
    $type2 = pathinfo($img_file2, PATHINFO_EXTENSION);
    // Load file contents into variable
    $bin2 = file_get_contents($img_file2);
    // Encode contents to Base64
    $picture2 = base64_encode($bin2);

    //changement de l'image3 au format base64 pour import dans la bdd
    $img_file3 = $_FILES['fileToUpload3']['tmp_name'];
    $type3 = pathinfo($img_file3, PATHINFO_EXTENSION);
    // Load file contents into variable
    $bin3 = file_get_contents($img_file3);
    // Encode contents to Base64
    $picture3 = base64_encode($bin3);

    $articleObj->addArticle($picture1, $picture2, $picture3);
  }
}

// si il n'y a pas d'email dans la session alors tu renvois l'utilisateur direct sur la page de connection sinon tu lances le reste
if (!isset($_SESSION['email']) && isset($_POST['myPublications'])) {
  header("Location: connection.php");
} else if (isset($_SESSION['email'])) {
  // tu lances la fonction permettant d'afficher les produits liés à l'utilisateur connecté
  $displayUserArticleArray = $articleObj->articleUser();
}

// nous mettons la fonction dans une variable pour ensuite afficher les 5 derniers articles sur la page d'accueil
$display5ArticleArray = $articleObj->display5Article();

// lors du clic sur le bouton modifier la publication nous renvoyer sur la page publicationmodify avec les infos concernant le produit à modifier
if (isset($_POST['idArticleModify'])) {
  $displayArticleToModifArray = $articleObj->displayArticleB4Modif();
}

// lors du clic pour valider la modif tu lances la fonction qui modifie en base les données de l'article concerné et tu affiche de nouveau l'article
if (isset($_POST['validModification'])) {

  //changement de l'image1 au format base64 pour import dans la bdd
  // $img_file = $_FILES['fileToUpload']['tmp_name'];
  // $type = pathinfo($img_file, PATHINFO_EXTENSION);
  // // Load file contents into variable
  // $bin = file_get_contents($img_file);
  // // Encode contents to Base64
  // $picture1 = base64_encode($bin);

  // //changement de l'image2 au format base64 pour import dans la bdd
  // $img_file2 = $_FILES['fileToUpload2']['tmp_name'];
  // $type2 = pathinfo($img_file2, PATHINFO_EXTENSION);
  // // Load file contents into variable
  // $bin2 = file_get_contents($img_file2);
  // // Encode contents to Base64
  // $picture2 = base64_encode($bin2);

  // //changement de l'image3 au format base64 pour import dans la bdd
  // $img_file3 = $_FILES['fileToUpload3']['tmp_name'];
  // $type3 = pathinfo($img_file3, PATHINFO_EXTENSION);
  // // Load file contents into variable
  // $bin3 = file_get_contents($img_file3);
  // // Encode contents to Base64
  // $picture3 = base64_encode($bin3);

  $articleObj->modifyArticle();
  $displayArticleToModifArray = $articleObj->displayArticleB4Modif();
}

// lors du clic pour supprimer un article tu lances la fonction qui supprime en base les données de l'article concerné
if (isset($_POST['idArticleDelete'])) {

  $articleObj->deleteArticle();
  $displayUserArticleArray = $articleObj->articleUser();
  $deleteSuccess = true;
}

// lors du clic sur les catégories tu affiches les articles sur la catégories concernée
if (isset($_POST['selectCategory'])) {
  $displayCategoryArticleArray = $articleObj->displayArticleCategory();
}

// Si dans la catégorie selectionné il n'y a aucun article alors tu mets une phrase qui indique que nous n'avons pas d'article sinon tu mets la catégorie
if (!isset($displayCategoryArticleArray[0]['CATEGORY_NAME'])) {
  $categoryTitle = 'Aucun article';
} else {
  $categoryTitle = $displayCategoryArticleArray[0]['CATEGORY_NAME'];
}

// Si tu clics sur un article dans la catégorie ou dans tes favoris alors tu lance la fonction qui affiche les détails de cet article dans annonce.php
if (isset($_POST['idArticleConsult']) || isset($_GET['idarticle'])) {
  $displayDetailsArticleArray = $articleObj->displayArticleDetails();
}

// Si tu clics sur le coeur pour mettre dans les favoris tu lance la fonction qui rajoute l'article dans les favoris de l'utilisateur
if (isset($_GET['idfavorite']) && isset($_SESSION['email'])) {
  $articleObj->addFavouriteArticle();
  $displayCategoryArticleArray = $articleObj->displayArticleCategory();
  $categoryTitle = $displayCategoryArticleArray[0]['CATEGORY_NAME'];
}

// Si dans l'annonce tu clics sur pour mettre dans les favoris tu lance la fonction qui rajoute l'article dans les favoris de l'utilisateur
if (isset($_POST['addFavorite']) && isset($_SESSION['email'])) {
  $articleObj->addFavouriteArticle();
  $displayDetailsArticleArray = $articleObj->displayArticleDetails();
}

// Si tu clics sur mesfavoris alors tu lances la fonction permettant d'afficher les favoris de l'utilisateur connecté
if (isset($_POST['myFavorite']) && isset($_SESSION['email'])) {
  $displayFavoriteArticleArray = $articleObj->displayArticleFavorite();
}

// lors du clic pour supprimer un article dans mesfavoris tu lances la fonction qui supprime en base les données l'article concerné
if (isset($_POST['idArticleFavoriteDelete'])) {
  $articleObj->deleteFavoriteArticle();
  $displayFavoriteArticleArray = $articleObj->displayArticleFavorite();
  $deleteSuccess = true;
}
