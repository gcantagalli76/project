<?php

// require './models/database.php';

class Article extends Database
{

    /**
     * Function to insert the elements from the form into the database after connection to database
     *
     */
    public function addArticle($picture1, $picture2, $picture3)
    {
        $title = htmlspecialchars($_POST["yourTitle"]);
        $category = htmlspecialchars($_POST["yourCategory"]);
        $state = $_POST["yourState"];
        $quantity = $_POST["yourQuantity"];
        $buyDate = $_POST["yourBuyDate"];
        $price = htmlspecialchars($_POST["yourPrice"]);
        $description = htmlspecialchars($_POST["yourDescription"]);
        $userId = $_SESSION["userId"];
        $database = $this->connectDatabase();
        $myQuery = 'INSERT INTO article(article_title,article_quantity,article_purchasedate,article_price,article_give,article_description,category_id,condition_id,user_id,picture1,picture2,picture3,valid)
            VALUES( :title, :quantity, :buyDate, :price, 0, :description, :category, :state, :userId,:picture1,:picture2,:picture3,0)';
        $queryArticle = $database->prepare($myQuery);
        $queryArticle->bindValue(':title', $title, PDO::PARAM_STR);
        $queryArticle->bindValue(':quantity', $quantity, PDO::PARAM_INT);
        $queryArticle->bindValue(':buyDate', $buyDate, PDO::PARAM_STR);
        $queryArticle->bindValue(':price', $price, PDO::PARAM_INT);
        $queryArticle->bindValue(':description', $description, PDO::PARAM_STR);
        $queryArticle->bindValue(':category', $category, PDO::PARAM_INT);
        $queryArticle->bindValue(':state', $state, PDO::PARAM_INT);
        $queryArticle->bindValue(':userId', $userId, PDO::PARAM_INT);
        $queryArticle->bindValue(':picture1', $picture1, PDO::PARAM_STR_CHAR);
        $queryArticle->bindValue(':picture2', $picture2, PDO::PARAM_STR_CHAR);
        $queryArticle->bindValue(':picture3', $picture3, PDO::PARAM_STR_CHAR);
        $execute = $queryArticle->execute();
        return $execute;
    }

    /**
     * Function to display in my publications all articles published by the user
     *
     */
    public function articleUser()
    {
        $database = $this->connectDatabase();
        $userId = $_SESSION["userId"];
        $myQuery = "SELECT A.*,
                           C.CATEGORY_NAME 
                    FROM `article` as A 
                    left join _user as B on A.USER_ID = B.USER_ID 
                    left join category as C on A.CATEGORY_ID = C.CATEGORY_ID
                    where A.USER_ID = :userId
                    order by A.valid;";
        $queryArticle = $database->prepare($myQuery);
        $queryArticle->bindValue(':userId', $userId, PDO::PARAM_INT);
        $queryArticle->execute();
        $fetch = $queryArticle->fetchAll();
        return $fetch;
    }


    /**
     * Function to display on homepage the last 5 articles
     *
     */
    public function display5Article()
    {
        $database = $this->connectDatabase();
        $myQuery = "SELECT A.*, 
                           B.USER_CITY as ARTICLE_CITY  
                           FROM `article` as A left join _user as B on A.USER_ID = B.USER_ID 
                           where A.valid = 1 
                           order by ARTICLE_ID desc
                           limit 5";
        $queryArticle = $database->query($myQuery);
        $fetch = $queryArticle->fetchAll();
        return $fetch;
    }

    /**
     * Function to display article's details on annonce.php
     *
     */
    public function displayArticleDetails()
    {
        $database = $this->connectDatabase();
        $articleId = $_GET['idArticleConsult'] ?? $_GET['idarticle'] ?? $_POST['addFavorite'];
        $myQuery = "SELECT A.*, 
                           DATE_FORMAT(`article_purchasedate`, '%d/%m/%Y') as ARTICLE_PURCHASEDATE,
                           C.CONDITION_NAME,
                           U.USER_CITY,
                           U.USER_FIRSTNAME
                    FROM `article` as A left join _condition as C on A.CONDITION_ID = C.CONDITION_ID 
                                        left join _user as U on A.user_id = U.user_id
                    where A.ARTICLE_ID = :articleId";
        $queryArticle = $database->prepare($myQuery);
        $queryArticle->bindValue(':articleId', $articleId, PDO::PARAM_INT);
        $queryArticle->execute();
        $fetch = $queryArticle->fetchAll();
        return $fetch;
    }



    /**
     * Function to display the artile to modify before modification
     *
     */
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


    /**
     * Function to modify the article
     *
     */
    public function modifyArticle($picture1, $picture2, $picture3)
    {
        $database = $this->connectDatabase();
        $title = htmlspecialchars($_POST["yourTitle"]);
        $category = $_POST["yourCategory"];
        $state = $_POST["yourState"];
        $quantity = $_POST["yourQuantity"];
        $buyDate = $_POST["yourBuyDate"];
        $price = htmlspecialchars($_POST["yourPrice"]);
        $description = htmlspecialchars($_POST["yourDescription"]);
        $idarticle = $_POST['idArticleModify'];
        $myQuery = "UPDATE `article` SET ARTICLE_TITLE = :title, ARTICLE_QUANTITY = :quantity, ARTICLE_PURCHASEDATE = :buyDate, ARTICLE_PRICE = :price,
                    ARTICLE_GIVE = 0, ARTICLE_DESCRIPTION = :description, CATEGORY_ID = :category, CONDITION_ID = :state, picture1 = :picture1, 
                    picture2 = :picture2, picture3 = :picture3, valid = 0 where ARTICLE_ID = :articleId";
        $queryArticle = $database->prepare($myQuery);
        $queryArticle->bindValue(':title', $title, PDO::PARAM_STR);
        $queryArticle->bindValue(':quantity', $quantity, PDO::PARAM_INT);
        $queryArticle->bindValue(':buyDate', $buyDate, PDO::PARAM_STR);
        $queryArticle->bindValue(':price', $price, PDO::PARAM_INT);
        $queryArticle->bindValue(':description', $description, PDO::PARAM_STR);
        $queryArticle->bindValue(':category', $category, PDO::PARAM_INT);
        $queryArticle->bindValue(':state', $state, PDO::PARAM_INT);
        $queryArticle->bindValue(':articleId', $idarticle, PDO::PARAM_INT);
        $queryArticle->bindValue(':picture1', $picture1, PDO::PARAM_STR_CHAR);
        $queryArticle->bindValue(':picture2', $picture2, PDO::PARAM_STR_CHAR);
        $queryArticle->bindValue(':picture3', $picture3, PDO::PARAM_STR_CHAR);
        $execute = $queryArticle->execute();
        return $execute;
    }


    /**
     * Function to delete the article
     *
     */
    public function deleteArticle()
    {
        $database = $this->connectDatabase();
        $idarticle = $_POST['idArticleDelete'];
        $myQuery = "DELETE FROM `conversation` where ARTICLE_ID = :id;
                    DELETE FROM `article` where ARTICLE_ID = :id;
                    DELETE FROM `articlefavorite` where ARTICLE_ID = :id;";
        $queryArticle = $database->prepare($myQuery);
        $queryArticle->bindValue(':id', $idarticle, PDO::PARAM_INT);
        $execute = $queryArticle->execute();
        return $execute;
    }

    /**
     * Function to display article by category
     *
     */
    public function displayArticleCategory()
    {
        $database = $this->connectDatabase();
        $idcategory = $_POST['selectCategory'] ?? $_GET['category_id'];
        $myQuery = "SELECT A.*,
                           B.CATEGORY_NAME,
                           C.USER_CITY as ARTICLE_CITY 
                    FROM `article` as A left join `category` as B on A.CATEGORY_ID = B.CATEGORY_ID 
                                        left join _user as C on A.USER_ID = C.USER_ID
                    WHERE A.CATEGORY_ID = :idcategory and A.valid = 1 ";
        $queryArticle = $database->prepare($myQuery);
        $queryArticle->bindValue(':idcategory', $idcategory, PDO::PARAM_INT);
        $queryArticle->execute();
        $fetch = $queryArticle->fetchAll();
        return $fetch;
    }


    /**
     * Function to add the data of the article add in favorite by the user in the table articlefavorite
     *
     */
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

    /**
     * Function to display articles of the connected user
     *
     */
    public function displayArticleFavorite()
    {
        $database = $this->connectDatabase();
        $userId = $_SESSION["userId"];
        $myQuery = "SELECT A.*,
                           B.picture1,
                           B.picture2,
                           B.picture3,
                           C.CATEGORY_NAME
                    FROM `articlefavorite` as A left join article as B on A.ARTICLE_ID = B.ARTICLE_ID
                                                left join category as C on B.CATEGORY_ID = C.CATEGORY_ID
                    WHERE A.USER_ID = :userId;";
        $queryArticle = $database->prepare($myQuery);
        $queryArticle->bindValue(':userId', $userId, PDO::PARAM_INT);
        $queryArticle->execute();
        $fetch = $queryArticle->fetchAll();
        return $fetch;
    }


    /**
     * Function to display favorite articles of the connected user and to avoid he add twice the same article in favorite
     *
     */
    public function verifyArticleFavorite($userId, $articleId)
    {
        $database = $this->connectDatabase();
        $myQuery = "SELECT * FROM `articlefavorite` where USER_ID = :userId and ARTICLE_ID = :articleId";
        $queryArticle = $database->prepare($myQuery);
        $queryArticle->bindValue(':userId', $userId, PDO::PARAM_INT);
        $queryArticle->bindValue(':articleId', $articleId, PDO::PARAM_INT);
        $queryArticle->execute();
        $fetch = $queryArticle->fetch();
        return $fetch;
    }


    /**
     * Function to verify the article was not already validate by the admin
     *
     */
    public function verifyArticleValid($articleId)
    {
        $database = $this->connectDatabase();
        $myQuery = "SELECT * FROM `article` where ARTICLE_ID = :articleId and valid = 1";
        $queryArticle = $database->prepare($myQuery);
        $queryArticle->bindValue(':articleId', $articleId, PDO::PARAM_INT);
        $queryArticle->execute();
        $fetch = $queryArticle->fetch();
        return $fetch;
    }



    /**
     * Function to delete an article in favorite
     *
     */
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


    /**
     * Function to display the publication for admin validation
     *
     */
    public function displayArticleToValid()
    {
        $database = $this->connectDatabase();
        $myQuery = "SELECT A.*,
                           C.CATEGORY_NAME  
                           FROM `article` as A left join category as C on A.CATEGORY_ID = C.CATEGORY_ID
                           where valid = 0";
        $queryArticle = $database->query($myQuery);
        $queryArticle->execute();
        $fetch = $queryArticle->fetchAll();
        return $fetch;
    }


    /**
     * Function who valid the article by admin
     *
     */
    public function validArticle()
    {
        $database = $this->connectDatabase();
        $idarticle = $_POST['validArticleBtn'];
        $myQuery = "UPDATE `article` SET valid = 1 where ARTICLE_ID = :articleId";
        $queryArticle = $database->prepare($myQuery);
        $queryArticle->bindValue(':articleId', $idarticle, PDO::PARAM_INT);
        $execute = $queryArticle->execute();
        return $execute;
    }


    /**
     * Function who send a message to the seller
     *
     */
    public function sendMessage()
    {
        $database = $this->connectDatabase();
        $idarticle = $_POST['articleId'];
        $textMessage = htmlspecialchars($_POST['textMessage']);
        $userId = $_SESSION["userId"];
        $myQuery = 'INSERT INTO CONVERSATION(conversation_text,article_id,user_send_id)
                    VALUES(:textMessage, :articleId, :userId)';
        $queryArticle = $database->prepare($myQuery);
        $queryArticle->bindValue(':articleId', $idarticle, PDO::PARAM_INT);
        $queryArticle->bindValue(':textMessage', $textMessage, PDO::PARAM_STR_CHAR);
        $queryArticle->bindValue(':userId', $userId, PDO::PARAM_INT);
        $execute = $queryArticle->execute();
        return $execute;
    }

    /**
     * Function to display all message received by the user
     *
     */
    public function displayUserMessages()
    {
        $database = $this->connectDatabase();
        $userId = $_SESSION["userId"];
        $myQuery = "SELECT C.*,
                           U.USER_FIRSTNAME as firstName,
                           U.USER_LASTNAME as lastName,
                           A.ARTICLE_TITLE,
                           A.picture1,
                           DATE_FORMAT(C.SEND_DATE, '%d/%m/%Y') as SEND_DATE2
                    FROM `conversation` as C left join _user as U on C.USER_SEND_ID = U.USER_ID 
                                             left join article as A on A.ARTICLE_ID = C.ARTICLE_ID
                    where A.USER_ID = :userId
                    order by c.send_date";
        $queryArticle = $database->prepare($myQuery);
        $queryArticle->bindValue(':userId', $userId, PDO::PARAM_INT);
        $queryArticle->execute();
        $fetch = $queryArticle->fetchAll();
        return $fetch;
    }


    /**
     * Function to display a message received by the user
     *
     */
    public function deleteUserMessages()
    {
        $database = $this->connectDatabase();
        $conversationId = $_POST["conversationId"];
        $myQuery = "DELETE FROM `conversation` where CONVERSATION_ID = :conversationId;";
        $queryArticle = $database->prepare($myQuery);
        $queryArticle->bindValue(':conversationId', $conversationId, PDO::PARAM_INT);
        $execute = $queryArticle->execute();
        return $execute;
    }
}
