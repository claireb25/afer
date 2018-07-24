<?php 
require_once("utils/db.php");

// NEW
function create($tribunal, $dateInfraction, $heureInfraction, $lieuInfraction, $numeroParquet, $csp, $csa){
    global $db;
    $response = $db->prepare("INSERT INTO infraction(nature_tribunal_id_id, date_infraction, heure_infraction, lieu_infraction, numero_parquet, conduite_sans_permis, conduite_sans_assurance) VALUES(:tribunal, :dateInfraction, :heureInfraction, :lieuInfraction, :numeroParquet, :csp, :csa)");
    $response->bindParam(':tribunal', $tribunal, PDO::PARAM_INT);
    $response->bindParam(':dateInfraction', $dateInfraction, PDO::PARAM_INT);
    $response->bindParam(':heureInfraction', $heureInfraction, PDO::PARAM_INT);
    $response->bindParam(':lieuInfraction', $lieuInfraction, PDO::PARAM_STR);
    $response->bindParam(':numeroParquet', $numeroParquet, PDO::PARAM_STR);
    $response->bindParam(':csp', $csp, PDO::PARAM_BOOL);
    $response->bindParam(':csa', $csa, PDO::PARAM_BOOL);
    $response->execute();
    return true; 
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

//EDIT
function getOne($id){
    global $db;
    $response = $db->prepare("SELECT * FROM infraction 
    -- INNER JOIN nature_tribunal ON tribunal.nature_tribunal_id_id = nature_tribunal.id
    -- INNER JOIN autorite_tribunal ON tribunal.autorite_tribunal_id_id = autorite_tribunal.id
    -- INNER JOIN service_tribunal ON tribunal.service_tribunal_id_id = service_tribunal.id
    WHERE infraction.id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return $response->fetch(PDO::FETCH_ASSOC);
}

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
