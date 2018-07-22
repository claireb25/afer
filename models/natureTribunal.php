<?php 
require_once("utils/db.php");
// NEW
function create($nature_nom){
    global $db;
    $response = $db->prepare("INSERT INTO nature_tribunal(nature_nom) VALUES(:nature_nom)");
    $response->bindParam(':nature_nom', $nature_nom, PDO::PARAM_STR);
    $response->execute();
    return true; 
}
//LIST
function listAll(){
    global $db;
    $response = $db->prepare("SELECT id, nature_nom FROM nature_tribunal");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}
//EDIT
function getOne($id){
    global $db;
    $response = $db->prepare("SELECT id, nature_nom FROM nature_tribunal WHERE nature_tribunal.id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return $response->fetch(PDO::FETCH_ASSOC);
}
function edit($nature_nom, $id){
    global $db;
    $response = $db->prepare("UPDATE nature_tribunal
    SET nature_nom = :nature_nom 
    WHERE id = :id");
    $response->bindParam(':nature_nom', $nature_nom, PDO::PARAM_STR);
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}

//DELETE


function delete($id){
    global $db;
    $response = $db->prepare("DELETE FROM nature_tribunal
    WHERE id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}
