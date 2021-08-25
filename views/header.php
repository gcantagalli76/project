<!DOCTYPE html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">
  <link rel="stylesheet" href="./assets/css/style.css">
  <title>Bricoleur du Dimanche</title>
</head>

<body>
  
  <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
    <div class="container-fluid">
    <a class="nav-item" type="button" href="index.php">
      <img src="/assets/img/logo3.png" alt="logo" width="300px">
    </a>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
        aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>

      </button>

      <form action="publication.php" method="POST">
      <div class="d-flex justify-content-end">
      <button class="nav-item border-0 bg-light" type="submit" href="publication.php" name="newPublication" >
          <img src="/assets/img/deposerAnnonce.png" alt="depot" width="210px" class="mt-1">
      </button>
        </div>
      </form>


<div class="d-flex justify-content-end">
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">

        <div class="navbar-nav">

        
        <li class="nav-item dropdown d-flex align-items-center">
        <a class="nav-link dropdown-toggle navbarDropdown2" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
          aria-expanded="">
          Catégories
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
          <li><a class="dropdown-item" href="Categorie.php?idcategory=1">Carrelage, parquet, sol</a></li>
          <li><a class="dropdown-item" href="Categorie.php?idcategory=2">Peinture et droguerie</a></li>
          <li><a class="dropdown-item" href="Categorie.php?idcategory=3">Matériaux de construction</a></li>
        </ul>
      </li>

          <a href="favoris.php">
          <li class="nav-item text-center" type="button">
            <img src="/assets/img/heart.svg" alt="heart" width="25px">
            <a class="nav-link active" href="favoris.php">Mes favoris</a>
          </li>
          </a>

<form action="connection.php" method="POST">
            <button class="nav-item text-center bg-light border-0 p-0" type="submit" href="connection.php" name="myAcount">
              <img src="/assets/img/person.svg" alt="person" width="25px">
              <a class="nav-link active">Mon compte</a>
            </button>
            </form>
            
            </div>

        </div>
      </div>
    </div>
  </nav>


