<?php

require("utils/db.php");

function listAll($tables){
    global $db;
    $response = $db->prepare("SELECT * FROM $tables");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}

function listOne($tables, $id){
    global $db;
    $response = $db->prepare("SELECT * FROM $tables WHERE id = $id");
    $response->execute();
    return $response->fetch(PDO::FETCH_ASSOC);
}

function getFonctionNom($fonction_nom){
    global $db;
    $response = $db->prepare("SELECT fonction_nom FROM fonction_animateur WHERE fonction_nom = :fonction_nom");
    $response->bindParam(':fonction_nom', $fonction_nom, PDO::PARAM_STR);
    $response->execute();
    return $response->fetch(PDO::FETCH_ASSOC);
}

function edit($nouvelleValeur, $id){
    global $db;
    $response = $db->prepare("UPDATE fonction_animateur SET fonction_nom = :nouvelleValeur WHERE id = :id");
    $response->bindParam(':nouvelleValeur', $nouvelleValeur, PDO::PARAM_STR);
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}

function create($tables, $val){
    global $db;
    $response = $db->prepare("INSERT INTO $tables VALUES(:val)");
    $response->bindParam(':val', $val, PDO::PARAM_STR);
    $response->execute();
    return true; 
}

function delete($id){
    global $db;
    $response = $db->prepare("DELETE FROM fonction_animateur
    WHERE id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}


function nombreRelationFonctionAnimateur( $id ){
    global $db;
    $sql = "SELECT COUNT(id) AS nombre FROM animateur where fonction_animateur_id_id = :id";
    $response = $db->prepare( $sql );
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    $result = $response->fetch( PDO::FETCH_ASSOC);

    return $result['nombre']; 
}