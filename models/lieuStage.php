<?php 
require_once("utils/db.php");
// NEW
function create($lieuNom, $etablissementNom, $adresse, $codePostal, $commune, $tel, $latitude, $longitude, $divers){
    global $db;
    $response = $db->prepare("INSERT INTO lieu_stage(lieu_nom, etablissement_nom, adresse, code_postal, commune, tel, latitude, longitude, divers) VALUES(:lieuNom, :etablissementNom, :adresse, :codePostal, :commune, :tel, :latitude, :longitude, :divers)");
    $response->bindParam(':lieuNom', $lieuNom, PDO::PARAM_STR);
    $response->bindParam(':etablissementNom', $etablissementNom, PDO::PARAM_STR);
    $response->bindParam(':adresse', $adresse, PDO::PARAM_STR);
    $response->bindParam(':codePostal', $codePostal, PDO::PARAM_STR);
    $response->bindParam(':commune', $commune, PDO::PARAM_STR);
    $response->bindParam(':tel', $tel, PDO::PARAM_STR);
    $response->bindParam(':latitude', $latitude, PDO::PARAM_STR);
    $response->bindParam(':longitude', $longitude, PDO::PARAM_STR);
    $response->bindParam(':divers', $divers, PDO::PARAM_STR);
    $response->execute();
    return true; 
}
//LIST
function listAll(){
    global $db;
    $response = $db->prepare("SELECT * FROM lieu_stage");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}
//EDIT
function getOne($id){
    global $db;
    $response = $db->prepare("SELECT * FROM lieu_stage WHERE lieu_stage.id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return $response->fetch(PDO::FETCH_ASSOC);
}
function edit($lieuNom, $etablissementNom, $adresse, $codePostal, $commune, $tel, $latitude, $longitude, $divers, $id){
    global $db;
    $response = $db->prepare("UPDATE lieu_stage SET lieu_nom = :lieuNom, etablissement_nom = :etablissementNom, adresse = :adresse, code_postal = :codePostal, commune = :commune, tel = :tel, latitude = :latitude, longitude = :longitude, divers = :divers WHERE id = :id");
    $response->bindParam(':lieuNom', $lieuNom, PDO::PARAM_STR);
    $response->bindParam(':etablissementNom', $etablissementNom, PDO::PARAM_STR);
    $response->bindParam(':adresse', $adresse, PDO::PARAM_STR);
    $response->bindParam(':codePostal', $codePostal, PDO::PARAM_STR);
    $response->bindParam(':commune', $commune, PDO::PARAM_STR);
    $response->bindParam(':tel', $tel, PDO::PARAM_STR);
    $response->bindParam(':latitude', $latitude, PDO::PARAM_STR);
    $response->bindParam(':longitude', $longitude, PDO::PARAM_STR);
    $response->bindParam(':divers', $divers, PDO::PARAM_STR);;
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}

//DELETE
function delete($id){
    global $db;
    $response = $db->prepare("DELETE FROM lieu_stage
    WHERE id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}
