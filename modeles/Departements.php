<?php
require_once "modeles/database.php";

class Departement extends Database {

        public function getDepartement(){
            //la connexion
            $db = $this->getPDO();
                $sql = "SELECT * FROM Departement";
                    $departements = $db->query($sql);
                        return $departements;
        }
    }
