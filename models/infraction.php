<?php 
require_once("utils/db.php");

// NEW
function create($tribunal, $dateInfraction, $heureInfraction, $lieuInfraction, $numeroParquet, $stagiaire){
    global $db;
    $response = $db->prepare("INSERT INTO infraction(tribunal_id_id, date_infraction, heure_infraction, lieu_infraction, numero_parquet, stagiaire_id) VALUES(:tribunal, :dateInfraction, :heureInfraction, :lieuInfraction, :numeroParquet, :stagiaire)");
    $response->bindParam(':tribunal', $tribunal, PDO::PARAM_INT);
    $response->bindParam(':dateInfraction', $dateInfraction, PDO::PARAM_STR);
    $response->bindParam(':heureInfraction', $heureInfraction, PDO::PARAM_STR);
    $response->bindParam(':lieuInfraction', $lieuInfraction, PDO::PARAM_STR);
    $response->bindParam(':numeroParquet', $numeroParquet, PDO::PARAM_STR);
    $response->bindParam(':stagiaire', $stagiaire, PDO::PARAM_INT);
    $response->execute();
    return true; 
}

function createLiaisonTypeInfraction($idInfraction, $idTypeInfraction){
    global $db;
    $response = $db->prepare("INSERT INTO infraction_type_infraction(infraction_id, type_infraction_id) VALUES(:idInfraction, :idType)");
    $response->bindParam(':idInfraction', $idInfraction, PDO::PARAM_INT);
    $response->bindParam(':idType', $idTypeInfraction, PDO::PARAM_INT);
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}

//LIST
function listAll(){
    global $db;
    $response = $db->prepare("SELECT infraction.id, infraction.tribunal_id_id, infraction.date_infraction, infraction.heure_infraction, infraction.lieu_infraction, infraction.numero_parquet, infraction.stagiaire_id, tribunal.tribunal_nom, tribunal.commune, stagiaire.nom, stagiaire.prenom FROM `infraction` 
    INNER JOIN tribunal ON infraction.tribunal_id_id = tribunal.id      
    INNER JOIN stagiaire ON infraction.stagiaire_id = stagiaire.id");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}

function stagiaire(){
    global $db;
    $response = $db->prepare("SELECT * FROM stagiaire");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}
function stagiaireByID($stagiaireID){
    global $db;
    $response = $db->prepare("SELECT * FROM stagiaire WHERE id = :id");
    $response->bindParam(':id', $stagiaireID, PDO::PARAM_INT);
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}

function tribunal(){
    global $db;
    $response = $db->prepare("SELECT * FROM tribunal");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}
function tribunalByID($tribunalID){
    global $db;
    $response = $db->prepare("SELECT * FROM tribunal WHERE id = :id");
    $response->bindParam(':id', $tribunalID, PDO::PARAM_INT);
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}

function typeInfraction(){
    global $db;
    $response = $db->prepare("SELECT * FROM type_infraction");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}
function typeInfractionByID($infractionID){
    global $db;
    $response = $db->prepare("SELECT * FROM type_infraction WHERE infraction_id = :id");
    $response->bindParam(':id', $infractionID, PDO::PARAM_INT);
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}

function typeInfractionLiaison($id){
    global $db;
    $response = $db->prepare("SELECT * FROM infraction_type_infraction WHERE infraction_id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}

function infractionByID($id){
    global $db;
    $response = $db->prepare("SELECT * FROM infraction 
    WHERE infraction.id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return $response->fetch(PDO::FETCH_ASSOC);
}

function getIdByNP($numeroParquet){
    global $db;
    $response = $db->prepare("SELECT id FROM infraction 
    WHERE infraction.numero_parquet = :numeroParquet");
    $response->bindParam(':numeroParquet', $numeroParquet, PDO::PARAM_STR);
    $response->execute();
    return $response->fetch(PDO::FETCH_ASSOC);
}



//EDIT
function editInfraction($tribunal, $dateInfraction, $heureInfraction, $lieuInfraction, $numeroParquet, $stagiaire, $id){
    global $db;
    $response = $db->prepare("UPDATE infraction SET tribunal_id_id = :tribunal, 
    date_infraction = :dateInfraction, 
    heure_infraction = :heureInfraction, 
    lieu_infraction = :lieuInfraction,  
    numero_parquet = :numeroParquet, 
    stagiaire_id = :stagiaire 
    WHERE infraction.id = :id");
    $response->bindParam(':tribunal', $tribunal, PDO::PARAM_INT);
    $response->bindParam(':dateInfraction', $dateInfraction, PDO::PARAM_STR);
    $response->bindParam(':heureInfraction', $heureInfraction, PDO::PARAM_STR);
    $response->bindParam(':lieuInfraction', $lieuInfraction, PDO::PARAM_STR);
    $response->bindParam(':numeroParquet', $numeroParquet, PDO::PARAM_STR);
    $response->bindParam(':stagiaire', $stagiaire, PDO::PARAM_INT);
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}

//DELETE
function deleteInfraction($id){
    global $db;
    $response = $db->prepare("DELETE FROM infraction 
    WHERE infraction.id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}

function deleteTypeInfraction($id){
    global $db;
    $response = $db->prepare("DELETE FROM infraction_type_infraction 
    WHERE infraction_type_infraction.infraction_id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}
