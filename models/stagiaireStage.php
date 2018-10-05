<?php 
require_once("utils/db.php");

// NEW
function create($stagiaire, $stage, $suivisDossier, $casStage, $tribunal, $prefecture){
    global $db;
    $response = $db->prepare("INSERT INTO liaison_stagiaire_stage_dossier_cas_bordereau(stagiaire_id_id, stage_id_id, suivis_dossier_id_id, cas_stage_id_id, tribunal_id, prefecture_id) VALUES(:stagiaire, :stage, :suivis_dossier, :cas_stage, :tribunal, :prefecture)");
    $response->bindParam(':stagiaire', $stagiaire, PDO::PARAM_INT);
    $response->bindParam(':stage', $stage, PDO::PARAM_INT);
    $response->bindParam(':suivis_dossier', $suivisDossier, PDO::PARAM_INT);
    $response->bindParam(':cas_stage', $casStage, PDO::PARAM_INT);
    $response->bindParam(':tribunal', $tribunal, PDO::PARAM_INT);
    $response->bindParam(':prefecture', $prefecture, PDO::PARAM_INT);
    $response->execute();
    return $db->lastInsertId(); 
}

function createSuivisDossier($paye, $receptionBulletinInscription, $copieCni, $copiePermis, $releveIntegral, $decisionJudiciaire, $lettre48n, $observations){
    global $db;
    $response = $db->prepare("INSERT INTO suivis_dossier(paye, reception_bulletin_inscription, copie_cni, copie_permis, releve_integral, decision_judiciaire, lettre_48n, observations) VALUES(:paye, :receptionBulletinInscription, :copieCni, :copiePermis, :releveIntegral, :decisionJudiciaire, :lettre48n, :observations)");
    $response->bindParam(':paye', $paye, PDO::PARAM_INT);
    $response->bindParam(':receptionBulletinInscription', $receptionBulletinInscription, PDO::PARAM_INT);
    $response->bindParam(':copieCni', $copieCni, PDO::PARAM_INT);
    $response->bindParam(':copie_permis', $copie_permis, PDO::PARAM_INT);
    $response->bindParam(':releveIntegral', $releveIntegral, PDO::PARAM_INT);
    $response->bindParam(':decisionJudiciaire', $decisionJudiciaire, PDO::PARAM_INT);
    $response->bindParam(':lettre48n', $lettre48n, PDO::PARAM_INT);
    $response->bindParam(':observations', $observations, PDO::PARAM_STR);
    $response->execute();
    return $db->lastInsertId();
}

//LIST
function listAll(){
    global $db;
    $response = $db->prepare("SELECT liaison_stagiaire_stage_cas_dossier_bordereau.stagiaire_id_id, liaison_stagiaire_stage_cas_dossier_bordereau.stage_id_id, liaison_stagiaire_stage_cas_dossier_bordereau.suivi_dossier_id_id, liaison_stagiaire_stage_cas_dossier_bordereau.cas_stage_id_id, liaison_stagiaire_stage_cas_dossier_bordereau.tribunal_id, liaison_stagiaire_stage_cas_dossier_bordereau.prefecture_id, tribunal.tribunal_nom, tribunal.commune, prefecture.prefecture_nom, cas_stage.cas_nom, stagiaire.nom, stagiaire.prenom FROM `liaison_stagiaire_stage_cas_dossier_bordereau`       
    INNER JOIN stagiaire ON liaison_stagiaire_stage_cas_dossier_bordereau.stagiaire_id_id = stagiaire.id 
    INNER JOIN cas_stage ON liaison_stagiaire_stage_cas_dossier_bordereau.cas_stage_id_id = cas_stage.id 
    INNER JOIN tribunal ON liaison_stagiaire_stage_cas_dossier_bordereau.tribunal_id_id = tribunal.id 
    INNER JOIN prefecture ON liaison_stagiaire_stage_cas_dossier_bordereau.prefecture_id = prefecture.id");
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

function stage(){
    global $db;
    $response = $db->prepare("SELECT * FROM stage");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}
function stageByID($stageID){
    global $db;
    $response = $db->prepare("SELECT * FROM stage WHERE id = :id");
    $response->bindParam(':id', $stageID, PDO::PARAM_INT);
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}

function casStage(){
    global $db;
    $response = $db->prepare("SELECT * FROM cas_stage");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}
function casStageByID($casStageID){
    global $db;
    $response = $db->prepare("SELECT * FROM cas_stage WHERE id = :id");
    $response->bindParam(':id', $casStageID, PDO::PARAM_INT);
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

function prefecture(){
    global $db;
    $response = $db->prepare("SELECT * FROM prefecture");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}
function prefectureByID($prefectureID){
    global $db;
    $response = $db->prepare("SELECT * FROM prefecture WHERE id = :id");
    $response->bindParam(':id', $prefectureID, PDO::PARAM_INT);
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
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
