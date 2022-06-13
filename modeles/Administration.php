<?php
//appel du fichier de la classe de connexion gites.php
require_once "modeles/gites.php";

/*la classe Administration herite de la classe gites grace au mot clé "extends"
une class php n'herite que d une seule autre classe. ici, Database est la classe PARENTE & Administrations la classe ENFANT
dans la classe Database, si on passe les proprietes de connexion en PROTECTED => elles seront accessible dans l'ENFANT, Administration*/

class Administration extends gites {
/*les proprietes = variables dans une classe en
Pour les ADMINS*/
/***
 * @var string
 */
private $email_admin;
private $password_admin;

/*connexion a la base de donnees grace a l instance de la classe mere (Database), 
et appel de sa methode publique getPDO() stockée dans dans la variable $db*/
public function connexionAdmin(){

        $db = $this->getPDO();
        if(isset($_POST['email_admin']) && !empty($_POST['email_admin'])){ //verification des champs du formulaires
            //si le champ existe et n est pas vide(dans le DOM, un utilisateur peut supprimer un attribut required des inputs donc on verifie), on continue
            $this->email_admin = trim(htmlspecialchars($_POST['email_admin']));
        }else{
           $this->email_admin= trim(htmlspecialchars($_POST['email_admin']));
        }
        //idem pour le mot de passe
        if(isset($_POST['password_admin']) && !empty($_POST['password_admin'])){
            $this->password_admin = trim(htmlspecialchars($_POST['password_admin']));
        }else{
            $this->password_admin= trim(htmlspecialchars($_POST['password_admin']));
        }

        if(!empty($_POST['email_admin']) && !empty($_POST['password_admin'])){ //si les champs ne sont pas vide
            $sql = "SELECT * FROM admin WHERE email_admin = ? AND password_admin = ?"; //requete de connexion
            $stmt = $db->prepare($sql); //requete preparee

            $stmt->bindParam(1, $this->email_admin); 
            $stmt->bindParam(2, $this->password_admin); 
            $stmt->execute();
            var_dump($stmt->rowCount());

            if($stmt->rowCount() >= 0){ //on compte les entrees retournees par "execute(tableau associatif)"
                $row = $stmt->fetch(); //creer une variable qui liste(recherche) tous les elements

                    if($this->email_admin === $row['email_admin'] && $this->password_admin === $row['password_admin']){
                        session_start(); //demarre la session
                        $_SESSION['connecter_admin'] = true;
                        $_SESSION['email_admin'] = $this->email_admin;
                        header('Location: administration'); //la redirection

                    }else{
                        echo "<p class='alert-danger mt-3 p-2'>Erreur de connexion. verification & redo necessary</p>";
                    }
            }else{
                echo "<p class='alert-danger mt-3 p-2'>error table vide</p>";
            }    
        }else{
            echo "<p class='alert-danger mt-3 p-2'>remplissez tous les champs</p>";
        }
    }
 }
