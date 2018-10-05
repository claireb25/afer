<?php 
require_once("utils/db.php");
// NEW
function create($service_nom){
    global $db;
    $response = $db->prepare("INSERT INTO service_prefecture(service_nom) VALUES(:service_nom)");
    $response->bindParam(':service_nom', $service_nom, PDO::PARAM_STR);
    $response->execute();
    return true; 
}
//LIST
function listAll(){
    global $db;
    $response = $db->prepare("SELECT id, service_nom FROM service_prefecture");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}
//EDIT
function getOne($id){
    global $db;
    $response = $db->prepare("SELECT id, service_nom FROM service_prefecture WHERE service_prefecture.id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return $response->fetch(PDO::FETCH_ASSOC);
}

function getServiceNom($service_nom){
    global $db;
    $response = $db->prepare("SELECT service_nom FROM service_prefecture WHERE service_nom = :service_nom");
    $response->bindParam(':service_nom', $service_nom, PDO::PARAM_STR);
    $response->execute();
    return $response->fetch(PDO::FETCH_ASSOC);
}

function lastRow(){
    global $db;
    $response = $db->prepare("SELECT id, service_nom FROM service_prefecture order by id desc");
    $response->execute();
    return $response->fetch(PDO::FETCH_ASSOC);
}


function edit($service_nom, $id){
    global $db;
    $response = $db->prepare("UPDATE service_prefecture
    SET service_nom = :service_nom 
    WHERE id = :id");
    $response->bindParam(':service_nom', $service_nom, PDO::PARAM_STR);
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}

//DELETE


function delete($id){
    global $db;
    $response = $db->prepare("DELETE FROM service_prefecture
    WHERE id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}

//retourne le nombre de préfecture rattaché a ce service
function nombreRelationServicePrefecture( $id ){
    global $db;
    $sql = "SELECT COUNT(id) AS nombre FROM prefecture where service_prefecture_id_id = :id";
    $response = $db->prepare( $sql );
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    $result = $response->fetch( PDO::FETCH_ASSOC);

    return $result['nombre']; 
}
