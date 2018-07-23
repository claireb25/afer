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


    function edit( $id, $identifiant, $mdp, $prenom, $nom ){
        global $db, $salt;
        if( $mdp === '' ){
            $sql = 'update  user set identifiant = :identifiant, prenom = :prenom, nom := nom where id = :id ';
        }else{
            $hmpd = crypt( $mdp, $salt );
            $sql = 'update  user set identifiant = :identifiant, prenom = :prenom, nom := nom, mdp = :mdp where id = :id ';
        }

        $response = $db->prepare( $sql );
        $response->bindParam(':id', $identifiant, PDO::PARAM_INT);
        $response->bindParam(':identifiant', $identifiant, PDO::PARAM_STR);
        $response->bindParam(':nom', $nom, PDO::PARAM_STR);
        $response->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $response->bindParam(':identifiant', $identifiant, PDO::PARAM_STR);

        if( $mdp !== '' ){
            $response->bindParam(':mdp', $hmpd, PDO::PARAM_STR);
        }

        return $response->execute();
       
    }