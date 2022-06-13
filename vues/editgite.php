<?php
require_once "modeles/Categories.php";
require_once "modeles/Departements.php";
require_once "modeles/gites.php";

$categorieCLasse = new Categories();
$departementsClasse = new Departement();
$gitesClasse = new Gites();

$categories = $categorieCLasse->getCategories();
$departements = $departementsClasse->getDepartement();





?>

<div class="container">
    <form method="post" enctype="multipart/form-data">
        <div class="mt-3">
            <label for="nom_gite" class="text-white">
                nom
                </label>
            <input type="text" id="nom_gite" class="form-control" name="nom_gite" placeholder="nom" required>
        </div>

        <div class="mt-3">
            <label for="description_gite" class="text-white">
                description
            </label>
            <textarea type="text" id="description_gite" name="description_gite" class="form-control" placeholder="description" required></textarea>
        </div>

        <div class="mt-3">
            <label  class="text-white" for="categorie">
                categorie
                <select name="gite_categorie" class="form-control" >
                    <?php
                            foreach($categories as $category){
                        ?>
                        <option value="<?= $category['id_categories'] ?>">
                            <?= $category['type_gite'] ?>
                        </option>
                                <?php
                        }
                    ?>
                </select>
            </label>
        </div>

        <div class="form-group">
            <label for="photo_gite" class="text-white">
                photo
            </label>
            <input class="btn btn-outline-primary" id="photo_gite" type="file" name="photo_gite"  accept="img/png, img/jpeg, img/webp img/bmp, img/svg" >
        </div>

        <div class="mt-3">
            <label for="chambres_gite" class="text-white">
                chambres
                <select name="chambres_gite" class="form-control" >
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                    <option value="4">4</option>
                    <option value="5">5</option>
                    <option value="6">6</option>
                    <option value="7">7</option>
                    <option value="8">8</option>
                </select>
            </label>
        </div>

        <div>
            <label for="departement_gite" class="text-white">
                departement
                <select name="departement_gite" class="form-control">
                    <?php
                    foreach($departements as $departement){
                        ?>
                        <option value="<?= $departement['departement_id'] ?>">
                            <?= $departement['departement_nom'] ?>
                        </option> }
                        <?php
                    }
                    ?>
                </select>
            </label>
        </div>

        <div class="mt-3"  >
            <label for="ville" class="text-white">
                ville
                <select name="ville" class="form-control" >
                    <option value="1">grenoble</option>

                </select>
            </label>
        </div>

        <div class="form-group">
            <label for="tarif_gite" class="text-white">
                tarif
            </label>
            <input type="number" id="tarif" step="0.01" name="tarif_gite" id="tarif_gite" class="form-control" placeholder="tarif" >
        </div>

        <div class="form-group">
            <label for="surface_gite" class="text-white">
                surface du gite
            </label>
            <input type="number" id="surface_gite" step="0.01" name="surface_gite" id="surface_gite" class="form-control" placeholder="m2" >
        </div>

        <div class="mt-3">
            <label for="oqp_gite" class="text-white">
                disponibilité
                <select name="oqp_gite" class="form-control" >

                    <option value="0">
                        non
                    </option>
                    <option value="1">
                        oui
                    </option>

                </select>
            </label>

        </div>


        <div class="form-group">
            <label for="datedarrivee" class="text-white">
                date d arrivee
            </label>
            <input name="datedarrivee" class="form-control" placeholder="<?= date('Y-m-d') ?>" value="<?= date('Y-m-d')?>" class="form-control">
        </div>

        <div class="form-group">
            <label for="datedepart" class="text-white">
                date de depart
            </label>
            <input type="date" class="form-control" name="datedepart" id="datedepart" placeholder="<?= date('Y-M-D') ?>" value="<?= date('Y-m-d')?>" required>
        </div>

        <input type="hidden" name="commentaire_id" value="1">
        <button type="submit" name="btn-editer-gite" class="btn btn-outline-primary">
            edition terminée
        </button>
    </form>

    <?php
    if(isset($_POST['btn-editer-gite'])){
        $gitesClasse->updateGite(){;
        var_dump("text click");
    }
    ?>
</div>

