<?php 
require_once("utils/db.php");
// NEW
function create($table,$status_nom){
    global $db;
    $response = $db->prepare("INSERT INTO $table VALUES(:status_nom)");
    $response->bindParam(':status_nom', $status_nom, PDO::PARAM_STR);
    $response->execute();
    return true; 
}
//LIST
function listAll(){
    global $db;
    $response = $db->prepare("SELECT id, status_nom FROM statut_animateur");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}
//EDIT
function getOne($id){
    global $db;
    $response = $db->prepare("SELECT id, status_nom FROM statut_animateur WHERE statut_animateur = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return $response->fetch(PDO::FETCH_ASSOC);
}