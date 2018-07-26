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
    
    var_dump($idInfraction);
    echo('</br>');
    var_dump($idTypeInfraction);echo('</br>');echo('</br>');
    $response = $db->prepare("INSERT INTO infraction_type_infraction(infraction_id, type_infraction_id) VALUES(:idInfraction, :idType)");
    $response->bindParam(':idInfraction', $idInfraction, PDO::PARAM_INT);
    $response->bindParam(':idType', $idTypeInfraction, PDO::PARAM_INT);
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}

//LIST
function listAll(){
    global $db;
    $response = $db->prepare("SELECT * FROM `infraction` 
    INNER JOIN tribunal.tribunal_nom ON infraction.tribunal_id_id = tribunal.id      
    INNER JOIN stagiaire.nom, stagiaire.prenom ON infraction.stagiaire_id = stagiaire.id");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}

function stagiaire(){
    global $db;
    $response = $db->prepare("SELECT * FROM stagiaire");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}

function tribunal(){
    global $db;
    $response = $db->prepare("SELECT * FROM tribunal");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}

function typeInfraction(){
    global $db;
    $response = $db->prepare("SELECT * FROM type_infraction");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}

function typeInfractionLiaison($id){
    global $db;
    $response = $db->prepare("SELECT * FROM infraction_type_infraction WHERE id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}

function getOne($id){
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
function edit($tribunal, $dateInfraction, $heureInfraction, $lieuInfraction, $numeroParquet, $csp, $csa, $id){
    global $db;
    $response = $db->prepare("UPDATE infraction SET tribunal_id_id = :tribunal,
    date_infraction = :dateInfraction,
    heure_infraction = :heureInfraction,
    lieu_infraction = :lieuInfraction, 
    numero_parquet = :numeroParquet,
    conduite_sans_permis = :csp, 
    conduite_sans_assurance = :csa 
    WHERE infraction.id = :id");
    $response->bindParam(':tribunal', $tribunal, PDO::PARAM_INT);
    $response->bindParam(':dateInfraction', $dateInfraction, PDO::PARAM_INT);
    $response->bindParam(':heureInfraction', $heureInfraction, PDO::PARAM_INT);
    $response->bindParam(':lieuInfraction', $lieuInfraction, PDO::PARAM_STR);
    $response->bindParam(':numeroParquet', $numeroParquet, PDO::PARAM_STR);
    $response->bindParam(':csp', $csp, PDO::PARAM_BOOL);
    $response->bindParam(':csa', $csa, PDO::PARAM_BOOL);
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}

//DELETE
function delete($id){
    global $db;
    $response = $db->prepare("DELETE FROM infraction, infraction_type_infraction 
    WHERE infraction.id = :id AND infraction_type_infraction.infraction_id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}
