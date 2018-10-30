<?php 
require_once("utils/db.php");
// NEW
function create($civilite){
    global $db;
    $response = $db->prepare("INSERT INTO civilite(nom) VALUES(:civilite)");
    $response->bindParam(':civilite', $civilite, PDO::PARAM_STR);
    $response->execute();
    return true; 
}
//LIST
function listAll(){
    global $db;
    $response = $db->prepare("SELECT id, nom FROM civilite");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}
//EDIT
function getOne($id){
    global $db;
    $response = $db->prepare("SELECT id, nom FROM civilite WHERE civilite.id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return $response->fetch(PDO::FETCH_ASSOC);
}
function edit($civilite, $id){
    global $db;
    $response = $db->prepare("UPDATE civilite
    SET nom = :civilite 
    WHERE id = :id");
    $response->bindParam(':civilite', $civilite, PDO::PARAM_STR);
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}

//DELETE


function delete($id){
    global $db;
    $response = $db->prepare("DELETE FROM civilite
    WHERE id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}


function getNom($nom){
    global $db;
    $response = $db->prepare("SELECT nom FROM civilite WHERE nom = :nom");
    $response->bindParam(':nom', $nom, PDO::PARAM_STR);
    $response->execute();
    return $response->fetch(PDO::FETCH_ASSOC);
}


//retourne le nombre de préfecture rattaché a ce service
function nombreRelationCiviliteAnimateur( $id ){
    global $db;
    $sql = "SELECT COUNT(id) AS nombre FROM animateur where civilite_id_id = :id";
    $response = $db->prepare( $sql );
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    $result = $response->fetch( PDO::FETCH_ASSOC);

    return $result['nombre']; 
}
