<?php 
require_once("utils/db.php");
// NEW
function create($nom, $prix, $description){
    global $db;
    $response = $db->prepare("INSERT INTO cas_stage(cas_nom, cas_prix, cas_description) VALUES(:nom, :prix, :description)");
    $response->bindParam(':nom', $nom, PDO::PARAM_STR);
    $response->bindParam(':prix', $prix, PDO::PARAM_STR);
    $response->bindParam(':description', $description, PDO::PARAM_STR);
    $response->execute();
    return true; 
}
//LIST
function listAll(){
    global $db;
    $response = $db->prepare("SELECT id, cas_nom, cas_prix, cas_description FROM cas_stage");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}
//EDIT
function getOne($id){
    global $db;
    $response = $db->prepare("SELECT id, cas_nom, cas_prix, cas_description FROM cas_stage WHERE cas_stage.id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return $response->fetch(PDO::FETCH_ASSOC);
}
function edit($cas_nom, $cas_prix, $cas_description, $id){
    global $db;
    $response = $db->prepare("UPDATE cas_stage
    SET cas_nom = :cas_nom, cas_prix = :cas_prix, cas_description = :cas_description
    WHERE id = :id");
    $response->bindParam(':cas_nom', $cas_nom, PDO::PARAM_STR);
    $response->bindParam(':cas_prix', $cas_prix, PDO::PARAM_STR);
    $response->bindParam(':cas_description', $cas_description, PDO::PARAM_STR);
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}

//DELETE


function delete($id){
    global $db;
    $response = $db->prepare("DELETE FROM cas_stage
    WHERE id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}
