<?php 
require_once("utils/db.php");
// NEW
function create($table, $type_infraction){
    global $db;
    $response = $db->prepare("INSERT INTO $table VALUES(:type_infraction_nom)");
    $response->bindParam(':type_infraction_nom', $type_infraction, PDO::PARAM_STR);
    $response->execute();
    return true; 
}
//LIST
function listAll(){
    global $db;
    $response = $db->prepare("SELECT id, type_infraction_nom FROM type_infraction");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}
//EDIT
function getOne($id){
    global $db;
    $response = $db->prepare("SELECT id, type_infraction_nom FROM type_infraction WHERE type_infraction.id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return $response->fetch(PDO::FETCH_ASSOC);
}
function edit($type_infraction, $id){
    global $db;
    $response = $db->prepare("UPDATE type_infraction
    SET type_infraction_nom = :type_infraction_nom 
    WHERE id = :id");
    $response->bindParam(':type_infraction_nom', $type_infraction, PDO::PARAM_STR);
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}

//DELETE


function delete($id){
    global $db;
    $response = $db->prepare("DELETE FROM type_infraction
    WHERE id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}
