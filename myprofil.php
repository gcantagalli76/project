<?php require 'views/header.php';

require './controllers/controller.php';

?>

<div class="container-fluid centerPage text-center">

    <div class="col justify-content-center">
        <div class="col-sm-6 border shadowblock">
            <h1 class="text-center">Modifier mon profil</h1>

            <form action="" method="post">
                <?php foreach ($displayUserArray as $user) {
                    if ($_SESSION['userId'] == $user['USER_ID']) { ?>
                        <div class="row justify-content-center">
                            <div class="col-sm-5">
                                <label class="form-label mt-3 d-flex justify-content-start"> Nom :</label>
                                <input type="text" class="form-control box" id="lastName" name="lastName" maxlength="20" value="<?= $user['USER_LASTNAME'] ?>">
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-sm-5">
                                <label class="form-label mt-2 d-flex justify-content-start"> Prénom :</label>
                                <input type="text" class="form-control box" id="firstName" name="firstName" maxlength="20" value="<?= $user['USER_FIRSTNAME'] ?>">
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-sm-5">
                                <label class="form-label mt-2 d-flex justify-content-start"> Adresse email :</label>
                                <input type="text" class="form-control box" id="mail" name="mail" maxlength="30" value="<?= $user['USER_EMAIL'] ?>">
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-sm-5">
                                <label class="form-label mt-2 d-flex justify-content-start"> Ville :</label>
                                <input type="text" class="form-control box" id="city" name="city" maxlength="20" value="<?= $user['USER_CITY'] ?>">
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-sm-5">
                                <label class="form-label mt-2 d-flex justify-content-start"> Code postale :</label>
                                <input type="text" class="form-control box" id="zipCode" name="zipCode" maxlength="6" value="<?= $user['USER_ZIPCODE'] ?>">
                            </div>
                        </div>
                <?php }
                } ?>

                <div class="row justify-content-center">
                    <div class="col-sm-3d-flex justify-content-center">
                        <button type="submit" class="btn btnConnect mt-5 mb-3" id='validModify' name="validModify">Valider les modifications</button>


            </form>

        </div>
    </div>
</div>

<?php require 'views/footer.php'; ?>


<script type="text/javascript" src="/assets/js/script.js"></script>

<script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
</script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<?php
//après avoir validé les modif tu confirme que c'est ok
if (isset($_POST['validModify'])) { ?>

    <script>
        Swal.fire({
            title: "<?= $titleSweet ?>",
            text: "<?= $textSweet ?>",
            icon: "<?= $iconSweet ?>",
            confirmButtonColor: '#000'
        }).then(function() {
            window.location = "<?= $redirectionSweet ?>";
        });
    </script>

<?php } ?>



</body>

</html>