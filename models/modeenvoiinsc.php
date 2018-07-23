<?php 
require_once("utils/db.php");
// NEW
function create($mode){
    global $db;
    $response = $db->prepare("INSERT INTO mode_envoi_inscription(mode) VALUES(:mode)");
    $response->bindParam(':mode', $mode, PDO::PARAM_STR);
    $response->execute();
    return true; 
}
//LIST
function listAll(){
    global $db;
    $response = $db->prepare("SELECT id, mode FROM mode_envoi_inscription");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}
//EDIT
function getOne($id){
    global $db;
    $response = $db->prepare("SELECT id, mode FROM mode_envoi_inscription WHERE mode_envoi_inscription.id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return $response->fetch(PDO::FETCH_ASSOC);
}
function edit($mode, $id){
    global $db;
    $response = $db->prepare("UPDATE mode_envoi_inscription
    SET mode = :mode 
    WHERE id = :id");
    $response->bindParam(':mode', $mode, PDO::PARAM_STR);
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}

//DELETE


function delete($id){
    global $db;
    $response = $db->prepare("DELETE FROM mode_envoi_inscription
    WHERE id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}
