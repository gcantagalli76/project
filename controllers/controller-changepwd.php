<?php

// lance les classes de PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

require './PHPMailer-master/src/Exception.php';
require './PHPMailer-master/src/PHPMailer.php';
require './PHPMailer-master/src/SMTP.php';
require './models/user.php';
$mail = new PHPMailer(True);
$userObj = new User();

//Au clic sur le bouton générer un nouveau mdp,tu lance la fonction qui génère un tolken et qui le met dans la bdd sur l'user ayant demandé si l'adresse email est bien existante en bdd grace à la fonction displayemail
// puis on adresse un email à l'utilisateur lui permettant de se connecter à la page changement de mdp grâce au token
// et on affiche une sweet alerte positive
// sinon on affiche une sweet alert negative indiquant que l'adresse email n'est pas valide
if (isset($_POST['createToken']) && $userObj->displayEmail($_POST['yourEmail'])) {

  //etape 1
  $myToken = md5(uniqid());

  // etape 2
  // methode pour le rajouter 
  $userObj->addToken($myToken);

  // envoi de l'email
  $mail->isSMTP(); // Paramétrer le Mailer pour utiliser SMTP 
  $mail->Host = 'smtp.gmail.com'; // Spécifier le serveur SMTP
  $mail->SMTPAuth = true; // Activer authentication SMTP
  $mail->Username = 'gcantagalli76@gmail.com'; // Votre adresse email d'envoi
  $mail->Password = 'pescara85'; // Le mot de passe de cette adresse email
  $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Accepter SSL
  $mail->Port = 465;

  $mail->setFrom('from@example.com', 'Bricoleur du Dimanche'); // Personnaliser l'envoyeur
  $mail->addAddress('gcantagalli76@gmail.com', ''); // Ajouter le destinataire

  $mail->isHTML(true); // Paramétrer le format des emails en HTML ou non

  $mail->Subject = 'Votre changement de mot de passe';
  $mail->Body = 'Pour créer un nouveau mot de passe, veuillez vous connecter à cette URL : http://monprojet/modifypwd.php?token=' . $myToken;

  $mail->send();

  $infoMessage = 'Demande validée !';
  $bodyInfoMessage = 'Un email vous a été adressé';
  $colorInfoMessage = 'success';
} else {
  $infoMessage = 'Adresse email inconnue !';
  $bodyInfoMessage = 'Veuillez saisir une adresse email valide';
  $colorInfoMessage = 'error';
}

// si nous avons bien un token et que tu clics sur créer un new mdp alors tu lances la fonction qui récupère le new mdp et remplace l'ancien en bdd
if ((isset($_POST['token']) && isset($_POST['createPwd'])) && ($_POST['yourPassword'] == $_POST['yourConfirmPassword']) && (!empty($_POST['yourPassword']) || !empty($_POST['yourConfirmPassword']))) {
  $userObj->newPwd($_POST['token']);
  $infoMessage = 'Mot de passe modifié !';
  $bodyInfoMessage = 'Vous pouvez désormais vous connecter avec votre nouveau mot de passe';
  $colorInfoMessage = 'success';
  $userObj->deleteToken($_POST['token']);
} else if (isset($_POST['token']) && isset($_POST['createPwd']) && $_POST['yourPassword'] != $_POST['yourConfirmPassword']) {
  $infoMessage = 'Mot de passe incorrect !';
  $bodyInfoMessage = 'Le premier mot de passe ne semble pas identique au second';
  $colorInfoMessage = 'error';
}elseif ((isset($_POST['token']) && isset($_POST['createPwd'])) && (empty($_POST['yourPassword']) || empty($_POST['yourConfirmPassword']))) {
  $infoMessage = 'Données vides';
  $bodyInfoMessage = 'Veuillez saisir un nouveau mot de passe et le confirmer';
  $colorInfoMessage = 'error';
}
