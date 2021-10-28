<?php

require './models/database.php';

class User extends Database
{
    /**
     * Function to add the new user in database after recovery user informations
     *
     * @param string $yourPassword
     * @return void
     */
    public function addUser(string $yourPassword): void
    {
        $name = htmlspecialchars($_POST["yourName"]);
        $firstname = htmlspecialchars($_POST["yourFirstName"]);
        $mail = htmlspecialchars($_POST["yourEmail"]);
        $city = htmlspecialchars($_POST["yourCity"]);
        $postalcode = htmlspecialchars($_POST["yourPostalCode"]);
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
        $queryUser->execute();
    }


    /**
     * Function to display information about the user
     *
     * @return array
     */
    public function displayUser(): array
    {
        $database = $this->connectDatabase();
        $myQuery = "SELECT A.*,
                           B.status_name
        FROM `_user` as A left join `_status` as B on A.status_id = B.status_id";
        $queryUser = $database->query($myQuery);
        $fetch = $queryUser->fetchAll();
        return $fetch;
    }

    /**
     * Function who verify if in database the user who is connected as a count
     *
     * 
     */
    public function connectionUser()
    {
        $mail = htmlspecialchars($_POST["yourEmail"]);
        $database = $this->connectDatabase();
        $myQuery = "SELECT * FROM `_user` where USER_EMAIL = :email";
        $queryUser = $database->prepare($myQuery);
        $queryUser->bindValue(':email', $mail, PDO::PARAM_STR);
        $queryUser->execute();
        $fetch = $queryUser->fetch();
        return $fetch;
    }


    /**
     * Function to add a token in the user table when he forget his password
     *
     */
    public function addToken($token)
    {
        $mail = htmlspecialchars($_POST["yourEmail"]);
        $database = $this->connectDatabase();
        $myQuery = "UPDATE `_user` SET token = :token where USER_EMAIL = :email";
        $queryUser = $database->prepare($myQuery);
        $queryUser->bindValue(':email', $mail, PDO::PARAM_STR);
        $queryUser->bindValue(':token', $token, PDO::PARAM_STR);
        $queryUser->execute();
        return $queryUser;
    }


    /**
     * Function to create a new password
     *
     */
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

    /**
     * Function to display all the email addresses of the users
     *
     * @param string $email
     * 
     */
    public function displayEmail(string $email)
    {
        $database = $this->connectDatabase();
        $myQuery = "SELECT * FROM _user where user_email = :email";
        $queryUser = $database->prepare($myQuery);
        $queryUser->bindValue(':email', $email, PDO::PARAM_STR);
        $queryUser->execute();
        $fetch = $queryUser->fetch();
        return $fetch;
    }


    /**
     * Function to delete the generated token after the password modification
     *
     */
    public function deleteToken($token)
    {
        $database = $this->connectDatabase();
        $myQuery = "UPDATE `_user` SET token = null where token = :token";
        $queryUser = $database->prepare($myQuery);
        $queryUser->bindValue(':token', $token, PDO::PARAM_STR);
        $queryUser->execute();
        return $queryUser;
    }

    /**
     * function to modify the user's informations
     *
     * @return void
     */
    public function modifyUser(): void
    {
        $database = $this->connectDatabase();
        $lastName = htmlspecialchars($_POST["lastName"]);
        $firstName = htmlspecialchars($_POST["firstName"]);
        $mail = htmlspecialchars($_POST["mail"]);
        $city = htmlspecialchars($_POST["city"]);
        $zipCode = htmlspecialchars($_POST["zipCode"]);
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
        $queryUser->execute();
    }


    /**
     * function to verify the user's password
     *
     * @return array
     */
    public function verifyPwd(): array
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


    /**
     * Function to create a new password from the user's count
     *
     */
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



    /**
     * function to delete the user's account
     *
     * @return void
     */
    public function deleteUser(): void
    {
        $userId = $_SESSION["userId"];
        $database = $this->connectDatabase();
        $myQuery = "DELETE from `_user` where USER_ID = :userId; DELETE from `articlefavorite` where USER_ID = :userId;";
        $queryUser = $database->prepare($myQuery);
        $queryUser->bindValue(':userId', $userId, PDO::PARAM_INT);
        $queryUser->execute();
    }


    /**
     * Function to delete one user by the admin
     *
     */
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


    /**
     * Function to midify an article
     *
     */
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
