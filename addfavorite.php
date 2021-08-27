<?php

// connection à la base de données, en cas de problème message d'erreur
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=bddproject;charset=utf8mb4', 'root', '');
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}


if (isset($_GET['idfavorite'])) {

$id = $_GET['idfavorite'];

$favor = $bdd->prepare("SELECT * FROM `article` where ARTICLE_ID = :id");
$favor->execute( array( ':id' => $id ) );

// INSERT INTO table1 ( column1, column2, someInt, someVarChar )
// SELECT  table2.column1, table2.column2, 8, 'some string etc.'
// FROM    table2
// WHERE   table2.ID = 7;

// voir pour appliquer cela au lieu du select *

header('location:Categorie.php');

}

?>


