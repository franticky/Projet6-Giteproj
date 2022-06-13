<?php
//appel du fichier de la classe gites.php
require_once "modeles/gites.php";

//instance de la classe gites = copie de la clasee stockee dans une variable
$gitesClasse = new Gites();
//on stocke dans une seconde variable l'appel a la methode getGites() = le resultat de la requete SQL
$gites = $gitesClasse->getGiteDisponible();  //on stocke dans une seconde variable l'appel a la methode getGiteDisponible() = le resultat de la requete sql,
// cette methode affiche les gites dnt la date de depart > a la date du jour
$gitesIndisponibles = $gitesClasse->getGiteIndisponible(); //debug
//var_dump($gites) ;
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>
        Gites Ube accueil
    </title>
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico"/>
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i"
          rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css?family=Lora:400,400i,700,700i" rel="stylesheet"/>
    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="css/style.css" rel="stylesheet"/>
</head>
<body>
<header>
    <div class="row">

        <h1 class="site-heading text-center text-faded d-none d-lg-block">
        <span class="site-heading-upper text-primary mb-3">
            Bienvenue aux Gites
        </span>
            <span class="site-heading-lower">liste des gites</span>
        </h1>
</header>


<?php
foreach ($gites as $gite) {

    ?> <!--on ferme php ici-->
    <section class="page-section clearfix">
        <div class="container">
            <div class="intro">
                <img class="intro-img img-fluid mb-3 mb-lg-0 rounded" src="<?= $gite ['photo_gite'] ?>"
                     alt="<?= $gite ['photo_gite'] ?>"/>
                <div class="intro-text left-0 text-center bg-faded p-5 rounded">
                    <h2 class="section-heading mb-4">
                        <span class="section-heading-upper"><p class="mb-3"><?= $gite ['nom_gite'] ?><p></span>
                        <span class="section-heading-lower"><p>  <?= $gite ['departement_gite'] ?></p></span>
                    </h2>
                    <p><?= $gite ['description_gite'] ?></p>
                    <p> chambres : <?= $gite ['chambres_gite'] ?></p>
                    <p> surface : <?= $gite ['surface_gite'] ?></p>
                    <p> tarif : <?= $gite ['tarif_gite'] ?></p>
                    <p> date : <?= $gite ['datedepart'] ?></p>
                    <a class="btn btn-primary btn-xl" href="details?idgite=<?= $gite['id_gite'] ?>">details</a>
                    <a class="btn btn-primary btn-xl" href="editgite?idgite=<?= $gite['id_gite'] ?>">editer</a>
                    <a class="btn btn-primary btn-xl" href="supprimergite?idgite=<?= $gite['id_gite'] ?>">supprimer</a>
                </div>
            </div>
        </div>
    </section>
    <?php //on rouvre php là
}

foreach ($gitesIndisponibles as $row) {  //parcours des resultats a l'aide d une boucle for each et un alias pour les gites indisponibles
    //pour les gites indisponible on ajoute un fond rouge, titre & la date de depart bien visible
    ?>

    <section class="page-section clearfix ">
        <div class="container">
            <div class="intro">
                <img class="intro-img img-fluid mb-3 mb-lg-0 rounded " src="<?= $row ['photo_gite'] ?>"
                     alt="<?= $row ['photo_gite'] ?>"/>
                <div class="intro-text left-0 text-center bg-danger p-5 rounded">
                    <h2 class="section-heading mb-4">
                        <span class="section-heading-upper"><p class="mb-3"><?= $row ['nom_gite'] ?><p></span>
                        <span class="section-heading-lower"><p><?= $row ['departement_gite'] ?></p></span>
                    </h2>
                    <p><?= $row ['description_gite'] ?></p>
                    <p> chambres : <?= $row ['chambres_gite'] ?></p>
                    <p> surface : <?= $row ['surface_gite'] ?></p>
                    <p> tarif : <?= $row ['tarif_gite'] ?></p>
                    <p> date : <?= $row ['datedepart'] ?></p>
                    <h4 class="text-warning text-outline-info">INDISPONIBLE</h4>
                    <a class="btn btn-primary btn-xl" href="details?idgite=<?= $row['id_gite'] ?>">details</a>
                    <a class="btn btn-primary btn-xl" href="editgite?idgite=<?= $row['id_gite'] ?>">editer</a>
                    <a class="btn btn-primary btn-xl" href="supprimergite?idgite=<?= $row['id_gite'] ?>">supprimer</a>
                </div>
            </div>
        </div>
    </section>
    <?php
}
?>



