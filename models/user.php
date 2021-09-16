<?php

require './models/database.php';

class User extends Database
{

    // je créé une fonction qui récupère les champs remplis sur le formulaire et qui les insert dans la bdd via sql après connection à la bdd
    public function addUser($yourPassword)
    {
        $name = $_POST["yourName"];
        $firstname = $_POST["yourFirstName"];
        $mail = $_POST["yourEmail"];
        $city = $_POST["yourCity"];
        $postalcode = $_POST["yourPostalCode"];
        // $yourpassword = $_POST["yourPassword"];
        $database = $this->connectDatabase();
        $myQuery = 'INSERT INTO _user(user_firstname, user_lastname, user_email, user_city, user_zipcode, user_password, status_id) 
            VALUES( :firstname, :lastname, :email, :city, :postalcode, :password, 2)';
        $queryUser = $database->prepare($myQuery);
        $queryUser->bindValue(':firstname', $firstname, PDO::PARAM_STR);
        $queryUser->bindValue(':lastname', $name, PDO::PARAM_STR);
        $queryUser->bindValue(':email', $mail, PDO::PARAM_STR);
        $queryUser->bindValue(':city', $city, PDO::PARAM_STR);
        $queryUser->bindValue(':postalcode', $postalcode, PDO::PARAM_STR);
        $queryUser->bindValue(':password', $yourPassword, PDO::PARAM_STR_CHAR);
        $execute = $queryUser->execute();
        return $execute;
    }

    //fonction permettant d'afficher sur la page mon compte les infos perso relatives à l'utilisateur connecté
    public function displayUser()
    {
        $database = $this->connectDatabase();
        $myQuery = "SELECT A.*,
                           B.status_name
        FROM `_user` as A left join `_status` as B on A.status_id = B.status_id";
        $queryUser = $database->query($myQuery);
        $fetch = $queryUser->fetchAll();
        return $fetch;
    }
    

    //fonction permettant de vérifier dans la bdd si l'utilisateur qui se connecte a bien un compte de créé en base
    public function connectionUser()
    {
        $mail = $_POST["yourEmail"];
        $database = $this->connectDatabase();
        $myQuery = "SELECT * FROM `_user` where USER_EMAIL = :email";
        $queryUser = $database->prepare($myQuery);
        $queryUser->bindValue(':email', $mail, PDO::PARAM_STR);
        $queryUser->execute();
        $fetch = $queryUser->fetch();
        return $fetch;
    }

    //fonction permettant de rajouter un token dans la table user lorsqu'il a oublié son mdp
    public function addToken($token)
    {
        $mail = $_POST["yourEmail"];
        $database = $this->connectDatabase();
        $myQuery = "UPDATE `_user` SET token = :token where USER_EMAIL = :email";
        $queryUser = $database->prepare($myQuery);
        $queryUser->bindValue(':email', $mail, PDO::PARAM_STR);
        $queryUser->bindValue(':token', $token, PDO::PARAM_STR);
        $queryUser->execute();
        return $queryUser;
    }

    //fonction permettant de créer un nouveau mdp
    public function newPwd($token)
    {
        $newPwd = password_hash($_POST['yourPassword'], PASSWORD_DEFAULT);
        $database = $this->connectDatabase();
        $myQuery = "UPDATE `_user` SET user_password = :newpwd where token = :token";
        $queryUser = $database->prepare($myQuery);
        $queryUser->bindValue(':token', $token, PDO::PARAM_STR);
        $queryUser->bindValue(':newpwd', $newPwd, PDO::PARAM_STR_CHAR);
        $queryUser->execute();
        return $queryUser;
    }

    //fonction permettant de ressortir toutes les adresses emails des utilisateurs en bdd
    public function displayEmail($email)
    {
        $database = $this->connectDatabase();
        $myQuery = "SELECT * FROM _user where user_email = :email";
        $queryUser = $database->prepare($myQuery);
        $queryUser->bindValue(':email', $email, PDO::PARAM_STR);
        $queryUser->execute();
        $fetch = $queryUser->fetch();
        return $fetch;
    }

    //fonction permettant de supprimer le token généré pour le changement de mdp
    public function deleteToken($token)
    {
        $database = $this->connectDatabase();
        $myQuery = "UPDATE `_user` SET token = null where token = :token";
        $queryUser = $database->prepare($myQuery);
        $queryUser->bindValue(':token', $token, PDO::PARAM_STR);
        $queryUser->execute();
        return $queryUser;
    }

    //fonction permettant de modifier les données de l'utilisateur à sa demande
    public function modifyUser()
    {
        $database = $this->connectDatabase();
        $lastName = $_POST["lastName"];
        $firstName = $_POST["firstName"];
        $mail = $_POST["mail"];
        $city = $_POST["city"];
        $zipCode = $_POST["zipCode"];
        $userId = $_SESSION["userId"];
        //on récupère les données remplies sur le compte utilisateur pour les insérer dans la table user et modifier les données de l'utilisateur connecté
        $myQuery = "UPDATE `_user` SET user_firstname = :firstname, user_lastname = :lastname, user_email = :email, user_city = :city, user_zipcode = :zipcode where USER_ID = :userId";
        $queryUser = $database->prepare($myQuery);
        $queryUser->bindValue(':firstname', $firstName, PDO::PARAM_STR);
        $queryUser->bindValue(':lastname', $lastName, PDO::PARAM_STR);
        $queryUser->bindValue(':email', $mail, PDO::PARAM_STR);
        $queryUser->bindValue(':city', $city, PDO::PARAM_STR);
        $queryUser->bindValue(':zipcode', $zipCode, PDO::PARAM_STR);
        $queryUser->bindValue(':userId', $userId, PDO::PARAM_INT);
        $execute = $queryUser->execute();
        return $execute;
    }

    //fonction permettant de vérifier que le pwd avant changement est bien celui de l'utilisateur connecté
    public function verifyPwd()
    {
        $userId = $_SESSION["userId"];
        $database = $this->connectDatabase();
        $myQuery = "SELECT USER_PASSWORD FROM `_user` where USER_ID = :userId";
        $queryUser = $database->prepare($myQuery);
        $queryUser->bindValue(':userId', $userId, PDO::PARAM_INT);
        $queryUser->execute();
        $fetch = $queryUser->fetch();
        return $fetch;
    }

    //fonction permettant de créer un nouveau mdp à la demande de l'utilisateur depuis son compte
    public function changeMyPwd()
    {
        $userId = $_SESSION["userId"];
        $newPwd = password_hash($_POST['yourNewPassword'], PASSWORD_DEFAULT);
        $database = $this->connectDatabase();
        $myQuery = "UPDATE `_user` SET user_password = :newpwd where USER_ID = :userId";
        $queryUser = $database->prepare($myQuery);
        $queryUser->bindValue(':newpwd', $newPwd, PDO::PARAM_STR_CHAR);
        $queryUser->bindValue(':userId', $userId, PDO::PARAM_INT);
        $queryUser->execute();
        return $queryUser;
    }


    //fonction permettant de supprimer le compte à la demande de l'utilisateur depuis son compte
    public function deleteUser()
    {
        $userId = $_SESSION["userId"];
        $database = $this->connectDatabase();
        $myQuery = "DELETE from `_user` where USER_ID = :userId; DELETE from `articlefavorite` where USER_ID = :userId;";
        $queryUser = $database->prepare($myQuery);
        $queryUser->bindValue(':userId', $userId, PDO::PARAM_INT);
        $queryUser->execute();
        return $queryUser;
    }

//fonction permettant de supprimer le compte à la demande de l'admin
public function deleteUserByAdmin()
{
    $userId = $_POST['idUserDelete'];
    $database = $this->connectDatabase();
    $myQuery = "DELETE from `_user` where USER_ID = :userId; DELETE from `articlefavorite` where USER_ID = :userId;";
    $queryUser = $database->prepare($myQuery);
    $queryUser->bindValue(':userId', $userId, PDO::PARAM_INT);
    $queryUser->execute();
    return $queryUser;
}

// fonction permettant de modifier l'article
public function modifyUserStatut()
{
    $userStatut = $_POST['userStatut'];
    $userId = $_POST['validChangeStatut'];
    $database = $this->connectDatabase();
    $myQuery = "UPDATE `_user` SET STATUS_ID = :userStatut where USER_ID = :userId";
    $queryArticle = $database->prepare($myQuery);
    $queryArticle->bindValue(':userStatut', $userStatut, PDO::PARAM_INT);
    $queryArticle->bindValue(':userId', $userId, PDO::PARAM_INT);
    $execute = $queryArticle->execute();
    return $execute;
}


}
