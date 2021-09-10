<?php

require './models/user.php';
require './models/article.php';

$userObj = new User();
$articleObj = new Article();
$deleteSuccess = 0;
$swalRedirection = 0;

// si il n'y a pas de session d'ouverte tu peux ouvrir une session
if (!isset($_SESSION)) {
  session_start();
}

//regex User

$error = 0;
$regexName = "/^([a-zA-Z ]+)$/";
$regexEmail = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
$regexCity = "/^([a-zA-Z ]+)$/";
$regexPostal = "/^[0-9]{1,10}$/";
$regexPassword = "/^([a-zA-Z ]+)$/";


if (isset($_POST['myButton'])) {
  if (!preg_match($regexName, $_POST['yourName'])) {
    $error = 1;
  }
  if (!preg_match($regexName, $_POST['yourFirstName'])) {
    $error = 1;
  }
  if (!preg_match($regexEmail, $_POST['yourEmail'])) {
    $error = 1;
  }
  if (!preg_match($regexCity, $_POST['yourCity'])) {
    $error = 1;
  }
  if (!preg_match($regexPostal, $_POST['yourPostalCode'])) {
    $error = 1;
  }
  if (!preg_match($regexPassword, $_POST['yourPassword'])) {
    $error = 1;
  }
  if (!preg_match($regexPassword, $_POST['yourConfirmPassword'])) {
    $error = 1;
  }
}

// Verification que les champs publications sont bien tous remplis que ce soit en publication ou en modification

$emptyPublication = 0;

if (isset($_POST['validPublication']) || isset($_POST['validModification'])) {
  if (empty($_POST['yourTitle']) || strlen($_POST['yourTitle']) > 40) {
    $emptyPublication = 1;
  }
  if (empty($_POST['yourCategory'])) {
    $emptyPublication = 1;
  }
  if (empty($_POST['yourState'])) {
    $emptyPublication = 1;
  }
  if (empty($_POST['yourQuantity'])) {
    $emptyPublication = 1;
  }
  if (empty($_POST['yourBuyDate'])) {
    $emptyPublication = 1;
  }
  if (empty($_POST['yourPrice']) || strlen($_POST['yourPrice']) > 5) {
    $emptyPublication = 1;
  }
  if (empty($_POST['yourDescription']) || strlen($_POST['yourDescription']) > 170) {
    $emptyPublication = 1;
  }
  if (empty($_FILES['fileToUpload'])) {
    $emptyPublication = 1;
  }
  if (empty($_FILES['fileToUpload2'])) {
    $emptyPublication = 1;
  }
  if (empty($_FILES['fileToUpload3'])) {
    $emptyPublication = 1;
  }
}

// Verification que les champs modification de mon compte sont bien tous remplis

$emptyModifUser = 0;

if (isset($_POST['validModify'])) {
  if (empty($_POST['lastName']) || strlen($_POST['lastName']) > 20) {
    $emptyModifUser = 1;
  }
  if (empty($_POST['firstName']) || strlen($_POST['firstName']) > 20) {
    $emptyModifUser = 1;
  }
  if (empty($_POST['mail']) || strlen($_POST['mail']) > 30) {
    $emptyModifUser = 1;
  }
  if (empty($_POST['city']) || strlen($_POST['city']) > 20) {
    $emptyModifUser = 1;
  }
  if (empty($_POST['zipCode']) || strlen($_POST['zipCode']) > 6) {
    $emptyModifUser = 1;
  }
}

// Verification que les champs modification de pwd sont bien tous remplis et respectent les regex et autres contraintes

$emptyModifPwd = 0;

if (isset($_POST['changeMyPwd'])) {
  if (empty($_POST['yourExPassword']) || !preg_match($regexPassword, $_POST['yourExPassword'])) {
    $emptyModifPwd = 1;
  }
  if (empty($_POST['yourNewPassword']) || !preg_match($regexPassword, $_POST['yourNewPassword'])) {
    $emptyModifPwd = 1;
  }
  if (empty($_POST['yourConfirmNewPassword']) || !preg_match($regexPassword, $_POST['yourConfirmNewPassword'])) {
    $emptyModifPwd = 1;
  }
  if ($_POST['yourNewPassword'] != $_POST['yourConfirmNewPassword']) {
    $emptyModifPwd = 1;
  }
}


/////////////////////////////////////////////////////////////////////////////USER//////////////////////////////////////////////////////////////////////

// en cliquant sur le bouton qui valide l'ajout d'un compte, tu lances la fonction qui ajoute un utilisateur et tu enregistres son email en session puis tu renvois sur la page moncompte.php
if (isset($_POST['myButton']) && $userObj->displayEmail($_POST['yourEmail'])) {
  $titleSweet = "Adresse email déjà existante";
  $textSweet = "Cette adresse email existe déjà, veuillez en entrer une autre";
  $iconSweet = "error";
  $redirectionSweet = "creationcpt.php";
} else if (isset($_POST['myButton']) && $error == 0 && $_POST['yourPassword'] == $_POST['yourConfirmPassword']) {
  $yourPassword = password_hash($_POST['yourPassword'], PASSWORD_DEFAULT);
  $addUserArray = $userObj->addUser($yourPassword);
  $_SESSION['email'] = $_POST["yourEmail"];
  $titleSweet = "Demande validée !";
  $textSweet = "Votre compte a bien été créé";
  $iconSweet = "success";
  $redirectionSweet = "connection.php";
}

// si tu clics sur le bouton deconnecter cela supprimera la session
if (isset($_POST['disconnect'])) {
  session_destroy();
}

// si tu as une session en cours avec un email alors tu peux afficher les données de l'utilisateur sur son compte et créer une session avec son id
if (isset($_SESSION['email'])) {
  $displayUserArray = $userObj->displayUser($_SESSION['email']);
}

// Si tu clics dans mon compte et que tu as une sessions email d'enregistrer alors tu rentres direct sur ton compte
// Sinon si tu clic sur le bouton connection on vérifie que ton mail et mdp est bien egal à ce qu'il y a en bdd on t'envoi sur ton compte et on enregistre une session email pour ne pas te reconnecter à chaque fois
// Sinon on affiche un message d'erreur pour indiquer que le mdp ou l'email n'est pas valide
if (isset($_SESSION['email']) && isset($_SESSION['userId']) && isset($_POST['myAcount'])) {
  header("Location: moncompte.php");
} else {
  if (isset($_POST['connectButton'])) {
    $connectionUserArray = $userObj->connectionUser();
    if ($_POST['yourEmail'] == $connectionUserArray['USER_EMAIL'] && password_verify($_POST["yourPassword"], $connectionUserArray['USER_PASSWORD'])) {
      header("Location: moncompte.php");
      $_SESSION['email'] = $_POST["yourEmail"];
      $_SESSION['userId'] = $connectionUserArray['USER_ID'];
    } else {
      $errorConnect = 'Adresse email ou mot de passe invalide';
    }
  }
}

// Quand tu clics sur modifier les données du profil du user tu changes le bouton en valider les modif et tu ouvres les input pour que l'utilisateur puisse rentrer
// des nouvelles données
if (isset($_POST['modifyButton'])) {
  $disabled = '';
  $textButton = 'Valider la modification';
  $nameButton = 'validModify';
  $colorButton = 'btn-success';
  $displayUserArray = $userObj->displayUser($_SESSION['email']);
} else {
  $disabled = 'disabled';
  $textButton = 'Modifier mes données personnelles';
  $nameButton = 'modifyButton';
  $colorButton = 'btn-primary';
}

// quand il clic sur la validation des modifs tu lances la fonction qui change les données utilisateurs avec les infos remplis dans les input et tu affiches une sweet de confirmation
if (isset($_POST['validModify']) && $emptyModifUser == 0) {
  $userObj->modifyUser();
  $displayUserArray = $userObj->displayUser($_SESSION['email']);
  $titleSweet = "Données modifiées !";
  $textSweet = "Vos données personnelles ont bien été modifiées";
  $iconSweet = "success";
} elseif (isset($_POST['validModify']) && $emptyModifUser > 0) {
  $titleSweet = "Données incomplètes !";
  $textSweet = "Veuillez remplir tous les champs";
  $iconSweet = "error";
}

// au clic sur mes publications tu renvois sur la pages mes publications
if (isset($_POST['myPublications'])) {
  header("Location: mespublications.php");
}

// au clic sur mes favoris tu renvois sur la pages mes favoris
if (isset($_POST['myFavorite']) && isset($_SESSION['userId'])) {
  header("Location: favoris.php");
}elseif (isset($_POST['myFavorite']) && !isset($_SESSION['userId'])) {
  $_SESSION['connectFor'] = 'pour consulter vos favoris';
  header("Location: connectfor.php");
}

// au clic sur changer mon mot de passe tu renvois sur la pages changemypwd
if (isset($_POST['changePwd'])) {
  header("Location: changemypwd.php");
}

// Si tu clic sur changer mon mot de passe et si ton ex mot de pass correspond bien à ce que nous avons en bdd
// alors tu lances la fonction qui prend ton new mdp et le change en bdd
if (isset($_POST['changeMyPwd']) && $emptyModifPwd == 0) {
  $verifyPwdUser = $userObj->verifyPwd();
  if (password_verify($_POST["yourExPassword"], $verifyPwdUser['USER_PASSWORD'])) {
    $titleSweet = "Mot de passe modifié !";
    $textSweet = "Votre mot de passe a bien été modifié, veuillez vous reconnecter";
    $iconSweet = "success";
    $redirectionSweet = 'connection.php';
    $userObj->changeMyPwd();
    session_destroy();
  } else {
    $titleSweet = "Ancien mot de passe invalide !";
    $textSweet = "L'ancien mot de passe que vous avez rentré n'est pas le bon";
    $iconSweet = "error";
    $redirectionSweet = 'changemypwd.php';
  }
}

// au clic sur le bouton pour supprimer le compte utilisateur tu lances la fonction qui supprime le compte
if (isset($_POST['deleteUser'])) {
  $userObj->deleteUser();
  session_destroy();
}


/////////////////////////////////////////////////////////////////////////////ARTICLE//////////////////////////////////////////////////////////////////////

// si il n'y a pas d'email dans la session alors tu renvois l'utilisateur direct sur la page connectpourpubli sinon tu lances le reste
if ((!isset($_SESSION['userId'])) && isset($_POST['newPublication'])) {
  $_SESSION['connectFor'] = 'pour publier une annonce';
  header("Location: connectfor.php");
} else {
  // si il valide la publication alors tu récupère les différents post et photos et lance la fonction pour rajouter l'article dans la bdd
  if (isset($_POST['validPublication']) && $emptyPublication == 0) {

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
} else if (isset($_SESSION['email']) && isset($_SESSION['userId'])) {
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
if (isset($_POST['validModification']) && $emptyPublication == 0) {

  if (empty($_FILES['fileToUpload']['tmp_name'])) {
    $picture1 = $displayArticleToModifArray[0]['picture1'];
  } else if (!empty($_FILES['fileToUpload']['tmp_name'])) {
    //changement de l'image1 au format base64 pour import dans la bdd
    $img_file = $_FILES['fileToUpload']['tmp_name'];
    $type = pathinfo($img_file, PATHINFO_EXTENSION);
    // Load file contents into variable
    $bin = file_get_contents($img_file);
    // Encode contents to Base64
    $picture1 = base64_encode($bin);
  }
  if (empty($_FILES['fileToUpload2']['tmp_name'])) {
    $picture2 = $displayArticleToModifArray[0]['picture2'];
  } else if (!empty($_FILES['fileToUpload2']['tmp_name'])) {
    //changement de l'image2 au format base64 pour import dans la bdd
    $img_file2 = $_FILES['fileToUpload2']['tmp_name'];
    $type2 = pathinfo($img_file2, PATHINFO_EXTENSION);
    // Load file contents into variable
    $bin2 = file_get_contents($img_file2);
    // Encode contents to Base64
    $picture2 = base64_encode($bin2);
  }
  if (empty($_FILES['fileToUpload3']['tmp_name'])) {
    $picture3 = $displayArticleToModifArray[0]['picture3'];
  } else if (!empty($_FILES['fileToUpload3']['tmp_name'])) {
    //changement de l'image3 au format base64 pour import dans la bdd
    $img_file3 = $_FILES['fileToUpload3']['tmp_name'];
    $type3 = pathinfo($img_file3, PATHINFO_EXTENSION);
    // Load file contents into variable
    $bin3 = file_get_contents($img_file3);
    // Encode contents to Base64
    $picture3 = base64_encode($bin3);
  }
  $titleSweet = "Annonce modifiée !";
  $textSweet = "Votre annonce a bien été modifiée";
  $iconSweet = "success";
  $swalRedirection = true;
  $articleObj->modifyArticle($picture1, $picture2, $picture3);
  $displayArticleToModifArray = $articleObj->displayArticleB4Modif();
} elseif (isset($_POST['validModification']) && $emptyPublication > 0) {
  $titleSweet = "Annonce erronée !";
  $textSweet = "Veuillez remplir tous les champs ou toutes les photos";
  $iconSweet = "error";
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
if (isset($_GET['idArticleConsult']) || isset($_GET['idarticle'])) {
  $displayDetailsArticleArray = $articleObj->displayArticleDetails();
}

// Si tu clics sur le coeur pour mettre dans les favoris tu lances la fonction qui rajoute l'article dans les favoris de l'utilisateur
if (isset($_GET['idfavorite']) && isset($_SESSION['email'])) {
  $displayCategoryArticleArray = $articleObj->displayArticleCategory();
  if ($articleObj->verifyArticleFavorite($_SESSION['userId'], $_GET['idfavorite'])) {
    $titleSweet = "Annonce déjà enregistrée";
    $textSweet = "Cette annonce est déjà existante dans vos favoris";
    $iconSweet = "error";
  } else {
    $articleObj->addFavouriteArticle();
    $displayCategoryArticleArray = $articleObj->displayArticleCategory();
    $categoryTitle = $displayCategoryArticleArray[0]['CATEGORY_NAME'];
    $titleSweet = "Annonce ajoutée à vos favoris !";
    $textSweet = "Votre annonce a bien été rajoutée dans vos annonces favorites";
    $iconSweet = "success";
  }
}

// Si dans l'annonce tu clics sur pour mettre dans les favoris tu lance la fonction qui rajoute l'article dans les favoris de l'utilisateur

if (isset($_POST['addFavorite']) && isset($_SESSION['email'])) {
  $displayFavoriteArticleArray = $articleObj->displayArticleFavorite();
  if ($articleObj->verifyArticleFavorite($_SESSION['userId'], $_POST['addFavorite'])) {
    $titleSweet = "Annonce déjà enregistrée";
    $textSweet = "Cette annonce est déjà existante dans vos favoris";
    $iconSweet = "error";
  } else {
    $articleObj->addFavouriteArticle();
    $displayDetailsArticleArray = $articleObj->displayArticleDetails();
    $titleSweet = "Annonce ajoutée à vos favoris !";
    $textSweet = "Votre annonce a bien été rajoutée dans vos annonces favorites";
    $iconSweet = "success";
  }
}

// Si tu clics sur mesfavoris alors tu lances la fonction permettant d'afficher les favoris de l'utilisateur connecté
if (isset($_SESSION['email']) && isset($_SESSION['userId'])) {
  $displayFavoriteArticleArray = $articleObj->displayArticleFavorite();
}

// lors du clic pour supprimer un article dans mesfavoris tu lances la fonction qui supprime en base les données l'article concerné
if (isset($_POST['idArticleFavoriteDelete'])) {
  $articleObj->deleteFavoriteArticle();
  $displayFavoriteArticleArray = $articleObj->displayArticleFavorite();
  $deleteSuccess = true;
}
