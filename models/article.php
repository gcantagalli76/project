<?php

// require './models/database.php';

class Article extends Database
{

    // je créé une fonction qui récupère les champs remplis sur le formulaire et qui les insert dans la bdd via sql après connection à la bdd
    public function addArticle()
    {
        $title = $_POST["yourTitle"];
        $category = $_POST["yourCategory"];
        $state = $_POST["yourState"];
        $quantity = $_POST["yourQuantity"];
        $buyDate = $_POST["yourBuyDate"];
        $price = $_POST["yourPrice"];
        $description = $_POST["yourDescription"];
        $userId = $_SESSION["userId"];
        $database = $this->connectDatabase();
        $myQuery = 'INSERT INTO article(article_title,article_quantity,article_purchasedate,article_price,article_give,article_description,category_id,condition_id,user_id)
            VALUES( :title, :quantity, :buyDate, :price, 0, :description, :category, :state, :userId)';
        $queryArticle = $database->prepare($myQuery);
        $queryArticle->bindValue(':title', $title, PDO::PARAM_STR);
        $queryArticle->bindValue(':quantity', $quantity, PDO::PARAM_INT);
        $queryArticle->bindValue(':buyDate', $buyDate, PDO::PARAM_STR);
        $queryArticle->bindValue(':price', $price, PDO::PARAM_INT);
        $queryArticle->bindValue(':description', $description, PDO::PARAM_STR);
        $queryArticle->bindValue(':category', $category, PDO::PARAM_INT);
        $queryArticle->bindValue(':state', $state, PDO::PARAM_INT);
        $queryArticle->bindValue(':userId', $userId, PDO::PARAM_INT);
        $execute = $queryArticle->execute();
        return $execute;
    }

    //fonction permettant d'afficher sur la page mespublications les articles publiés par l'utilisateur connecté
    public function articleUser()
    {
        $database = $this->connectDatabase();
        $userId = $_SESSION["userId"];
        $myQuery = "SELECT A.* FROM `article` as A left join _user as B on A.USER_ID = B.USER_ID where A.USER_ID = :userId;";
        $queryArticle = $database->prepare($myQuery);
        $queryArticle->bindValue(':userId', $userId, PDO::PARAM_INT);
        $queryArticle->execute();
        $fetch = $queryArticle->fetchAll();
        return $fetch;
    }

    //fonction permettant d'afficher sur la page d'accueil les 5 derniers articles publiés par tous les utilisateurs
    public function display5Article()
    {
        $database = $this->connectDatabase();
        $myQuery = "SELECT A.*, B.USER_CITY as ARTICLE_CITY  FROM `article` as A left join _user as B on A.USER_ID = B.USER_ID limit 5";
        $queryArticle = $database->query($myQuery);
        $fetch = $queryArticle->fetchAll();
        return $fetch;
    }

    //fonction permettant d'afficher sur les détails de l'article sur la page annonce.php
    public function displayArticleDetails()
    {
        $database = $this->connectDatabase();
        $articleId = $_POST['idArticleConsult'] ?? $_GET['idarticle'] ?? $_POST['addFavorite'];
        $myQuery = "SELECT A.*, 
                           DATE_FORMAT(`article_purchasedate`, '%d/%m/%Y') as ARTICLE_PURCHASEDATE,
                           B.CONDITION_NAME
                    FROM `article` as A left join _condition as B on A.CONDITION_ID = B.CONDITION_ID where ARTICLE_ID = :articleId";
        $queryArticle = $database->prepare($myQuery);
        $queryArticle->bindValue(':articleId', $articleId, PDO::PARAM_INT);
        $queryArticle->execute();
        $fetch = $queryArticle->fetchAll();
        return $fetch;
    }


    //fonction permettant d'afficher l'article à modifier avant la modification
    public function displayArticleB4Modif()
    {
        $database = $this->connectDatabase();
        $idarticle = $_POST['idArticleModify'];
        $myQuery = "SELECT *, left(ARTICLE_PURCHASEDATE,10) as ARTICLE_BUYDATE FROM `article` where ARTICLE_ID = :articleId";
        $queryArticle = $database->prepare($myQuery);
        $queryArticle->bindValue(':articleId', $idarticle, PDO::PARAM_INT);
        $queryArticle->execute();
        $fetch = $queryArticle->fetchAll();
        return $fetch;
    }


    // fonction permettant de modifier l'article
    public function modifyArticle()
    {
        $database = $this->connectDatabase();
        $title = $_POST["yourTitle"];
        $category = $_POST["yourCategory"];
        $state = $_POST["yourState"];
        $quantity = $_POST["yourQuantity"];
        $buyDate = $_POST["yourBuyDate"];
        $price = $_POST["yourPrice"];
        $description = $_POST["yourDescription"];
        $idarticle = $_POST['idArticleModify'];
        $myQuery = "UPDATE `article` SET ARTICLE_TITLE = :title, ARTICLE_QUANTITY = :quantity, ARTICLE_PURCHASEDATE = :buyDate, ARTICLE_PRICE = :price,
        ARTICLE_GIVE = 0, ARTICLE_DESCRIPTION = :description, CATEGORY_ID = :category, CONDITION_ID = :state where ARTICLE_ID = :articleId";
        $queryArticle = $database->prepare($myQuery);
        $queryArticle->bindValue(':title', $title, PDO::PARAM_STR);
        $queryArticle->bindValue(':quantity', $quantity, PDO::PARAM_INT);
        $queryArticle->bindValue(':buyDate', $buyDate, PDO::PARAM_STR);
        $queryArticle->bindValue(':price', $price, PDO::PARAM_INT);
        $queryArticle->bindValue(':description', $description, PDO::PARAM_STR);
        $queryArticle->bindValue(':category', $category, PDO::PARAM_INT);
        $queryArticle->bindValue(':state', $state, PDO::PARAM_INT);
        $queryArticle->bindValue(':articleId', $idarticle, PDO::PARAM_INT);
        $execute = $queryArticle->execute();
        return $execute;
    }

    // fonction permettant de supprimer un article
    public function deleteArticle()
    {
        $database = $this->connectDatabase();
        $idarticle = $_POST['idArticleDelete'];
        $myQuery = "DELETE FROM `article` where ARTICLE_ID = :id";
        $queryArticle = $database->prepare($myQuery);
        $queryArticle->bindValue(':id', $idarticle, PDO::PARAM_INT);
        $execute = $queryArticle->execute();
        return $execute;
    }

    //fonction permettant d'afficher les articles par catégorie
    public function displayArticleCategory()
    {
        $database = $this->connectDatabase();
        $idcategory = $_POST['selectCategory'] ?? $_GET['category_id'];
        $myQuery = "SELECT A.*,
                           B.CATEGORY_NAME,
                           C.USER_CITY as ARTICLE_CITY 
                    FROM `article` as A left join `category` as B on A.CATEGORY_ID = B.CATEGORY_ID 
                                        left join _user as C on A.USER_ID = C.USER_ID
                    WHERE A.CATEGORY_ID = :idcategory";
        $queryArticle = $database->prepare($myQuery);
        $queryArticle->bindValue(':idcategory', $idcategory, PDO::PARAM_INT);
        $queryArticle->execute();
        $fetch = $queryArticle->fetchAll();
        return $fetch;
    }

    // je créé une fonction qui ajoute les données de l'article mis en favori par l'utilisateur dans la table articlefavorite
    public function addFavouriteArticle()
    {
        $articleId = $_GET['idfavorite'] ?? $_POST['addFavorite'];
        $userId = $_SESSION["userId"];
        $database = $this->connectDatabase();
        $myQuery = 'INSERT INTO articlefavorite(article_title,article_price,article_description,article_quantity,article_purchasedate,article_give,category_id,condition_id,user_id,ARTICLE_ID)
                SELECT article_title,article_price,article_description,article_quantity,article_purchasedate,article_give,category_id,condition_id, :userId as user_id, ARTICLE_ID FROM `article` where ARTICLE_ID = :articleId';
        $queryArticle = $database->prepare($myQuery);
        $queryArticle->bindValue(':articleId', $articleId, PDO::PARAM_INT);
        $queryArticle->bindValue(':userId', $userId, PDO::PARAM_INT);
        $execute = $queryArticle->execute();
        return $execute;
    }

    //fonction permettant d'afficher les articles favoris de l'utilisateur connecté
    public function displayArticleFavorite()
    {
        $database = $this->connectDatabase();
        $userId = $_SESSION["userId"];
        $myQuery = "SELECT * FROM `articlefavorite` where USER_ID = :userId;";
        $queryArticle = $database->prepare($myQuery);
        $queryArticle->bindValue(':userId', $userId, PDO::PARAM_INT);
        $queryArticle->execute();
        $fetch = $queryArticle->fetchAll();
        return $fetch;
    }

    // fonction permettant de supprimer un article
    public function deleteFavoriteArticle()
    {
        $database = $this->connectDatabase();
        $idarticle = $_POST['idArticleFavoriteDelete'];
        $userId = $_SESSION["userId"];
        $myQuery = "DELETE FROM `articlefavorite` where ARTICLE_ID = :id and USER_ID = :userId";
        $queryArticle = $database->prepare($myQuery);
        $queryArticle->bindValue(':id', $idarticle, PDO::PARAM_INT);
        $queryArticle->bindValue(':userId', $userId, PDO::PARAM_INT);
        $execute = $queryArticle->execute();
        return $execute;
    }
}
