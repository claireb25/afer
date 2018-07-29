<?php 
require_once("utils/db.php");
// NEW
function create($autorite_nom){
    global $db;
    $response = $db->prepare("INSERT INTO autorite_tribunal(autorite_nom) VALUES(:autorite_nom)");
    $response->bindParam(':autorite_nom', $autorite_nom, PDO::PARAM_STR);
    $response->execute();
    return true; 
}
//LIST
function listAll(){
    global $db;
    $response = $db->prepare("SELECT id, autorite_nom FROM autorite_tribunal");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}
//EDIT
function getOne($id){
    global $db;
    $response = $db->prepare("SELECT id, autorite_nom FROM autorite_tribunal WHERE autorite_tribunal.id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return $response->fetch(PDO::FETCH_ASSOC);
}

function getAutoriteNom($autorite_nom){
    global $db;
    $response = $db->prepare("SELECT autorite_nom FROM autorite_tribunal WHERE autorite_nom = :autorite_nom");
    $response->bindParam(':autorite_nom', $autorite_nom, PDO::PARAM_STR);
    $response->execute();
    return $response->fetch(PDO::FETCH_ASSOC);
}




function edit($autorite_nom, $id){
    global $db;
    $response = $db->prepare("UPDATE autorite_tribunal
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
    $response = $db->prepare("DELETE FROM autorite_tribunal
    WHERE id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}
