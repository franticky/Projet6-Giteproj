<?php

require_once "modeles/database.php";  //appel de la classe mere database.php, pour acceder a la methode getPDO()
//Gites herite de la classe mere database & toutes ses proprietes (variables) et methodes (fonctions) elle sont accessibles depuis la CLasse Gites
//php strict à typer
/*declare(strict_types=1);*/

class Gites extends Database {


    //propriete = variables
    private $id_gite;
    private $nom_gite;
    private $description_gite;
    private $photo_gite;
    private $tarif_gite;
    private $chambres_gite;
    private $departement_gite;
    private $oqp_gite;
    private $datedarrivee;
    private $datedepart;
    private $gite_categorie;
    private $commentaire_id;
    private $gite_zone;
    private $surface_gite;

    //private $commentaire_id;

    public function getGites()
    { //cette methode recupere tous les gites de la table
        $db = $this->getPDO(); //appel de la methode getPDO de la classe MERE Database.php
        $sql = "SELECT * FROM liste_gite
INNER JOIN categories ON liste_gite.gite_categorie = categories.id_categories
INNER JOIN departement ON liste_gite.gite_zone = departement.departement_id";
        $gites = $db->query($sql); //on stocke le resultat dans une variable
        return $gites; //la fonction getGites() retourne un tableau
    }

    /*Afficher les gites par ID*/
    public function getGiteByID()
    { //recuperation de la connexion depuis la methode getPDO de la classe
        $db = $this->getPDO(); //appel de la methode getPDO de la classe MERE Database.php; la connexion a PDO est stockee dans une variable
        $sql = "SELECT * FROM liste_gite
INNER JOIN categories ON liste_gite.gite_categorie = categories.id_categories
INNER JOIN departement ON liste_gite.gite_zone = departement_id
INNER JOIN commentaires ON liste_gite.commentaire_id = commentaires.id_commentaire WHERE liste_gite.id_gite = ?";

        $request = $db->prepare($sql);
        $id = $_GET['idgite']; //recuperation de l'id du gite passée dans l'url de la page d administration grace a la superglobale $_GET['']
        $request->bindParam(1, $id);  //on lie ID recupéré grace a la requete SQL
        $request->execute(); //requete executée
        $details = $request->fetch(); //fetch recupères la ligne suivante d un jeu de resultats PDO execute() et stockee dans uen variable
        return $details;
    }

    public function setGites()
    { //verification des champs du formulaire, qu'ils existent & ne sont pas vide, assignation des $_POST[] = attribut HTML name="" au proprietes privees (variables)

        if (isset($_POST['nom_gite']) && !empty($_POST['nom_gite'])) {
            $this->nom_gite = trim(htmlspecialchars($_POST['nom_gite']));

        } else {
            echo "il faut remplir le champ";
            var_dump($_POST['nom_gite']);
        }

        //LA DESCRITPION
        if (isset($_POST['description_gite'])) {
            $this->description_gite = trim(htmlspecialchars($_POST['description_gite']));
        } else {
            echo "<p class='alert-danger p-2'>vous etes pries de remplir le champ de description du gite</p>";
        }

        //upload de photo
        if (isset($_FILES['photo_gite'])) {
            $dossierDestination = "assets/img/";
            $photo_gite = $dossierDestination . basename($_FILES['photo_gite']['name']);
            $_POST['photo_gite'] = $photo_gite;
            if (move_uploaded_file($_FILES['photo_gite']['tmp_name'], $photo_gite)) {
                echo '<p class="alert alert-success"> fichier  valide et téléchargé </p>';
            } else {
                echo '<p class="alert-danger"> erreur, fichier invalide !</p>';
            }
        }

        //Postage de l image
        if (isset($_POST['photo_gite'])) {
            $this->photo_gite = $_POST['photo_gite'];
        } else {
            echo "<p class='alert-warning p-2'>remplir le champ image du gite est primordial</p>";
        }

        //chambres
        if (isset($_POST['chambres_gite'])) {
            $this->chambres_gite = $_POST['chambres_gite'];
        }

        //Departements
        if (isset($_POST['departement_gite'])) {
            $this->departement_gite = $_POST['departement_gite'];
        } else {
            echo "<p class='alert-danger p-2'>Merci de remplir le champ dptmt</p>";
        }

        //tarifs
        if (isset($_POST['tarif_gite'])) {
            $this->tarif_gite = $_POST['tarif_gite'];
        } else {
            echo "<p class='alert-danger p-2'> remplir le champ tarif</p>";
        }

        //booleen
        if (isset($_POST['oqp_gite'])) {
            $this->oqp_gite = $_POST['oqp_gite'];
        } else {
            echo "<p class='alert-danger p-2'>Merci de remplir le champ oqp</p>";
        }

        //surface
        if (isset($_POST['surface_gite'])) {
            $this->surface_gite = $_POST['surface_gite'];
        }else {
            echo "<p class='alert-danger p-2'>Merci de remplir le champ surface</p>";
        }

        //date darrivee
        if (isset($_POST['datedarrivee'])) {
            $this->datedarrivee = $_POST['datedarrivee'];
        } else {
            echo "<p class='alert-danger p-2'>Merci de remplir le champ arrivee</p>";
        }

        //date de depart
        if (isset($_POST['datedepart'])) {
            $this->datedepart = $_POST['datedepart'];
        } else {
            echo "<p class='alert-danger p-2'>Merci de remplir le champ depart</p>";
        }

        //clef etrangere gite categorie
        if (isset($_POST['gite_categorie'])) {
            $this->gite_categorie = $_POST['gite_categorie'];
        } else {
            echo "<p class='alert-danger p-2'>Merci de remplir le champ catego</p>";
        }


        //verifier que la date d arrivee n est pas superieure a la date de depart
        if (isset($this->datedepart) > isset($this->datedarrivee)) {
            echo "<p class='alert-danger p-2'>l arrivee ne peut etre superieure au depart </p>";
        }


        //connexion a PDO , requete SQL , requete preparee & execution

        $db = $this->getPDO(); //connexion depuis la methode PDO de la classe mere
        /*requete SQL*/
        $sql = "INSERT INTO `liste_gite`(`nom_gite`, `chambres_gite`, `departement_gite`, `photo_gite`, `description_gite`, `tarif_gite`, `surface_gite`, `oqp_gite`, `datedarrivee`, `datedepart`, `gite_categorie`) VALUES (?,?,?,?,?,?,?,?,?,?,?)";
        $insert = $db->prepare($sql);  //contre les injections sql
        /*liage des 13champs du formulaire a la requete sql*/
        $insert->bindParam(1, $this->nom_gite);
        $insert->bindParam(2, $this->chambres_gite);
        $insert->bindParam(3, $this->departement_gite);
        $insert->bindParam(4, $this->photo_gite);
        $insert->bindParam(5, $this->description_gite);
        $insert->bindParam(6, $this->tarif_gite);
        $insert->bindParam(7, $this->surface_gite);
        $insert->bindParam(8, $this->oqp_gite);
        $insert->bindParam(9, $this->datedarrivee);
        $insert->bindParam(10, $this->datedepart);
        $insert->bindParam(11, $this->gite_categorie);

        $res = $insert->execute(array(

            $this->nom_gite,
            $this->chambres_gite,
            $this->departement_gite,
            $this->photo_gite,
            $this->description_gite,
            $this->tarif_gite,
            $this->surface_gite,
            $this->oqp_gite,
            $this->datedarrivee,
            $this->datedepart,
            $this->gite_categorie

        ));
        var_dump($res);


//si l'execution fonctionne on fait une redirection sur une page sinon on affiche une erreur
        if ($res) {
            header("Location: accueil");
        } else {
            echo "<p class='alert alert-danger p-3'>erreur</p>";
        }

    }

//supprimer gite-----------------------------------------------------------------------------------------
    function deleteGite()
    {
        //recuperation de la connexion depuis la methode getPDO de la classe mere
        $db = $this->getPDO();
        //recuperation de l'id du gite depuis URL(<a href=detail_gite?id_gite=CLE PRIMAIRE></a>)
        $id = $_GET['idgite'];
        //requete SQL
        $sql = "DELETE FROM liste_gite WHERE id_gite = ?";
        //la requte preparee pour lutter contre les injections SQL
        $req = $db->prepare($sql);
        //liage de l'ID de l'URL & donc de la clef primaire, à la requete sql
        $req->bindParam(1, $id);
        //requete executee
        $req->execute();
        //ca marche: redirection vers une page, sinon "erreur"
        if ($req) {
            header("Location:accueil");
        } else {
            echo "<p class='alert-warning p-2 text-left'> erreur survenue </p>";
        }
    }




//mettre a jour un gite--------------------------------------------------------------------------------
    function updateGite()
    {
        //recuperation de la connexion a la base de donnee via la methode getPDO de la  classe mere
        $db = $this->getPDO();
        //on verifie que tous les champs du formulaires existent et ne sont pas vide, on assigne les $_POST[] = attribut HTML name="" au proprietes privees (variables)
        if (isset($_POST['nom_gite'])) {
            $this->nom_gite = trim(htmlspecialchars($_POST['nom_gite']));
        } else {
            echo "<p class='alert-warning p-2'>nom?</p>";
        }


        //la description
        if (isset($_POST['description_gite'])) {
            $this->description_gite = trim(htmlspecialchars($_POST['description_gite']));
        } else {
            echo "<p class='alert-warning p-2'>décrivez</p>";
        }

//upload d image
        if (isset($_FILES['photo_gite'])) {
            $dossierDestination = "asset/img/";
            $photo_gite = $dossierDestination . basename($_FILES['photo_gite']['name']);
            $_POST['photo_gite'] = $photo_gite;
            if (move_uploaded_file($_FILES['photo_gite']['tmp_name'], $photo_gite)) {
                echo "<p class='alert-warning'>fichier valide & téléchargé</p>";
            } else {
                echo "<p class='alert-warning'> fichier invalide</p>";
            }
        }

//postage de l'image
        if (isset($_POST['photo_gite'])) {
            $this->photo_gite = $_POST['photo_gite'];
        } else {
            echo "<p class='alert-warning'>erreur fichier invalide</p>";
        }

//nombre de chambres
        if (isset($_POST['chambres_gite'])) {
            $this->chambres_gite = $_POST['chambres_gite'];
        } else {
            echo "<p class='alert-warning' p-2> combien de chambres</p>";
        };

//tarif
        if (isset($_POST['tarif_gite'])) {
            $this->tarif = $_POST['tarif_gite'];
        } else {
            echo "<p class='alert-warning' p-2> tarif?</p>";
        }

//disponibilité
        if (isset($_POST['oqp_gite'])) {
            $this->oqp_gite = $_POST['oqp_gite'];
        } else {
            echo "<p class='alert-warning' p-2> oqp?</p>";
        }

//date de depart
        if (isset($_POST['datedepart'])) {
            $this->datedepart = $_POST['datedepart'];
        } else {
            echo "<p class='alert-warning' p-2> depart? </p>";
        }

//la clef étrangère 'gite categorie' de la table "liste_gite" lie celle ci a la table "categories" & donc toutes la structure d une table liée via clef etranger est requetable

        if (isset($_POST['type_gite'])) {
            $this->type_gite = $_POST['type_gite'];
        } else {
            echo "<p class='alert-warning' p-2> type? </p>";
        }

        //gite
        if (isset($_POST['datedarrivee'])) {
            $this->datedarrivee = $_POST['datedarrivee'];
        } else {
            echo "<p class='alert-warning' p-2> arrivee? </p>";
        }

//les commentaires sont des champs cachés avec des valeurs par defaut
        if (isset($_POST['commentaires'])) {
            $this->commentaires_id = $_POST['commentaires'];
        } else {
            echo "<p class='alert-warning' p-2> commentaires? </p>";
        }

//verifier que la date d'arrivee n'est pas superieure a la date de depart
        if (isset($this->datedepart) > isset($this->datedarrivee)) {
            echo "<p class='alert-warning' p-2> arrivee>depart!! </p>";
        }

        $sql = "UPDATE liste_gite SET nom_gite = ?, chambres_gite = ?,departement_gite = ?, photo_gite = ?,
description_gite = ?,
tarif_gite = ?,
surface_gite = ?,
oqp_gite = ?,
datedarrivee = ?,
datedepart = ?,
gite_categorie = ?, commentaire_id = ?,
WHERE id_gite = ?";

//recuperation de la clef primaire dans l'url via la super globale _GET[''], <a href="details_gite?id_gite=CLEF PRIMAIRE DU GITE>plus d infos</a>"
        $id = $_GET['idgite'];
        $req = $db->prepare($sql);
        $req->bindParam(1, $this->nom_gite);
        $req->bindParam(2, $this->description_gite);
        $req->bindParam(3, $this->photo_gite);
        $req->bindParam(4, $this->tarif_gite);
        $req->bindParam(5, $this->datedarrivee);
        $req->bindParam(6, $this->datedepart);
        $req->bindParam(7, $this->gite_categorie);
        $req->bindParam(8, $this->commentaire_id);
        $req->bindParam(9, $this->departement_gite);
        $req->bindParam(10, $this->chambres_gite);
        $req->bindParam(11, $this->surface_gite);
        $req->bindParam(12, $this->oqp_gite);

        $updateGite = $req->execute(array(
            $this->nom_gite,
            $this->description_gite,
            $this->photo_gite,
            $this->tarif_gite,
            $this->datedarrivee,
            $this->datedepart,
            $this->gite_categorie,
            $this->commentaire_id,
            $this->departement_gite,
            $this->chambres_gite,
            $this->surface_gite,
            $this->oqp_gite,
            $id,
        ));

        if ($updateGite) {
            header("Location: accueil");
        } else {
            echo "<p class='alert-warning' p-2>remplissez les champs</p>";
        }
    }

//disponibilité----------------------------------------------------------------
    function getGiteDisponible()
    { //recuperation de la date du jour grace a php date(), il en retourne une date sous forme de chaine, au format etabli par le parametre format
        //fournie par le parametre timestamp ou la date et l heure courantes, si aucun timestamp n est fourni.
        //en d autres termes, le parametre timestamp est optionel et vaut par defaut la valeur de la fonction time()
        $today = date('Y-m-d');
        $db = $this->getPDO(); //la connexion a la base de dionnee vie la classe mere databse
        //requete selection + jointure & prediquat WHERE filtre les gites par date & cooleen disponible = true
        $sql = "SELECT * FROM liste_gite
                INNER JOIN categories ON liste_gite.gite_categorie = categories.id_categories
                WHERE datedepart < '".$today."' AND oqp_gite = 1";
        //parcours de la table liste_gite filtrée
        $disponible = $db->query($sql);
        return $disponible;
    }


    function getGiteIndisponible()
    { //requete de selection inverse avec jointure & date du jour < date de depart
        $today = date('Y-m-d');
        $db = $this->getPDO(); //la connexion via la classe mère database
        $sql = "SELECT * FROM liste_gite
                INNER JOIN categories ON liste_gite.gite_categorie = categories.id_categories
                WHERE datedepart > '".$today."' AND oqp_gite = 1";
        //parcours de la table gites phpmyadmin filtrees
        $indisponible = $db->query($sql);
        return $indisponible;
    }
//rechereche gite/////////////////////////////////////////////
function searchGiteByName(){
        $db = $this->getPDO();
    $today = date("Y-m-d");        //stocker la date du jour
   if(isset($_POST['recherche'])) { //recuperation de l input de recherche
       $recherche = $_POST['recherche'];
   }else{
       $recherche = "";
        if(empty($recherche)){
            echo "<p class='alert-warning mt-2 p-2'>recherchez un truc</p>";

        }
   }
   $sql = "SELECT * FORM liste_gite 
   INNER JOIN categories ON liste_gite.gite_categorie = categories.id_categories
   INNER JOIN departement ON liste_gite.gite_zone = departement.departement_id 
   WHERE nom_gite LIKE '%$recherche%' OR description_gite LIKE '%$recherche%'
   OR tarif_gite LIKE '%$recherche%' OR gite_categorries LIKE '%$recherche%' AND datedepart < '".$today."' AND oqp = 1";

        $search = $db->query($sql);  //parcours des requltats
    var_dump($search);
}

    //fermeture de la classe
}