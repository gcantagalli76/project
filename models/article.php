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
        $userId = $_COOKIE["userId"];
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
        $userId = $_COOKIE["userId"];
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
        $myQuery = "SELECT * FROM `article` limit 5";
        $queryArticle = $database->query($myQuery);
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
        $idcategory = $_POST['selectCategory'];
        $myQuery = "SELECT A.*,
                       B.CATEGORY_NAME
                FROM `article` as A left join `category` as B on A.CATEGORY_ID = B.CATEGORY_ID WHERE A.CATEGORY_ID = :idcategory";
        $queryArticle = $database->prepare($myQuery);
        $queryArticle->bindValue(':idcategory', $idcategory, PDO::PARAM_INT);
        $queryArticle->execute();
        $fetch = $queryArticle->fetchAll();
        return $fetch;
    }
}
