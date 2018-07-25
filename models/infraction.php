<?php 
require_once("utils/db.php");

// NEW
function create($tribunal, $dateInfraction, $heureInfraction, $lieuInfraction, $numeroParquet){
    global $db;
    $response = $db->prepare("INSERT INTO infraction(nature_tribunal_id_id, date_infraction, heure_infraction, lieu_infraction, numero_parquet, conduite_sans_permis, conduite_sans_assurance) VALUES(:tribunal, :dateInfraction, :heureInfraction, :lieuInfraction, :numeroParquet)");
    $response->bindParam(':tribunal', $tribunal, PDO::PARAM_INT);
    $response->bindParam(':dateInfraction', $dateInfraction, PDO::PARAM_INT);
    $response->bindParam(':heureInfraction', $heureInfraction, PDO::PARAM_INT);
    $response->bindParam(':lieuInfraction', $lieuInfraction, PDO::PARAM_STR);
    $response->bindParam(':numeroParquet', $numeroParquet, PDO::PARAM_STR);
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
    $response = $db->prepare("SELECT * FROM `infraction` 
    INNER JOIN tribunal ON infraction.tribunal_id_id = tribunal.id");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}

function tribunal(){
    global $db;
    $response = $db->prepare("SELECT id, tribunal_nom FROM tribunal");
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
    $response = $db->prepare("DELETE FROM infraction
    WHERE id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}
