<?php

require './models/user.php';
require './models/article.php';

$userObj = new User();
$articleObj = new Article();


//User

// en cliquant sur le bouton qui valide l'ajout d'un compte, tu lances la fonction qui ajoute un utilisateur et tu enregistres son email en cookie puis tu renvois sur la page moncompte.php
if (isset($_POST['myButton'])) {
$addUserArray = $userObj->addUser();
setcookie("email", $_POST["yourEmail"], time() + (60 * 60 * 24));
header("Location: moncompte.php");
}

// si tu clics sur le bouton deconnecter cela supprimera les cookies et te renverra sur la page d'accueuil
if (isset($_POST['disconnect'])) {
    setcookie('email');
      unset($_COOKIE['email']);
    header("location: index.php");
  }


  if (isset($_COOKIE['email'])) {
    $displayUserArray = $userObj->displayUser($_COOKIE['email']);
  }
  

// Si tu clics dans mon compte et que tu as un cookie email d'enregistrer alors tu rentres direct sur ton compte
// Sinon si tu clic sur le bouton connection on vérifie que ton mail et mdp est bien egal à ce qu'il y a en bdd on t'envoi sur ton compte et on enregistre un cookie email pour ne pas te reconnecter à chaque fois
// Sinon on affiche un message d'erreur pour indiquer que le mdp ou l'email n'est pas valide
if (isset($_COOKIE['email']) && isset($_POST['myAcount'])) {
    header("Location: moncompte.php");
  }else {
  if (isset($_POST['connectButton'])) {
    $connectionUserArray = $userObj->connectionUser();
    if ($_POST['yourEmail'] == $connectionUserArray['USER_EMAIL'] && $_POST['yourPassword'] == $connectionUserArray['USER_PASSWORD']) {
        header("Location: moncompte.php");
        setcookie('email', $_POST["yourEmail"], time() + (60 * 60 * 24));
        setcookie('userId', $connectionUserArray['USER_ID'], time() + (60 * 60 * 24));
      }else {
        $errorConnect = 'Adresse email ou mot de passe invalide';
      }
}
  }







//Article

// si il n'y a pas d'email dans les cookies alors tu renvois l'utilisateur direct sur la page connectpourpubli sinon tu lances le reste
if (!isset($_COOKIE['email']) && isset($_POST['newPublication'])) {
  header("Location: connectforpublication.php");
}else {
// si il valide la publication alors tu récupère les différents post et les mets dans des variables
  if (isset($_POST['validPublication'])) {
    $articleObj->addArticle();
  }
}


// si il n'y a pas d'email dans les cookies alors tu renvois l'utilisateur direct sur la page de connection sinon tu lances le reste
if (!isset($_COOKIE['email']) && isset($_POST['myPublications'])) {
  header("Location: connection.php");
}else {
// tu lances la fonction permettant d'afficher les produits liés à l'utilisateur connecté
$displayUserArticleArray = $articleObj->articleUser();
}












// if(isset($_POST['detail'])){
//     $detailsPatientsArray = $patientsObj->detailPatients($_POST['detail']);
// }

// if (isset($_POST['modifyButton'])) {
//     $disabled = '';
//     $textButton = 'Valider la modification';
//     $nameButton = 'validModify';
//     $colorButton = 'success';
//     $detailsPatientsArray = $patientsObj->detailPatients($_POST['detail']);
// }else {
//     $disabled = 'disabled';
//     $textButton = 'Modifier les données';
//     $nameButton = 'modifyButton';
//     $colorButton = 'primary';
// }

// if(isset($_POST['validModify'])){
//     $patientsObj->modifyPatients();
//     $detailsPatientsArray = $patientsObj->detailPatients($_POST['detail']);
// }


// //Appointments

// if(isset($_POST['validAppointment'])){
// $addAppointmentsArray = $AppointmentsObj->addAppointments();
// $confirmModalApp = 'myModalApp.show()';
// }else {
//     $confirmModalApp = '';
// }


// $displayAppointmentsArray = $AppointmentsObj->displayAppointments();


// if(isset($_POST['detailApp'])){
//     $detailAppointmentsArray = $AppointmentsObj->detailAppointments($_POST['detailApp']);
// }

// if (isset($_POST['modifyAppButton'])) {
//     $disabled = '';
//     $textButton = 'Valider la modification';
//     $nameButton = 'validModifyApp';
//     $colorButton = 'success';
//     $detailAppointmentsArray = $AppointmentsObj->detailAppointments($_POST['detailApp']);
// }else {
//     $disabled = 'disabled';
//     $textButton = 'Modifier les données';
//     $nameButton = 'modifyAppButton';
//     $colorButton = 'primary';
// }

// if(isset($_POST['validModifyApp'])){
//     $AppointmentsObj->modifyAppointments();
//     $detailAppointmentsArray = $AppointmentsObj->detailAppointments($_POST['detailApp']);
//     $confirmModal = 'myModal.show()';
// }else {
//     $confirmModal = '';
// }


?>

