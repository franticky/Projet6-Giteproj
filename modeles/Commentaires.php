<?php
require_once "modeles/database.php";

class Commentaires extends database {

        private $auteur_comment; //private vars
        private $contenu_comment;
        private $gites_id;

    function getComments(){

        $db = $this->getPDO(); //RECUPERATION DE LA CONNEXION A LA BASE DE DONNEES via la classe mere Database

            $sql = "SELECT * FROM commentaires WHERE gite_id = ?"; //selection des commentaires filtrés par la clef primaire du gite recuperee dans l url

        $id = $_GET['idgite']; //recuperation de l id dans l url

                    $req = $db->prepare($sql);
                        $req->bindParam(1, $id);
                            $req->execute();
                                return $req;
    }

        function addComments(){
      $db = $this->getPDO();  //connexion a la base de donnees via la methode getPDO de la classe mere Database
        if(isset($_POST['auteur_commentaire'])){$this->auteur_comment = trim(htmlspecialchars($_POST['auteur_commentaire']));
        }else{
            echo "<div class='text-center'><p>Erreur, merci de rentrer votre nom ou email !</p></div>";
        }

        if(isset($_POST['contenus_commentaire'])){
            $this->contenu_comment = trim(htmlspecialchars($_POST['contenus_commentaire']));
        }else{
            echo "<p class='alert-danger p-2'>Merci de remplir le champ contenu du commentaire</p>";
        }
            if(isset($_POST['gites_id']) && !empty($_POST['gites_id'])){
                $this->gites_id = $_POST['gites_id'];
            }else{
                    echo "<p class='alert-danger p-2'>Merci de remplir le champs !</p>";
            }

            $sql = "INSERT INTO commentaires (`auteur_commentaire`, `contenus_commentaire`, `gite_id`) VALUES (?,?,?)";  //requete d insertion
                $insert = $db->prepare($sql); //la requete preparee lutte contre les injections sql

            $insert->bindParam(1, $this->auteur_comment);  //Liage des champs du formulaire au parametre de la requete sql champs = ?,?,?
                $insert->bindParam(2, $this->contenu_comment);
                    $insert->bindParam(3, $this->gites_id);

                    $comment = $insert->execute(array(
                        $this->auteur_comment,
                            $this->contenu_comment,
                            $this->gites_id
                    ));
                        $id = $_GET['id_gite']; //pour la redirection, on recupere l id du git dans l url

            if($comment){
                header("Location: details_gite&id_gite=$id");

            }else{
                echo "erreur"; //sinon erreurs & debug
                var_dump($this->auteur_comment);
                var_dump($this->contenu_comment);
                var_dump($this->gites_id);
            }
    }
}