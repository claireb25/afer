<?php 
require_once("utils/db.php");
// NEW
function create($autorite_nom){
    global $db;
    $response = $db->prepare("INSERT INTO autorite_prefecture(autorite_nom) VALUES(:autorite_nom)");
    $response->bindParam(':autorite_nom', $autorite_nom, PDO::PARAM_STR);
    $response->execute();
    return true; 
}
//LIST
function listAll(){
    global $db;
    $response = $db->prepare("SELECT id, autorite_nom FROM autorite_prefecture");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}
//EDIT
function getOne($id){
    global $db;
    $response = $db->prepare("SELECT id, autorite_nom FROM autorite_prefecture WHERE autorite_prefecture.id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return $response->fetch(PDO::FETCH_ASSOC);
}

function lastRow(){
    global $db;
    $response = $db->prepare("SELECT id, autorite_nom FROM autorite_prefecture order by id desc");
    $response->execute();
    return $response->fetch(PDO::FETCH_ASSOC);
}

function getAutoriteNom($autorite_nom){
    global $db;
    $response = $db->prepare("SELECT autorite_nom FROM autorite_prefecture WHERE autorite_nom = :autorite_nom");
    $response->bindParam(':autorite_nom', $autorite_nom, PDO::PARAM_STR);
    $response->execute();
    return $response->fetch(PDO::FETCH_ASSOC);
}

function edit($autorite_nom, $id){
    global $db;
    $response = $db->prepare("UPDATE autorite_prefecture
    SET autorite_nom = :autorite_nom 
    WHERE id = :id");
    $response->bindParam(':autorite_nom', $autorite_nom, PDO::PARAM_STR);
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}

//DELETE


function delete($id){
    global $db;
    $response = $db->prepare("DELETE FROM autorite_prefecture
    WHERE id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}


//retourne le nombre de préfecture rattaché a ce service
function nombreRelationAutoritePrefecture( $id ){
    global $db;
    $sql = "SELECT COUNT(id) AS nombre FROM prefecture where autorite_prefecture_id_id = :id";
    $response = $db->prepare( $sql );
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    $result = $response->fetch( PDO::FETCH_ASSOC);

    return $result['nombre']; 
}