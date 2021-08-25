<?php

// require './models/database.php';

class Article extends Database {

    // je créé une fonction qui récupère les champs remplis sur le formulaire et qui les insert dans la bdd via sql après connection à la bdd
    public function addArticle(){
            $title = $_POST["yourTitle"];
            $category = $_POST["yourCategory"];
            $state = $_POST["yourState"];
            $quantity = $_POST["yourQuantity"];
            $buyDate = $_POST["yourBuyDate"];
            $price = $_POST["yourPrice"];
            $description = $_POST["yourDescription"];
            $userId = $_COOKIE["userId"];
            $database = $this->connectDatabase();
            $myQuery = 'INSERT INTO article(article_title,article_quantity,article_purchasedate,article_price,article_give,article_description,category_id,condition_id,user_id)
            VALUES( :title, :quantity, :buyDate, :price, 0, :description, :category, :state, :userId)';
            $queryUser = $database->prepare($myQuery);
            $queryUser->bindValue(':title', $title, PDO::PARAM_STR);
            $queryUser->bindValue(':quantity', $quantity, PDO::PARAM_INT);
            $queryUser->bindValue(':buyDate', $buyDate, PDO::PARAM_STR);
            $queryUser->bindValue(':price', $price, PDO::PARAM_INT);
            $queryUser->bindValue(':description', $description, PDO::PARAM_STR);
            $queryUser->bindValue(':category', $category, PDO::PARAM_INT);
            $queryUser->bindValue(':state', $state, PDO::PARAM_INT);
            $queryUser->bindValue(':userId', $userId, PDO::PARAM_INT);
            $execute = $queryUser->execute();
            return $execute;
    }

//fonction permettant d'afficher sur la page mespublications les articles publiés par l'utilisateur connecté
    public function articleUser(){
        $database = $this->connectDatabase();
        $userId = $_COOKIE["userId"];
        $myQuery = "SELECT A.* FROM article as A left join _user as B on A.USER_ID = B.USER_ID where A.USER_ID = :userId;";
        $queryUser = $database->prepare($myQuery);
        $queryUser->bindValue(':userId', $userId, PDO::PARAM_INT);
        $queryUser->execute();
        $fetch = $queryUser->fetchAll();
        return $fetch;
    }

    //fonction permettant de vérifier dans la bdd si l'utilisateur qui se connecte a bien un compte de créé en base
    // public function connectionUser(){
    //     $mail = $_POST["yourEmail"];
    //     $yourpassword = $_POST["yourPassword"];
    //     $database = $this->connectDatabase();
    //     $myQuery = "SELECT * FROM `_user` where USER_EMAIL = :email and USER_PASSWORD = :password";
    //     $queryUser = $database->prepare($myQuery);
    //     $queryUser->bindValue(':email', $mail, PDO::PARAM_STR);
    //     $queryUser->bindValue(':password', $yourpassword, PDO::PARAM_STR);
    //     $queryUser->execute();
    //     $fetch = $queryUser->fetch();
    //     return $fetch;
    // }



    // public function detailPatients($id)
    // {
    //     $database = $this->connectDatabase();
    //     $myQuery = "SELECT *, DATE_FORMAT(`birthdate`, '%d/%m/%Y') as birthdate2 FROM `patients` where ID = :id";
    //     $queryPatient = $database->prepare($myQuery);
    //     //permet d'indiquer que $id sera bien :id dans la requête du dessus et que le format sera du int, à faire quand on a qu'une ligne dans un array
    //     $queryPatient->bindValue(':id', $id, PDO::PARAM_INT);
    //     $queryPatient->execute();
    //     $fetch = $queryPatient->fetch();
    //     return $fetch;
    // }


//     public function modifyPatients()
//     {
//         $database = $this->connectDatabase();
//         $lastname = $_POST["lastname"];
//         $firstname = $_POST["firstname"];
//         $mail = $_POST["mail"];
//         $phone = $_POST["phone"];
//         $birthdate = $_POST["birthdate"];
//         $id = $_POST['detail'];

//         //on récupère les données remplies sur la publication pour les insérer dans la table article et modifier l'article concerné
//         $req = $database->prepare('UPDATE `patients` SET lastname = :lastname, firstname = :firstname, birthdate = :birthdate, phone = :phone,
// mail = :mail where id = :id');

//         $req->execute(array(
//             'lastname' => $lastname,
//             'firstname' => $firstname,
//             'mail' => $mail,
//             'phone' => $phone,
//             'birthdate' => $birthdate,
//             'id' => $id
//         ));

//     }
}
