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


if (isset($_GET['iddelete'])) {

$id = $_GET['iddelete'];

$delete = $bdd->prepare("DELETE FROM article WHERE ARTICLE_ID = :id");
$delete->execute( array( ':id' => $id ) );
header('location:mespublications.php');

}

?>


