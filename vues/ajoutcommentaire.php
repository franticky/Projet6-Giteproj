<?php
require_once "modeles/Commentaires.php"; //appel de la classe commentaires

$commentaireClasse = new Commentaires(); //instance (copie) de la classe stockee dans une variable
?>

<div class="container">
    <form method="post">

        <h4 class="text-success">
                ajouter un commentaire
        </h4>
        <?php
      $email = $_SESSION['email_user'];  //stock de l email de l utilisateur connecté dans une variable
        $id = $_GET['id_gite'];
        ?>

        <div class="mb-3">
            <input type="email" value="<?= $email ?>" class="form-control" name="auteur_commentaire" placeholder="<?= $email ?>">
                        <!--par defaut la valeur de ce champ (et le placeholder) est = a la $_SESSION['email_user']-->
        </div>

        <div class="form-group">
            <label for="contenus_commentaire">
                commentaire:
            </label>

            <textarea class="form-control" id="contenus_commentaire" name="contenus_commentaire" rows="5">
            </textarea>
        </div>

            <!--ce champ est caché et prend par defaut l id du gite-->
            <div class="mb-3">
                <input type="hidden" name="gite_id" value="<?= $id ?>">
            </div>

            <button type="submit" name="btn-add-comment" class="btn btn-outline-success">
                    ajout de commentaire
            </button>

    </form>
</div>

<?php
//on recupere l'attribut name du bouton et au clic, on appele la methode addComments() de la classe Commentaires
    if(isset($_POST['btn-add-comment'])){
        $commentaireClasse->addComments();
    }