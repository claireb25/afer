<?php 
require_once("utils/db.php");
// NEW
function create($valeur){
    global $db;
    $response = $db->prepare("INSERT INTO defraiement VALUES ($valeur)");
    $response->execute();
    return true; 
}
//LIST
function listAll(){
    global $db;
    $response = $db->prepare("SELECT id, repas, km_ar FROM defraiement");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}
//EDIT
function getOne($id){
    global $db;
    $response = $db->prepare("SELECT id, repas, km_ar FROM defraiement WHERE defraiement.id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return $response->fetch(PDO::FETCH_ASSOC);
}
function edit($colonne, $valeur, $id){
    global $db;
    $response = $db->prepare("UPDATE defraiement
    SET $colonne = $valeur 
    WHERE id = $id");
    // $response->bindParam(':colonne', $colonne, PDO::PARAM_STR);
    // $response->bindParam(':valeur', $valeur, PDO::PARAM_STR);
    // $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}

//DELETE
function delete($id){
    global $db;
    $response = $db->prepare("DELETE FROM defraiement
    WHERE id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}
