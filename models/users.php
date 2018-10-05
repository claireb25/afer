<?php
    require_once("utils/db.php");
    $salt = '883e467372d3211d81808c5c4ad9139a542355c7';

  


    //fonction qui vérifie si l'utilisateur à saisie un bon mot de passe et identifiant
    function getLogin( $identifiant, $mdp ){
        global $db, $salt;
        $hmpd = crypt( $mdp, $salt );
        $response = $db->prepare("SELECT id, identifiant, prenom, nom  FROM user WHERE identifiant = :identifiant AND mdp = :mdp");
        $response->bindParam(':identifiant', $identifiant, PDO::PARAM_STR);
        $response->bindParam(':mdp', $hmpd, PDO::PARAM_STR);
        $response->execute();
        return $response->fetch(PDO::FETCH_ASSOC);
    }


    //fontion qui met à jour un utilisateur d'après son id
    function edit( $id, $identifiant, $mdp, $prenom, $nom ){
        global $db, $salt;
        if( $mdp === '' ){
            $sql = 'update  user set identifiant = :identifiant, prenom = :prenom, nom = :nom where id = :id ';
        }else{
            $hmpd = crypt( $mdp, $salt );
            $sql = 'update  user set identifiant = :identifiant, prenom = :prenom, nom = :nom, mdp = :mdp where id = :id ';
        }
        
        $response = $db->prepare( $sql );
        $response->bindParam(':id', $id, PDO::PARAM_INT);
        $response->bindParam(':identifiant', $identifiant, PDO::PARAM_STR);
        $response->bindParam(':nom', $nom, PDO::PARAM_STR);
        $response->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        

        if( $mdp !== '' ){
            $response->bindParam(':mdp', $hmpd, PDO::PARAM_STR);
        }

        return $response->execute();
       
    }


    //fonction qui retourne tous les utilisateurs
    function getList(){
        global $db;
        $sql = 'select id, identifiant, prenom, nom from user order by identifiant asc';
        $response = $db->prepare( $sql );
        $response->execute();
        return $response->fetchAll( PDO::FETCH_ASSOC);
    }


    //fonction retourne id, identifiant, prenom et le nom d'un utilisateur d'après son identifiant
    function getByIdentifiant( $identifiant ){
        global $db;
        $sql = 'select id, identifiant, prenom, nom from user where identifiant = :identifiant ';
        $response = $db->prepare( $sql );
        $response->bindParam(':identifiant', $identifiant, PDO::PARAM_STR);
        $response->execute();
        return $response->fetchAll( PDO::FETCH_ASSOC );
    }


    //fonction retourne id, identifiant, prenom et le nom d'un utilisateur d'après son id
    function getById( $id ){
        global $db;
        $sql = 'select id, identifiant, prenom, nom from user where id = :id ';
        $response = $db->prepare( $sql );
        $response->bindParam(':id', $id, PDO::PARAM_INT);
        $response->execute();
        return $response->fetch( PDO::FETCH_ASSOC );
    }


    //fonction qui insérer un nouvel utilisateur
    function create( $identifiant, $mdp, $prenom, $nom ){
        global $db, $salt;
        $hmpd = crypt( $mdp, $salt );
        $sql = 'insert into user( identifiant, mdp, prenom, nom) values(:identifiant, :mdp, :prenom, :nom)';
        $response = $db->prepare( $sql );
        $response->bindParam( ':identifiant', $identifiant, PDO::PARAM_STR );
        $response->bindParam( ':prenom', $prenom, PDO::PARAM_STR );
        $response->bindParam( ':mdp', $hmpd, PDO::PARAM_STR );
        $response->bindParam( ':nom', $nom, PDO::PARAM_STR );

        return $response->execute();
        

    }

    //fonction qui supprime l'utilisateur d'après son id
    function delete( $id ){
        global $db;
        $sql = 'delete from user where id = :id';
        $response = $db->prepare( $sql );
        $response->bindParam( ':id', $id, PDO::PARAM_STR );
        return $response->execute();
    }