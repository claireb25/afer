<?php 
require_once("utils/db.php");
// NEW
function create($forfait){
    global $db;
    $response = $db->prepare("INSERT INTO forfait_animateur(forfait_prix) VALUES(:forfait)");
    $response->bindParam(':forfait', $forfait, PDO::PARAM_STR);
    $response->execute();
    return true; 
}
//LIST
function listAll(){
    global $db;
    $response = $db->prepare("SELECT id, forfait_prix FROM forfait_animateur");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}
//EDIT
function getOne($id){
    global $db;
    $response = $db->prepare("SELECT id, forfait_prix FROM forfait_animateur WHERE forfait_animateur.id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return $response->fetch(PDO::FETCH_ASSOC);
}
function edit($forfait, $id){
    global $db;
    $response = $db->prepare("UPDATE forfait_animateur
    SET forfait_prix = :forfait 
    WHERE id = :id");
    $response->bindParam(':forfait', $forfait, PDO::PARAM_STR);
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}

//DELETE


function delete($id){
    global $db;
    $response = $db->prepare("DELETE FROM forfait_animateur
    WHERE id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}
