<?php

class Database {

    private $dbname = 'bddproject';
    private $username = 'root';
    private $password = '';

    protected function connectDatabase() {
        try {
            $database = new PDO("mysql:host=localhost;dbname=$this->dbname;charset=utf8", $this->username, $this->password);
            $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $database;
        } catch(PDOException $error) {
            die('error : ' . $error->getMessage());
        }
    }
}

?>