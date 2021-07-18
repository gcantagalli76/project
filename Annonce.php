<?php require 'views/header.php'; ?>

  <div class="container-fluid centerPage">


<div class="row d-flex justify-content-center Annonce">

<div class="col-5">

  <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1" aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2" aria-label="Slide 3"></button>
  </div>
  <div class="carousel-inner p-2">
    <div class="carousel-item active">
      <img src="/assets/img/carrelagelm.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item p-2">
      <img src="/assets/img/carrelagelm.jpg" class="d-block w-100" alt="...">
    </div>
    <div class="carousel-item p-2">
      <img src="/assets/img/carrelagelm.jpg" class="d-block w-100" alt="...">
    </div>
  </div>
  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>
</div>


<div class="col-6">
<h3 class="text-center mt-1">Titre de l'annonce</h3>
<div class="mt-5">Descriptif : It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal.</div>

<div class="row mt-5">
<div class="col-4 text-center">
<div>Prix</div>
<div>50€</div>
</div>

<div class="col-4 text-center">
<div>Etat</div>
<div>Neuf</div>
</div>

<div class="col-4 text-center">
<div>Date d'achat</div>
<div>16/09/2020</div>
</div>
</div>


<div class="row mt-5">
<div class="col-6 text-center">
<button type="submit" class="btn text-white bg-primary mt-3 mb-3"><i class="bi bi-heart"></i>  Ajouter aux favoris</button>
</div>

<div class="col-6 text-center">
<button type="submit" class="btn text-white bg-primary mt-3 mb-3"><i class="bi bi-envelope"></i>  Contacter le vendeur</button>
</div>

</div>

</div>

</div>
</div>

<?php require 'views/footer.php'; ?>

  </div>


  <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
  </script>

</body>

</html>