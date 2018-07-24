<?php 
require_once("utils/db.php");
// NEW
function create($repas, $kmar){
    global $db;
    $response = $db->prepare("INSERT INTO defraiement(repas, km_ar) VALUES(:repas, :kmar)");
    $response->bindParam(':repas', $repas, PDO::PARAM_STR);
    $response->bindParam(':kmar', $kmar, PDO::PARAM_STR);
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
function edit($repas, $kmar, $id){
    global $db;
    $response = $db->prepare("UPDATE defraiement SET repas = :repas, km_ar = :kmar WHERE id = :id");
    $response->bindParam(':repas', $repas, PDO::PARAM_STR);
    $response->bindParam(':kmar', $kmar, PDO::PARAM_STR);
    $response->bindParam(':id', $id, PDO::PARAM_INT);
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
