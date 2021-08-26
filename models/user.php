<?php

require './models/database.php';

class User extends Database
{

    // je créé une fonction qui récupère les champs remplis sur le formulaire et qui les insert dans la bdd via sql après connection à la bdd
    public function addUser()
    {
        $name = $_POST["yourName"];
        $firstname = $_POST["yourFirstName"];
        $mail = $_POST["yourEmail"];
        $city = $_POST["yourCity"];
        $postalcode = $_POST["yourPostalCode"];
        $yourpassword = $_POST["yourPassword"];
        $database = $this->connectDatabase();
        $myQuery = 'INSERT INTO _user(user_firstname, user_lastname, user_email, user_city, user_zipcode, user_password, status_id) 
            VALUES( :firstname, :lastname, :email, :city, :postalcode, :password, 2)';
        $queryUser = $database->prepare($myQuery);
        $queryUser->bindValue(':firstname', $firstname, PDO::PARAM_STR);
        $queryUser->bindValue(':lastname', $name, PDO::PARAM_STR);
        $queryUser->bindValue(':email', $mail, PDO::PARAM_STR);
        $queryUser->bindValue(':city', $city, PDO::PARAM_STR);
        $queryUser->bindValue(':postalcode', $postalcode, PDO::PARAM_STR);
        $queryUser->bindValue(':password', $yourpassword, PDO::PARAM_STR);
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
        $yourpassword = $_POST["yourPassword"];
        $database = $this->connectDatabase();
        $myQuery = "SELECT * FROM `_user` where USER_EMAIL = :email and USER_PASSWORD = :password";
        $queryUser = $database->prepare($myQuery);
        $queryUser->bindValue(':email', $mail, PDO::PARAM_STR);
        $queryUser->bindValue(':password', $yourpassword, PDO::PARAM_STR);
        $queryUser->execute();
        $fetch = $queryUser->fetch();
        return $fetch;
    }

}
