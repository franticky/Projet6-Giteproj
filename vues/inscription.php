<?php

require_once "modeles/Utilisateurs.php";
    $userClasse = new Utilisateurs();
?>

    <div class="text-left">
        <h3>
            Inscription
        </h3>
        <form method= "post">
            <div class="mb-4">
                <label for="email_user" class="text-white">
                    email
                </label>
                    <input class="form-control" type="email" placeholder="email" required name="mel_user" id="email_user">
            </div>

            <div class="mb-4">
                <label for="passe_user" class="text-white">
                    email
                </label>
                <input class="form-control" type="password" placeholder="passe" required name="passe_user" id="password">
            </div>

            <div>
                <label for="passe_user" class="text-white">
                    repetition
                </label>
                <input class="form-control" type="password" placeholder="re-passe" required name="repeat_passe_user" id="password">
            </div>

            <div>
                <button class="btn btn-outline-warning" name="btn-add_user" >

                        Inscription

                </button>

                    <a href="accueil" class="btn btn-danger" >
                        annulation
                    </a>
            </div>
        </form>
    </div>
<?php
if(isset($_POST['btn-add_user'])){
    var_dump("le click ca va, pas l inscription");
        $userClasse->inscriptionUtilisateur();
}
