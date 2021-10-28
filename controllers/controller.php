<?php

require './models/user.php';
require './models/article.php';

$userObj = new User();
$articleObj = new Article();
$deleteSuccess = 0;
$swalRedirection = 0;


/**
 * if there is no session open, you can open a session
 */
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
 * If we have not the good format in the form we add 1 in the error array
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


/**
 * Scaptcha Security
 */

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

/**
 * On the publication we verify if all fields are filled and with the good format (also for the modification)
 */

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


/**
 * verify if all fields are filled when we modify count information
 */

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


/**
 * verify if all fields are filled and whith the good format when we change pwd
 */

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


/**
 * On click to disconnect we kill the session
 */
if (isset($_POST['disconnect'])) {
  session_destroy();
}


/**
 * if we have a session with an email, we launch the function who display information about the user
 */
if (isset($_SESSION['email'])) {
  $displayUserArray = $userObj->displayUser(htmlspecialchars($_SESSION['email']));
}


/**
 * if you have a session email you go directy on user count
 * else if you click on connectbuton whe verify if your email and password are ok and we open a session
 * else we diplay an error message to indicate the email or password are not valid
 */
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

/**
 * On click on mypublication you go in my publication
 */
if (isset($_POST['myPublications'])) {
  header("Location: mespublications.php");
}

/**
 * On click on publiToValid you go to publication to valid by admin
 */
if (isset($_POST['publiToValid'])) {
  header("Location: publitovalid.php");
}

/**
 * On click on changeYourInformation you go to myprofils.php
 */
if (isset($_POST['changeYourInformation'])) {
  header("Location: myprofil.php");
}

/**
 * On click on userGestion you go to usergestion.php
 */
if (isset($_POST['userGestion'])) {
  header("Location: usergestion.php");
  $displayAllUser = $userObj->displayUser();
}

/**
 * If your sessionid is 1 you can see all user from database
 */
if (isset($_SESSION['statusId']) && $_SESSION['statusId'] == 1) {
  $displayAllUser = $userObj->displayUser();
}


/**
 * On click on validChangeStatut you lauch function who change the user status and display all users
 */
if (isset($_POST['validChangeStatut'])) {
  $userObj->modifyUserStatut();
  $displayAllUser = $userObj->displayUser();
}

/**
 * on click on myFavorite and whith a session id opened, you go to favoris.php
 * else you go to connectfor.php
 */
if (isset($_POST['myFavorite']) && isset($_SESSION['userId'])) {
  header("Location: favoris.php");
} elseif (isset($_POST['myFavorite']) && !isset($_SESSION['userId'])) {
  $_SESSION['connectFor'] = 'pour consulter vos favoris';
  header("Location: connectfor.php");
}

/**
 * On click on changePwd you go to changemypwd.php
 */
if (isset($_POST['changePwd'])) {
  header("Location: changemypwd.php");
}


/**
 * On click on myMessages you go to messages.php
 */
if (isset($_POST['myMessages'])) {
  header("Location: messages.php");
}


/**
 * If you click to change your pwd and if your ex pwd is the same whith what we have in database, we launch function who take the new pwd and to change him in database
 */
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

/**
 * When you click on idUserDelete we launch function who delete the user concerned
 */
if (isset($_POST['idUserDelete'])) {
  $userObj->deleteUserByAdmin();
  $displayAllUser = $userObj->displayUser();
  $deleteSuccess = true;
}

/**
 * if you click to send a message but you are not connected, we transfer you on connectfor.php
 */
if (isset($_POST['sendMessage']) && !isset($_SESSION['userId'])) {
  $_SESSION['connectFor'] = 'pour contacter un vendeur';
  header("Location: connectfor.php");
}

/////////////////////////////////////////////////////////////////////////////ARTICLE//////////////////////////////////////////////////////////////////////

// si il n'y a pas d'email dans la session alors tu renvois l'utilisateur direct sur la page connectpourpubli sinon tu lances le reste
/**
 * if we have not a session opened and you click on newPublication we transfer the user to connectfor.php
 */
if ((!isset($_SESSION['userId'])) && isset($_POST['newPublication'])) {
  $_SESSION['connectFor'] = 'pour publier une annonce';
  header("Location: connectfor.php");
} else {
  /**
   * if you click on validPublication and there is no error, we launch function to add all informations in database and to convert photos in base64
   */
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

/**
 * If we dont have an email session and you click on myPublications we transfer the user to connection.php, else you launch the function to display user's article
 */
if (!isset($_SESSION['email']) && isset($_POST['myPublications'])) {
  header("Location: connection.php");
} else if (isset($_SESSION['email']) && isset($_SESSION['userId'])) {
  $displayUserArticleArray = $articleObj->articleUser();
}


/**
 * If we dont have an email session and you click on publiToValid we transfer the user to connection.php, else you launch the function to display article to validate
 */
if (!isset($_SESSION['email']) && isset($_POST['publiToValid'])) {
  header("Location: connection.php");
} else if (isset($_SESSION['email']) && isset($_SESSION['userId'])) {
  $displayAdminArticleArray = $articleObj->displayArticleToValid();
}

/**
 * Function to display the last 5 article
 */
$display5ArticleArray = $articleObj->display5Article();


/**
 * If you click on idArticleModify we launch function to display the artile to modify before modification
 */
if (isset($_POST['idArticleModify'])) {
  $displayArticleToModifArray = $articleObj->displayArticleB4Modif();
}


/**
 * If you click on validModification and if we dont have any error we launch function to modify the article
 */
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


/**
 * If you click on idArticleDelete we launch function to delete the artile 
 */
if (isset($_POST['idArticleDelete'])) {
  $articleObj->deleteArticle();
  $displayUserArticleArray = $articleObj->articleUser();
  $deleteSuccess = true;
}


/**
 * If you click on selectCategory we launch function to display the category concerned 
 */
if (isset($_POST['selectCategory'])) {
  $displayCategoryArticleArray = $articleObj->displayArticleCategory();
}

/**
 * if we don't have any article in the selected category, we indicate we have nothing else we diplay the category name
 */
if (!isset($displayCategoryArticleArray[0]['CATEGORY_NAME'])) {
  $categoryTitle = 'Aucun article dans cette catégorie pour le moment';
} else {
  $categoryTitle = $displayCategoryArticleArray[0]['CATEGORY_NAME'];
}


/**
 * If you click on idArticleConsult or idarticle, we launch function to display details about this article on annonce.php
 */
if (isset($_GET['idArticleConsult']) || isset($_GET['idarticle'])) {
  $displayDetailsArticleArray = $articleObj->displayArticleDetails();
}


/**
 * If you click on idfavorite to add an article in favorite, we launch function to add this article in the favorite article of the connected user
 */
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

/**
 * If you click on idfavorite to add an article in favorite, we launch function to add this article in the favorite article of the connected user
 */
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

/**
 * if you have a session email and a session userid we launch function who display the favorite article of the user connected
 */
if (isset($_SESSION['email']) && isset($_SESSION['userId'])) {
  $displayFavoriteArticleArray = $articleObj->displayArticleFavorite();
}


/**
 * When you click to delete an article in favorite, we launch function who delete the article of the user connected
 */
if (isset($_POST['idArticleFavoriteDelete'])) {
  $articleObj->deleteFavoriteArticle();
  $displayFavoriteArticleArray = $articleObj->displayArticleFavorite();
  $deleteSuccess = true;
}

/**
 * When you click to validate an article, we launch function who valid the article in database
 */
if (isset($_POST['validArticleBtn'])) {
  $articleObj->validArticle();
}

/**
 * When you click to send a message, we launch function who send a message
 */
if (isset($_POST['sendMessage'])) {
  $articleObj->sendMessage();
  $displayDetailsArticleArray = $articleObj->displayArticleDetails();
}

/**
 * When you click to send a message from favorite article, we launch function who send a message
 */
if (isset($_POST['sendMessageInFavorite'])) {
  $articleObj->sendMessage();
  $displayDetailsArticleArray = $articleObj->displayArticleFavorite();
}

/**
 * if you have a session email and a session userid we launch function who display the message of the user connected
 */
if (isset($_SESSION['email']) && isset($_SESSION['userId'])) {
  $displayUserMessages = $articleObj->displayUserMessages();
}

/**
 * When you click to delete a message from favorite article, we launch function who delete a message
 */
if (isset($_POST['messageDelete'])) {
  $articleObj->deleteUserMessages();
  $displayUserMessages = $articleObj->displayUserMessages();
  $deleteSuccess = true;
}
