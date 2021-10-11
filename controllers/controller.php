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
$regexName = "/^([a-zA-Zéèàê ]+)$/";
$regexEmail = "/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/";
$regexCity = "/^([a-zA-Zéèàê ]+)$/";
$regexPostal = "/^[0-9]{1,10}$/";
$regexPassword = "/^(?=.*?[A-Z])(?=.*?[a-z]).{5,}$/";

/**
 * If we have not the good format we add 1 in the error array
 *
 */
if (isset($_POST['myButton'])) {
  $yourName = htmlspecialchars($_POST['yourName']);
  $yourFirstName = htmlspecialchars($_POST['yourFirstName']);
  $yourEmail = htmlspecialchars($_POST['yourEmail']);
  $yourCity = htmlspecialchars($_POST['yourCity']);
  $yourPostalCode = htmlspecialchars($_POST['yourPostalCode']);
  $yourPassword = htmlspecialchars($_POST['yourPassword']);
  $yourConfirmPassword = htmlspecialchars($_POST['yourConfirmPassword']);
  if (!preg_match($regexName, $yourName)) {
    $error = 1;
  }
  if (!preg_match($regexName, $yourFirstName)) {
    $error = 1;
  }
  if (!preg_match($regexEmail, $yourEmail)) {
    $error = 1;
  }
  if (!preg_match($regexCity, $yourCity)) {
    $error = 1;
  }
  if (!preg_match($regexPostal, $yourPostalCode)) {
    $error = 1;
  }
  if (!preg_match($regexPassword, $yourPassword)) {
    $error = 1;
  }
  if (!preg_match($regexPassword, $yourConfirmPassword)) {
    $error = 1;
  }
}

//Sécurité scaptcha

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['recaptcha_response'])) {

  $recaptcha_url = 'https://www.google.com/recaptcha/api/siteverify';
  $recaptcha_secret = '6LdWb3wcAAAAABa5myVJze51bGXtk0basocwQcCg';
  $recaptcha_response = $_POST['recaptcha_response'];

  $recaptcha = file_get_contents($recaptcha_url . '?secret=' . $recaptcha_secret . '&response=' . $recaptcha_response);
  $recaptcha = json_decode($recaptcha);

  if ($recaptcha->score < 0.5) {
    $error = 1;
    $titleSweet = "Vous êtes un robot";
    $textSweet = "Sortez d'ici !";
    $iconSweet = "error";
    $redirectionSweet = "index.php";
  }
}

// Verification que les champs publications sont bien tous remplis que ce soit en publication ou en modification

$emptyPublication = 0;
$regexPrice = "/^[0-9]{1,10}$/";


if (isset($_POST['validPublication']) || isset($_POST['validModification'])) {
  $yourTitle = htmlspecialchars($_POST['yourTitle']);
  $yourPrice = htmlspecialchars($_POST['yourPrice']);
  $yourDescription = htmlspecialchars($_POST['yourDescription']);
  if (empty($yourTitle) || strlen($yourTitle) > 40) {
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
  if (empty($yourPrice) || strlen($yourPrice) > 5 || !preg_match($regexPrice, $yourPrice)) {
    $emptyPublication = 1;
  }
  if (empty($yourDescription) || strlen($yourDescription) >= 180) {
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
  $lastName = htmlspecialchars($_POST['lastName']);
  $firstName = htmlspecialchars($_POST['firstName']);
  $mail = htmlspecialchars($_POST['mail']);
  $city = htmlspecialchars($_POST['city']);
  $zipCode = htmlspecialchars($_POST['zipCode']);
  if (empty($lastName) || strlen($lastName) > 20 || !preg_match($regexName, $lastName)) {
    $emptyModifUser = 1;
  }
  if (empty($firstName) || strlen($firstName) > 20 || !preg_match($regexName, $firstName)) {
    $emptyModifUser = 1;
  }
  if (empty($mail) || strlen($mail) > 30 || !preg_match($regexEmail, $mail)) {
    $emptyModifUser = 1;
  }
  if (empty($city) || strlen($city) > 20 || !preg_match($regexCity, $city)) {
    $emptyModifUser = 1;
  }
  if (empty($zipCode) || strlen($zipCode) > 6 || !preg_match($regexPostal, $zipCode)) {
    $emptyModifUser = 1;
  }
}

// Verification que les champs modification de pwd sont bien tous remplis et respectent les regex et autres contraintes

$emptyModifPwd = 0;

if (isset($_POST['changeMyPwd'])) {
  $yourExPassword = htmlspecialchars($_POST['yourExPassword']);
  $yourNewPassword = htmlspecialchars($_POST['yourNewPassword']);
  $yourConfirmNewPassword = htmlspecialchars($_POST['yourConfirmNewPassword']);
  if (empty($yourExPassword) || !preg_match($regexPassword, $yourExPassword)) {
    $emptyModifPwd = 1;
  }
  if (empty($yourNewPassword) || !preg_match($regexPassword, $yourNewPassword)) {
    $emptyModifPwd = 1;
  }
  if (empty($yourConfirmNewPassword) || !preg_match($regexPassword, $yourConfirmNewPassword)) {
    $emptyModifPwd = 1;
  }
  if ($yourNewPassword != $yourConfirmNewPassword) {
    $emptyModifPwd = 1;
  }
}


/////////////////////////////////////////////////////////////////////////////USER//////////////////////////////////////////////////////////////////////

/**
 * On click to validate the new count, we verify if the email adresse do not already exist in the database
 * Else, if the error array is empty, we launch the function who add the new user in database and we confirm this addition whith a sweet alert
 */
if (isset($_POST['myButton']) && $userObj->displayEmail(htmlspecialchars($_POST["yourEmail"]))) {
  $titleSweet = "Adresse email déjà existante";
  $textSweet = "Cette adresse email existe déjà, veuillez en entrer une autre";
  $iconSweet = "error";
  $redirectionSweet = "creationcpt.php";
} else if (isset($_POST['myButton']) && $error == 0 && $_POST['yourPassword'] == $_POST['yourConfirmPassword']) {
  $yourPassword = password_hash($_POST['yourPassword'], PASSWORD_DEFAULT);
  $addUserArray = $userObj->addUser($yourPassword);
  $_SESSION['email'] = htmlspecialchars($_POST["yourEmail"]);
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
  $displayUserArray = $userObj->displayUser(htmlspecialchars($_SESSION['email']));
}

// Si tu clics dans mon compte et que tu as une sessions email d'enregistrée alors tu rentres direct sur ton compte
// Sinon si tu clic sur le bouton connection on vérifie que ton mail et mdp est bien egal à ce qu'il y a en bdd on t'envoi sur ton compte et on enregistre une session email pour ne pas te reconnecter à chaque fois
// Sinon on affiche un message d'erreur pour indiquer que le mdp ou l'email n'est pas valide
if (isset($_SESSION['email']) && isset($_SESSION['userId']) && $_SESSION['statusId'] == 2 && isset($_POST['myAcount'])) {
  header("Location: moncompte.php");
} elseif (isset($_SESSION['email']) && isset($_SESSION['userId']) && $_SESSION['statusId'] == 1 && isset($_POST['myAcount'])) {
  header("Location: myadmincount.php");
} else {
  if (isset($_POST['connectButton'])) {
    $connectionUserArray = $userObj->connectionUser();
    if ($_POST['yourEmail'] == $connectionUserArray['USER_EMAIL'] && password_verify($_POST["yourPassword"], $connectionUserArray['USER_PASSWORD']) && $connectionUserArray['STATUS_ID'] == 2) {
      header("Location: moncompte.php");
      $_SESSION['email'] = htmlspecialchars($_POST["yourEmail"]);
      $_SESSION['userId'] = $connectionUserArray['USER_ID'];
      $_SESSION['statusId'] = $connectionUserArray['STATUS_ID'];
    } else if ($_POST['yourEmail'] == $connectionUserArray['USER_EMAIL'] && password_verify($_POST["yourPassword"], $connectionUserArray['USER_PASSWORD']) && $connectionUserArray['STATUS_ID'] == 1) {
      header("Location: myadmincount.php");
      $_SESSION['email'] = htmlspecialchars($_POST["yourEmail"]);
      $_SESSION['userId'] = $connectionUserArray['USER_ID'];
      $_SESSION['statusId'] = $connectionUserArray['STATUS_ID'];
    } else {
      $errorConnect = 'Adresse email ou mot de passe invalide';
    }
  }
}

/**
 * On click to validate modification, we launch the function who verify the user password and if the format was respected whith the regex
 * If its ok we launch the function who modify the user's informations and we confirm whith a sweet alert
 * We do a different redirection if the person connected is an admin or just a simple user
 */
if (isset($_POST['validModifyPwd']) && $emptyModifUser == 0) {
  $verifyPwdUser = $userObj->verifyPwd();
  if (password_verify($_POST["password"], $verifyPwdUser['USER_PASSWORD']) && $_SESSION['statusId'] == 2) {
    $userObj->modifyUser();
    $displayUserArray = $userObj->displayUser($_SESSION['email']);
    $titleSweet = "Données modifiées !";
    $textSweet = "Vos données personnelles ont bien été modifiées";
    $iconSweet = "success";
    $redirectionSweet = '.then(function() {
    window.location = "moncompte.php";
});';
  } else if (password_verify($_POST["password"], $verifyPwdUser['USER_PASSWORD']) && $_SESSION['statusId'] == 1) {
    $userObj->modifyUser();
    $displayUserArray = $userObj->displayUser($_SESSION['email']);
    $titleSweet = "Données modifiées !";
    $textSweet = "Vos données personnelles ont bien été modifiées";
    $iconSweet = "success";
    $redirectionSweet = '.then(function() {
    window.location = "myadmincount.php";
});';
  } else {
    $titleSweet = "Mot de passe invalide !";
    $textSweet = "Le mot de passe que vous avez rentré n'est pas le bon";
    $iconSweet = "error";
    $redirectionSweet = '';
  }
}

// au clic sur mes publications tu renvois sur la pages mes publications
if (isset($_POST['myPublications'])) {
  header("Location: mespublications.php");
}

// au clic sur publication à valider tu renvois sur la pages des publications à valider par l'admin
if (isset($_POST['publiToValid'])) {
  header("Location: publitovalid.php");
}

// au clic sur modifier mon profil tu vas sur la page myprofil.php
if (isset($_POST['changeYourInformation'])) {
  header("Location: myprofil.php");
}

// au clic sur gestion de comptes utilisateurs tu vas sur la page usergestion.php
if (isset($_POST['userGestion'])) {
  header("Location: usergestion.php");
  $displayAllUser = $userObj->displayUser();
}

// si tu es l'admin tu peux lancer la fonction permettant d'afficher tous les comptes utilisateurs
if (isset($_SESSION['statusId']) && $_SESSION['statusId'] == 1) {
  $displayAllUser = $userObj->displayUser();
}

// si tu clics sur le bouton valider le changement de statut tu lances la fonction qui change le statut de l'utilisateur et celle qui affiche tous les utilisateurs
if (isset($_POST['validChangeStatut'])) {
  $userObj->modifyUserStatut();
  $displayAllUser = $userObj->displayUser();
}

// au clic sur mes favoris tu renvois sur la pages mes favoris
if (isset($_POST['myFavorite']) && isset($_SESSION['userId'])) {
  header("Location: favoris.php");
} elseif (isset($_POST['myFavorite']) && !isset($_SESSION['userId'])) {
  $_SESSION['connectFor'] = 'pour consulter vos favoris';
  header("Location: connectfor.php");
}

// au clic sur changer mon mot de passe tu renvois sur la pages changemypwd
if (isset($_POST['changePwd'])) {
  header("Location: changemypwd.php");
}

// au clic sur mes messages tu renvois sur la pages messages.php
if (isset($_POST['myMessages'])) {
  header("Location: messages.php");
}

// Si tu clic sur changer mon mot de passe et si ton ex mot de pass correspond bien à ce que nous avons en bdd
// alors tu lances la fonction qui prend ton new mdp et le change en bdd
if (isset($_POST['changeMyPwd']) && $emptyModifPwd == 0) {
  $verifyPwdUser = $userObj->verifyPwd();
  if (password_verify($_POST["yourExPassword"], $verifyPwdUser['USER_PASSWORD']) && $_SESSION['statusId'] == 2) {
    $titleSweet = "Mot de passe modifié !";
    $textSweet = "Votre nouveau mot de passe a bien été pris en compte";
    $iconSweet = "success";
    $redirectionSweet = 'moncompte.php';
    $userObj->changeMyPwd();
    // session_destroy();
  } elseif (password_verify($_POST["yourExPassword"], $verifyPwdUser['USER_PASSWORD']) && $_SESSION['statusId'] == 1) {
    $titleSweet = "Mot de passe modifié !";
    $textSweet = "Votre nouveau mot de passe a bien été pris en compte";
    $iconSweet = "success";
    $redirectionSweet = 'myadmincount.php';
    $userObj->changeMyPwd();
  } else {
    $titleSweet = "Ancien mot de passe invalide !";
    $textSweet = "L'ancien mot de passe que vous avez rentré n'est pas le bon";
    $iconSweet = "error";
    $redirectionSweet = 'changemypwd.php';
  }
}

/**
 * On click to delete the user, we launch the function who verify the user password
 * If its ok we launch the function who delete the user and we confirm whith a sweet alert
 * Else we launch a sweet alert to say the password is not valid
 */
if (isset($_POST['deleteUser'])) {
  $verifyPwdUser = $userObj->verifyPwd();
  if (password_verify($_POST["password"], $verifyPwdUser['USER_PASSWORD'])) {
    $titleSweetDelete = "Suppression de votre compte !";
    $textSweetDelete = "Votre compte utilisateur a bien été supprimé !";
    $iconSweetDelete = "success";
    $redirectionSweetDelete = 'index.php';
    $userObj->deleteUser();
    session_destroy();
  } else {
    $titleSweetDelete = "Mot de passe invalide !";
    $textSweetDelete = "Le mot de passe que vous avez rentré n'est pas le bon";
    $iconSweetDelete = "error";
    $redirectionSweetDelete = 'moncompte.php';
  }
}

// lors du clic pour supprimer un utilisateur depuis le compte admin tu lances la fonction qui supprime en base les données de l'utilisateur pointé
if (isset($_POST['idUserDelete'])) {
  $userObj->deleteUserByAdmin();
  $displayAllUser = $userObj->displayUser();
  $deleteSuccess = true;
}

// si tu clics pour envoyer un message au vendeur mais que tu n'est pas connecté alors on te renvoi sur la page pour te connecter
if (isset($_POST['sendMessage']) && !isset($_SESSION['userId'])) {
  $_SESSION['connectFor'] = 'pour contacter un vendeur';
  header("Location: connectfor.php");
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

// si il n'y a pas d'email dans la session alors tu renvois l'admin direct sur la page de connection sinon tu lances le reste
if (!isset($_SESSION['email']) && isset($_POST['publiToValid'])) {
  header("Location: connection.php");
} else if (isset($_SESSION['email']) && isset($_SESSION['userId'])) {
  // tu lances la fonction permettant d'afficher les produits à valider par l'admin
  $displayAdminArticleArray = $articleObj->displayArticleToValid();
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
  $titleSweet = "Modifications prises en compte !";
  $textSweet = "Votre modification d'annonce a bien été prise en compte, elle est soumise à validation avant son éventuelle publication sous 24h";
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
  $categoryTitle = 'Aucun article dans cette catégorie pour le moment';
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
    $textSweet = "Cette annonce a bien été ajoutée dans vos annonces favorites";
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
    $textSweet = "Cette annonce a bien été ajoutée dans vos annonces favorites";
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

// lors du clic pour valider un article par l'admin, tu lances la fonction qui passe cette article en validé en bdd
if (isset($_POST['validArticleBtn'])) {
  $articleObj->validArticle();
}

// si tu clics sur le bouton valider l'envoi du message au vendeur, tu lances la fonction qui enregistre le message dans la bdd
if (isset($_POST['sendMessage'])) {
  $articleObj->sendMessage();
  $displayDetailsArticleArray = $articleObj->displayArticleDetails();
}

// si tu clics sur le bouton valider l'envoi du message au vendeur depuis tes favoris, tu lances la fonction qui enregistre le message dans la bdd
if (isset($_POST['sendMessageInFavorite'])) {
  $articleObj->sendMessage();
  $displayDetailsArticleArray = $articleObj->displayArticleFavorite();
}

// si tu clics sur le bouton mes messages, tu lances la fonction qui affiche les messages de l'utilisateur connecté
if (isset($_SESSION['email']) && isset($_SESSION['userId'])) {
  $displayUserMessages = $articleObj->displayUserMessages();
}

// si tu clics sur le bouton supprimer un message, tu lances la fonction qui supprimer le message dans la bdd
if (isset($_POST['messageDelete'])) {
  $articleObj->deleteUserMessages();
  $displayUserMessages = $articleObj->displayUserMessages();
  $deleteSuccess = true;
}
