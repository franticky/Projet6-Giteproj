<?php

require_once "modeles/Reservations.php";

$reservationClass = new Reservations();

?>;

//formulaire + email & 2 dates
<form method="post">
    <div class="form-group">
        <label for="exampleInputEmail1">
mel
        </label>
        <input type="email" name="mel_user" class="form-control" id="exampleInputEmail1" placeholder="mel">
    </div>
    <div class="form-group">
        <label for="datedarrivee">
date d'arrivee
        </label>
        <input type="date" name="datedarrivee" class="form-control" placeholder="date d'arrivee">
    </div>

    <div class="form-group">
        <label for="datedepart">
date de depart
        </label>
        <input type="date" name="datedepart" class="form-control" placeholder="date de depart">
    </div>

        <button name="reservationValidation" type="submit" class="btn btn-secondary">
Bonnes vacances
        </button><!--ce bouton est recupéré via son attribut name & methode post $_POST['btn_valid_user']-->

</form>

<?php

if (isset($_POST['reservationValidation'])) {
    $reservationClass->reservationGite();
}
?>
