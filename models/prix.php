<?php 
require_once("utils/db.php");
// NEW
function create($prix){
    global $db;
    $response = $db->prepare("INSERT INTO prix(prix_montant) VALUES(:prix)");
    $response->bindParam(':prix', $prix, PDO::PARAM_STR);
    $response->execute();
    return true; 
}
//LIST
function listAll(){
    global $db;
    $response = $db->prepare("SELECT id, prix_montant FROM prix");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}
//EDIT
function getOne($id){
    global $db;
    $response = $db->prepare("SELECT id, prix_montant FROM prix WHERE prix.id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return $response->fetch(PDO::FETCH_ASSOC);
}
function edit($prix, $id){
    global $db;
    $response = $db->prepare("UPDATE prix
    SET prix_montant = :prix 
    WHERE id = :id");
    $response->bindParam(':prix', $prix, PDO::PARAM_STR);
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}

//DELETE


function delete($id){
    global $db;
    $response = $db->prepare("DELETE FROM prix
    WHERE id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}
