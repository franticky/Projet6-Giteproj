    <?php //appel du fichier Gites classe
        require_once "modeles/gites.php";
        require_once "modeles/categories.php";
        require_once "modeles/Departements.php";
        require_once "modeles/Commentaires.php";

            $giteClasse = new Gites(); //instance: copie de la classe stockée dans une variable
            $departementsClasse = new Departement();
            $categorieClasse = new Categories();
            $commentairesCLasse = new Commentaires();

            $details = $giteClasse->getGiteById(); //appel de la methode getGiteById()
            $categories = $categorieClasse->getCategories();
            $departements = $departementsClasse->getDepartement();
            $commentaires = $commentairesCLasse->getComments();
    ?>
    <h1 class="site-heading text-center text-faded d-none d-lg-block">
        <span class="site-heading-upper text-primary mb-3">
            Details du gite
        </span>
    </h1>

<!-- Navigation-->
<nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
    <div class="container">

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mx-auto">
                <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="index.html">Accueil</a></li>
                <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="reservations?idgite=<?=$details['id_gite']?>">Reserver</a></li>
            </ul>
        </div>
    </div>
</nav>
<section class="page-section about-heading">
    <div class="container">
        <img class="img-fluid rounded about-heading-img mb-3 mb-lg-0" src="<?= $details['photo_gite']?>" alt="<?= $details['photo_gite'] ?>" />
        <div class="about-heading-content">
            <div class="row">
                <div class="col-xl-9 col-lg-10 mx-auto">
                    <div class="bg-faded rounded p-5">
                        <h2 class="section-heading mb-4">
                            <span class="site-heading-lower"><?= $details['nom_gite']?></span>
                            <span class="section-heading-lower"><?= $details['departement_gite']?></span>
                            <span class="section-heading-lower"><?= $details['surface_gite']?></span>
                            <span class="section-heading-lower"><?= $details['tarif_gite']?></span>
                            <span class="section-heading-lower"><?= $details['gite_categorie']?></span>
                            <span class="section-heading-lower"><?= $details['commentaire_id']?></span>
                            <span class="section-heading-lower"><?= $details['oqp_gite']?></span>
                            <span class="section-heading-lower"><?= $details['datedepart']?></span>
                        </h2>
                        <p><?= $details['description_gite']?></p>

                    <!--COMMENTS-->
                        <h4 class="text-success">Retours des membres </h4>
                        <ul>

                        <?php
                            foreach($commentaires as $alias) {
                                ?>

                                <li class="list-group-item"></li>
                                <li class="list-group-item"><b class="text-info"><?= $alias['auteur_commentaire'] ?></b></li>
                                <li class="list-group-item">: <b class="text-info"><?= $alias['contenus_commentaire'] ?></b></li>

                                <?php
                            }
                        ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    ///////uPDATE form toggle//////au clic sur le bouton update: on passe du formulaire au details du gite/////////
                //Stock des attributs id html dans des variables
    let btnUpdateGite = document.getElementById("bntUpdate");
    let updateForm = document.getElementById("update-form");
    let blockGiteId = document.getElementById("gite-by-id");

//au click sur le bouton, update
btnUpdateGite.addEventListener("click", () => {
    console.log("test de click");
    updateForm.classList.toggle("show"); //ajout /retraction de la class css.show
    blockGiteId.classList.toggle("show"); //element.classList.contains(className):

if(updateForm.classList.contains("show")){    //si le formulaire à la classe css.show
 btnUpdateGite.style.backgroundColor = "#789456";
 btnUpdateGite.style.border = "none";
 btnUpdateGite.innerHTML = "afficher les details";
}else {
    btnUpdateGite.style.backgroundColor = "orange";
    btnUpdateGite.inerHTML = "afficher le formulaire";
    btnUpdateGite.style.border = "none";
    }
})
</script>

<footer class="footer text-faded text-center py-5">
    <div class="container">
        <p class="m-0 small">
            2022
        </p>
    </div>
</footer>
<!-- Bootstrap core JS-->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js">

</script>
<!-- Core theme JS-->
<script src="js/scripts.js"></script>
</body>
</html>
