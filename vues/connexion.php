<?php

require_once "modeles/Utilisateurs.php"; //appel des fichier des 2 classes
require_once "modeles/Administration.php";

$adminClasse = new Administration(); //instance de la classe Admin
$userClasse = new Utilisateurs(); //instance de la classe Utilisateurs

?>
<h3 class="text-danger">
    vous etes:
</h3>
<span>
    <a class="btn btn-outline-secondary" id="toggle-admin">
        administrateur
    </a>
    <a class="btn btn-outline-info" id="toggle-user">
        client
    </a>
</span>
<div id="form-admin">




        <h2 class="mt-2 text-center text-warning">
            connexion a l espace admin
        </h2>

        <form method="post">
            <div class="form-group" >
                <label for="exampleInputEmail1"></label>
                <input type="email" name="email_admin" class="form-control" id="exampleInputEmail1" placeholder="mel">
            </div>
            <div class="form-group" >
                <label for="exampleInputPassword1"></label>
                <input type="password" name="password_admin" class="form-control" id="exampleInputPassword1" placeholder="Passe">
            </div>
        <button name="btn_valid_admin" type="submit" class="btn btn-primary" >
            Connexion
        </button>

        </form>

    <?php //au clic on appel la methode de connexion de la classe administrateur
        if(isset($_POST['btn_valid_admin'])){
            $adminClasse->connexionAdmin();
            var_dump($_POST['email_admin']);
            var_dump($_POST['password_admin']);
        }

    ?>
</div>

<!------------------------------------------------ utilisateur ---------------------------------->
<div id="form-user">


        <h1 class="text-center text-secondary">
            connexion a votre espace client
        </h1>

        <form method="post">
            <div class="form-group">
                <label for="exampleInputEmail1">
                    email
                </label>
                <input type="email" name="mel_user" class="form-control" id="exampleInputEmail1" placeholder="mel">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">
                    Password
                </label>
                <input type="password" name="passe_user" class="form-control" id="exampleInputPassword1" placeholder="passe">
            </div>
                <button name="btn_valid_user" type="submit" class="btn btn-secondary">
                    CONNEXION
                </button><!--ce bouton est recupéré via son attribut name & methode post $_POST['btn_valid_user']-->
        </form>

        <?php //au clic on appele la methode de connexion de la classe utilisateur
            if(isset($_POST['btn_valid_user'])){
                $userClasse->connexionUtilisateur();
            }


        ?>
</div>

<script>/*
    //acces au DOM et on stocke les elements grace a leurs id
    let btnAdminForm = document.getElementById("toggle-admin");
    let btnUserForm = document.getElementById("toggle-user");

    //recuperation des 2 formulaires
    let formAdmin = document.getElementById("form-admin");
    let userForm = document.getElementById("form-user");

    //evenement au click
    btnAdminForm.addEventListener("click", () => {
        formAdmin.classList.toggle("show");
    });
    btnUserForm.addEventListener("click", () => {
        userForm.classList.toggle("show");
    });*/
</script>