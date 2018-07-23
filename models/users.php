<?php
    require_once("utils/db.php");
    $salt = '883e467372d3211d81808c5c4ad9139a542355c7';

    function create($table,$identifiant){
        global $db;
        $response = $db->prepare("INSERT INTO $table VALUES(:status_nom)");
        $response->bindParam(':status_nom', $status_nom, PDO::PARAM_STR);
        $response->execute();
        return true; 
    }



    function getLogin( $identifiant, $mdp ){
        global $db, $salt;
        $hmpd = crypt( $mdp, $salt );
        $response = $db->prepare("SELECT id, identifiant, prenom, nom  FROM user WHERE identifiant = :identifiant AND mdp = :mdp");
        $response->bindParam(':identifiant', $identifiant, PDO::PARAM_STR);
        $response->bindParam(':mdp', $hmpd, PDO::PARAM_STR);
        $response->execute();
        return $response->fetch(PDO::FETCH_ASSOC);
    }


    function getById( $id ){
        
    }