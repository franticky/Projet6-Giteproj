<?php
require_once "modeles/gites.php";
$giteClass = new Gites();
if(isset($_POST["btnvalider"])){
    $giteClass->deleteGite();
}

?>
<div class="m-3 alert alert-warning text-left">
    <h2 class="text-white m-3 bg-black">
    gite supprimé
    </h2>
</div>
<form method="POST">
<button name="btnvalider">confirmer suppression</button>
</form>
<a href="accueil" class="m-3 btn btn-info">
    retour
</a>