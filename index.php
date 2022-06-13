<?php
session_start();
/* ob_start() demarre la temporisation de sortie
tant qu elle est enclenchee, aucune donnee hormis les entetes n est transmise au nav, mais mise en tampon*/
ob_start();


if(isset($_GET['url'])){ //les options passées dans l url. Si dans l url, un parametre $_GET['url'] existe, comme index.php?url="qqch"
    $url = $_GET['url'];
        }else{
    $url = "accueil";
}


if($url === ""){ //Si $url retourne une chaine de characters vide
    //on redirige vers la page d accueil
        $url = "accueil";
}


if($url === "accueil"){ //liste des routes: accueil = vues/accueil.php, si la route $url = index.php?url=accueil
        $title = "Accueil";
        //appeler le fichier accueil.php
        require_once "vues/accueil.php";

    }elseif ($url === "connexion"){ //si la route $url: index.php?url=connexion
        $title = "Connexion";
        require_once "vues/connexion.php";

    }elseif ($url === "deconnexion"){ //si la route $url: index.php?url=deconnexion
        $title = "deconnexion"; //on appele le fichier deconnexion.php
        require_once "vues/deconnexion.php";

    }elseif ($url === "details"){            ///////////////////////////////////////////details////////////////////////////////////////////
    $title = "Details";
        require_once "vues/detailsgites.php";

}elseif ($url === "inscription"){              //////////////////////////////////////INSCRIPTION USERS ///////////////////////////////////////////
    $title = "Inscription";
    require_once "vues/inscription.php";

} elseif ($url === "editgite" && isset($_SESSION['connecter_admin']) && $_SESSION['connecter_admin'] === true){  ////////////////edit  ///////////////////////////////////////////
    $title = "Edit";
    require_once "vues/editgite.php";

}elseif ($url === "membres"  && isset($_SESSION['connecter_admin']) && $_SESSION['connecter_admin'] === true){ ///////suppression de gite ///////////////////////////////////////////
    $title = "Membres";
    require_once "vues/membres.php";




}elseif ($url === "ajout"  && isset($_SESSION['connecter_admin']) && $_SESSION['connecter_admin'] === true){  /////////ajout de gite ///////////////////////////////////////////
    $title = "Ajout";
    require_once "vues/ajoutdegite.php";

}elseif ($url === "supprimergite"  && isset($_SESSION['connecter_admin']) && $_SESSION['connecter_admin'] === true){ ///////suppression de gite ///////////////////////////////////////////
    $title = "Supprimergite";
    require_once "vues/supprimergite.php";


}elseif ($url === "administration" && isset($_SESSION['connecter_admin']) && $_SESSION['connecter_admin'] === true) { //si la route $url: index.php?url=administration et on est connecté en tant qu admin
    $title = "Administration";
    require_once "vues/administration.php";
}
//page reservation
elseif($url === "reservations" && isset($_GET['idgite']) && $_GET['idgite'] > 0 ){
    require_once "vues/reservations.php";


}elseif($url != '#:[\w]#'){ //si $url est different de tableau de valeurs [#:0-9A-Za-z] soit index.php?url=NON VALIDE, on effectue une redirection
header("Location: accueil");  //on redirige vers la page d accueil
}


/*
ob_get_clean - lit le contenu du courant tampon & l'efface ici, $content se trouve dans le dossier template.php
*/
$content = ob_get_clean();
require_once "template.php";

