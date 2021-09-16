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
                                <input type="text" class="form-control box" id="lastName" name="lastName" maxlength="20" value="<?= $_POST['lastName'] ?? $user['USER_LASTNAME'] ?>">
                                <span id="messageInfosName"></span>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-sm-5">
                                <label class="form-label mt-2 d-flex justify-content-start"> Prénom :</label>
                                <input type="text" class="form-control box" id="firstName" name="firstName" maxlength="20" value="<?= $_POST['firstName'] ?? $user['USER_FIRSTNAME'] ?>">
                                <span id="messageInfosFirstName"></span>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-sm-5">
                                <label class="form-label mt-2 d-flex justify-content-start"> Adresse email :</label>
                                <input type="text" class="form-control box" id="mail" name="mail" maxlength="30" value="<?= $_POST['mail'] ?? $user['USER_EMAIL'] ?>">
                                <span id="messageInfosEmail" name="occupedEmail"></span>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-sm-5">
                                <label class="form-label mt-2 d-flex justify-content-start"> Ville :</label>
                                <input type="text" class="form-control box" id="city" name="city" maxlength="20" value="<?= $_POST['city'] ?? $user['USER_CITY'] ?>">
                                <span id="messageInfosCity"></span>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-sm-5">
                                <label class="form-label mt-2 d-flex justify-content-start"> Code postale :</label>
                                <input type="text" class="form-control box" id="zipCode" name="zipCode" maxlength="6" value="<?= $_POST['zipCode'] ?? $user['USER_ZIPCODE'] ?>">
                                <span id="messageInfosPostalCode"></span>
                            </div>
                        </div>
                <?php }
                } ?>

                <div class="row justify-content-center">
                    <div class="col-sm-3d-flex justify-content-center">
                        <button type="submit" name="validModify" class="btn btnConnect mt-5 mb-3">Valider les modifications</button>
            </form>

        </div>
    </div>
</div>


<!-- Modal --------------------------------------------------->


<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" method="POST">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Veuillez taper votre mot de passe pour confirmer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label for="message-text" class="col-form-label">Mot de passe:</label>
                    <input class="form-control" id="message-text" type="password" name="password"></input>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="submit" class="btn btnConnect" name="validModifyPwd">Valider</button>
            </div>
            <input type="hidden" name="lastName" value="<?= $_POST['lastName'] ?>">
            <input type="hidden" name="firstName" value="<?= $_POST['firstName'] ?>">
            <input type="hidden" name="mail" value="<?= $_POST['mail'] ?>">
            <input type="hidden" name="city" value="<?= $_POST['city'] ?>">
            <input type="hidden" name="zipCode" value="<?= $_POST['zipCode'] ?>">
        </form>
    </div>

</div>




<?php require 'views/footer.php'; ?>


<script type="text/javascript" src="/assets/js/scriptCountModify.js"></script>


<script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
</script>

<script>
    var myModal = new bootstrap.Modal(document.getElementById('exampleModal'), {
        keyboard: false
    })

    <?php

    if (isset($_POST['validModify']) && $emptyModifUser == 0) { ?>
        myModal.show()
    <?php }
    ?>
</script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<?php
//après avoir validé les modif tu confirme que c'est ok
if (isset($_POST['validModifyPwd'])) { ?>

    <script>
        Swal.fire({
            title: "<?= $titleSweet ?>",
            text: "<?= $textSweet ?>",
            icon: "<?= $iconSweet ?>",
            confirmButtonColor: '#000'
        }) <?= $redirectionSweet ?>;
    </script>

<?php } ?>



</body>

</html>