<?php
require_once "modeles/database.php"; //appel du fichier Database.php;

class Utilisateurs extends database
{ //la classe utilisateurs herite de la classe mere database


    private $mel_user;
    private $passe_user;
    private $repeatPassword;

//////////////////////////////////////////////////////Inscription<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
    public function inscriptionUtilisateur()
    {  //inscrire un utilisateur pour reserver un gite et ecrire un commentaire

        $db = $this->getPDO(); //connexion a la base de donnees a l aide de l instance de la classe mere (database) heritage, et appel de sa methode publique getPDO();

        if (isset($_POST['mel_user']) && !empty($_POST['mel_user'])) {
            /*en francais = desinfecter: les users peuvent entrer des donnees comme dans un formulaire de contact, il est important de sassurer qu il ne sagit pas dd une tentative
            d attaque(comme les injections sql), voire, une tentative de piratage.
            c est pour cela que nous allons desinfecter toutes les donnees entrees par l utilisateur avant de les manipuler dans notre script.
            on assigne les champs du formulaire aux proprietees privees de la classe.*/
            $this->mel_user = trim(htmlspecialchars($_POST['mel_user']));
        }


        if (isset($_POST['passe_user']) && !empty($_POST['passe_user'])) { //desinfection
            $this->passe_user = trim(htmlspecialchars($_POST['passe_user']));
        }
        if (isset($_POST['repeat_passe_user']) && !empty($_POST['repeat_passe_user'])) { //desinfection
            $this->repeatPassword = trim(htmlspecialchars($_POST['repeat_passe_user']));
        }

        if ($this->passe_user != $this->repeatPassword) { //verifier le mot de passe repeté
            echo "<p class='alert alert-warning p-3 mt-3'> 2 mot de passes ne sont pas identique</p>";
        }


        $sql = "INSERT INTO users (mel_user, passe_user) VALUES (?,?)"; //requete d'insertion.
        $insert_user = $db->prepare($sql); //requete preparee
        $insert_user->bindParam(1, $this->mel_user); //liage des champs du formulaire a la requete sql
        $insert_user->bindParam(2, $this->passe_user);

        //hachage du mot de passe  grace a la fonction password_hash qui cree une clé de hachage pour mots de passes. elle prend 2 parametres obligatoires & des options.
        // password_hash(string $password, string|int|null $algo, array $options = []): string.
        //  l'entree de l utilisateur + l'algo de hashage + option(cost, etc..)
        $hash_password = password_hash($this->passe_user, PASSWORD_DEFAULT);


        $insert_user->execute(array( //Lors de l'execution de la requete le mot de passe haché est inséré dans le tableau de parametres
            $this->mel_user,
            $hash_password,
        ));


        if ($insert_user) { //si ca marche
            ?>  <!--on redirige vers la page d accueil-->


            <p class="alert alert-success p-3 mt-3">Bienvenue: inscription reussie</p>
            <a href="membres" class="mt-3 btn btn-success">connexion</a>
            <style>
                #form-register-user { /*on cache le formulaire*/
                    display: none;
                }
            </style>


            <?php
        } else {
            echo "<p class='alert-warning p-2'>erreur. remplir tous les champs.</p>";

        }
    }


    //----------------------connection user------------------------------------------------------------
    public function connexionUtilisateur()
    { //connecter un utilisateur
        //connexion a la base de donnees a l'aide de l instance de la classe mere(database) heritage & appel de sa methode publique getPDO()

        $db = $this->getPDO();

        //verifie si utilisateurs est deja connecté
        if (isset($_SESSION['connecter_user']) && $_SESSION['connecter_user'] === true) { //si oui = message d acceuil + affiche le mail
            ?>
            <h1>bienvenue
                <?= $_POST['mel_user'] ?>
            </h1>

            <?php
            var_dump('mel_user');
        } else {  //sinon on redirige vers l inscription
            echo "<p class='alert-warning mt-2 p-2'> votre incription n'a pas encore eu lieu
        <a href='inscription' class='btn btn-info'>
            S'incrire
        </a>
    </p>";
        }

        //verification des champs du formulaire,
        if (isset($_POST['mel_user']) && !empty($_POST['mel_user'])) { //on sanitize = desinfection des champs
            $this->mel_user = trim(htmlspecialchars($_POST['mel_user'])); //trim supprimer les espaces en debut et fin de chaine de characteres

            //htmlspecialchar transforme les characters speciaux en chaine de characteres, faille xss => ex: <script>js malvailant</script>
        } else { //sinon on affiche une erreurs
            echo "<p class='alert-danger p-3'>remplissez le champ mel n'est pas falcultatif</p>";
        }
        if (isset($_POST['passe_user']) && !empty($_POST['passe_user'])) {
            $this->passe_user = trim(htmlspecialchars($_POST['passe_user']));
        } else {
            echo "<p class='alert-danger p-3'>remplissez le champ passe n'est pas falcultatif</p>";
        }
        if (!empty($_POST['mel_user']) && !empty($_POST['passe_user'])) {
            $sql = "SELECT * FROM users WHERE mel_user = ? "; //requete de connexion
            $stmt = $db->prepare($sql); //requete preparee
            $stmt->bindParam(1, $this->mel_user);

            $stmt->execute();

            if ($stmt->rowCount() >= 1) {
                $row = $stmt->fetch(PDO::FETCH_ASSOC);  /*creer une variable qui liste(recherche) tous les elements mais retourne un tableau associatif
                      avec 1 seul resultat*/

                //si les propriete privees $mel_user & $passe_user ($_POST['mel_user']) est égal aux donnees mel de la table users
                if ($this->mel_user === $row['mel_user'] && password_verify($this->passe_user, $row ["passe_user"])) { //on demarre une session
                    session_start();
                    /*on stocke dans une variable SuperGlobale de session: booléen pour verifier si on est connecté, & email de la personne connectée ces elements sont utilises dans le router
                    + la navbar pour afficher l utilisateur courant */
                    $_SESSION['connecter_user'] = true;
                    $_SESSION['mel_user'] = $this->mel_user;
                    header("Location: accueil"); //la redirection = si on est connecté on redirige vers la page d acceuil

                } else { //si l egalite entre le formulaire & la table users n est pas strictement parfaite
                    echo "<p class='alert-danger p-2'>erreur email & mot passe incorrects !</p>";
                }
            } else {
                echo "<p class='alert-danger p-2'>erreur incorrect entries!</p>"; //si la table est vide
            }
        } else {
            echo "<p class='alert-danger p-2'>erreur un des 2 champs est vide !</p>"; //un des 2 champs est vide
        }
        //var_dump($this->mel_user);
        //var_dump($this->passe_user)
    }
}


?>