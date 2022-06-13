<?php

class Database {

    public $host = "localhost"; //declaration de variable(la portee est publique: accessible a linterieur & exterieur de la classe)

    public $dbname = "gite"; //base de donnees phpmyadmin
    public $user = "root";
    public $pass = "";

    //cette fonction(methode) est publique donc accessible a linterieur & a lexterieur de la classe de
    public function getPDO(){
        //essai de connection sinon erreur
            try{//instance de la classe PDO copiee dans la variable $db
                    $db = new PDO('mysql:host='.$this->host. ';dbname='.$this->dbname.";charset=UTF8", $this->user, $this->pass);
                //acces a la methose setAttribute de la classse PDO + options
                //PDO::represente l acces a des methodes statiques: sans instancte de la classe PDO
                    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                        /*echo "<div class='text-center'>
                                    <p class='mt-3 alert alert-success'>
                                        connection reussie
                                    </p>
                                </div>";*/
                return $db; //retourne la propriete (variable) $db qui stocke la connexion a la BDD via la classe PDO pour etre utilisée dans d autres fichiers
                //sinon, erreur: on appele la methode getMessage de la Classe PDOException
            }catch(PDOException $exception){
                    echo "<div class='text-center' >
                            <p class='alert alert-danger'>
                                erreur de connection pdo
                            </p>
                            </div>"  . $exception->getMessage();

                //
            }
            return null; /* a la fin du bloc try-catch, une metode attend un retour. ici, si the try catch ne trouve rien, la fonction retourne null */
            
    }
}