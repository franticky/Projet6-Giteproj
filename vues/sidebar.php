<nav class="navbar navbar-expand-lg navbar-dark py-lg-4" id="mainNav">
            <div class="container">
                <a class="navbar-brand text-uppercase fw-bold d-lg-none" href="index.html">
                    
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item px-lg-4">
                            <a class="nav-link text-uppercase" href="accueil">
                                Accueil
                            </a>
                        </li>
                        <li class="nav-item px-lg-4"><a class="nav-link text-uppercase" href="membres">
                                Membres
                            </a></li>
                        <li class="nav-item px-lg-4">
                            <a class="nav-link text-uppercase" href="administration">
                                Admin
                            </a>
                        </li>
                        
                        <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="trouver" aria-label="trouver">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">
                    trouver
                </button>
                <!--si un utilisateur est connecté-->
                <li class="nav-item">

                        <?php
                            //demarrage de la session. SI on est connecté comme utilisateur, on retourne la page d accueil + on affiche l'email de l'utilisateur
                        if(isset($_SESSION['connecter_user']) && $_SESSION['connecter_user'] === true){
                            ?>
                       
                        <h4 class="text-danger mt-1">
                            <b style="color: #2c4f56;font-size: 14px">
                                connection reussie comme 
                            </b> <?= $_SESSION['mel_user'] ?>
                        </h4>

                        <?php
                    //sinon, si on est connecté comme administrateur, on affiche un onglet administration + email de l admin
                        }elseif(isset($_SESSION['connecter']) && $_SESSION['connecter'] === true){
                        ?>
                        <div class="d-flex">
                <a class="nav-link" href="administration">
                    administration
                </a>
                <h4 class="text-danger mt-1" > 
                    <b style="color: #2c4f56;font-size: 14px"> connection en tant qu </b> <?= $_SESSION['email_admin'] ?>
                </h4>
                </div>

                <?php
                        }else{
                            ?>
                                    <a class="nav-link" href="accueil">
                                            deconnection
                                        </a>
                            <?php
                        }
                            ?>
                </li>
                        </form>
                        
                    </ul>
                        <form class="form-inline my-2 my-lg-0">
                            <a class="nav-link btn btn-secondary mr-3" href="inscription">
                                inscription
                            </a>

                        <?php
                        //si on est connecté en tant qu utilisateur ou admin, le bouton connexion devient deconnection
                        if(isset($_SESSION['connecter']) && $_SESSION['connecter'] === true || isset($_SESSION['connecter_user']) && $_SESSION['connecter_user'] === true){
                        ?>
                        <a class="nav-link btn btn-danger" href="deconnexion">
                            deconnexion
                        </a>

                        <?php
                        }else{
                            ?>
                            <a class="nav-link btn btn-danger" href="connexion">connexion</a>
                        <?php        
                        }
                        ?>
                        </form>
                </div>
            </div>
        </nav>
      

