<?php 
require_once("utils/db.php");

// NEW
function create($lieu_stage, $stage_numero, $date_debut, $date_fin, $stage_hpo){
    global $db;
    $response = $db->prepare("INSERT INTO stage(lieu_stage_id_id, stage_numero, date, stage_hpo, date_fin) VALUES(:lieu_stage, :stage_numero, :date_debut, :stage_hpo, :date_fin)");
    $response->bindParam(':lieu_stage', $lieu_stage, PDO::PARAM_INT);
    $response->bindParam(':stage_numero', $stage_numero, PDO::PARAM_STR);
    $response->bindParam(':date_debut', $date_debut, PDO::PARAM_STR);
    $response->bindParam(':stage_hpo', $stage_hpo, PDO::PARAM_BOOL);
    $response->bindParam(':date_fin', $date_fin, PDO::PARAM_STR);
    $response->execute();
    return true; 
}

function createNewStage($stage_numero, $lieuId, $date_debut, $date_fin, $stage_hpo){
    global $db;
    $response = $db->prepare("INSERT INTO stage(lieu_stage_id_id, stage_numero, date, stage_hpo, date_fin) VALUES(:lieu_stage, :stage_numero, :date_debut, :stage_hpo, :date_fin)");
    $response->bindParam(':lieu_stage', $lieuId, PDO::PARAM_INT);
    $response->bindParam(':stage_numero', $stage_numero, PDO::PARAM_STR);
    $response->bindParam(':date_debut', $date_debut, PDO::PARAM_STR);
    $response->bindParam(':stage_hpo', $stage_hpo, PDO::PARAM_BOOL);
    $response->bindParam(':date_fin', $date_fin, PDO::PARAM_STR);
    $response->execute();
    return true; 
}

//List all stages
function listAll(){
    global $db;
    $response = $db->prepare("SELECT stage.id, stage.stage_numero, lieu_stage.lieu_nom, date, stage_hpo, date_fin FROM `stage` INNER JOIN lieu_stage ON stage.lieu_stage_id_id = lieu_stage.id");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}

// edit a stage
function getOne($id){
    global $db;
    $response = $db->prepare("SELECT stage.id, stage.stage_numero, stage.lieu_stage_id_id, lieu_stage.lieu_nom, lieu_stage.etablissement_nom, lieu_stage.adresse, lieu_stage.code_postal, lieu_stage.commune, lieu_stage.tel, lieu_stage.latitude, lieu_stage.longitude, lieu_stage.divers, lieu_stage.numero_agrement, stage.date, stage.stage_hpo, stage.date_fin FROM stage INNER JOIN lieu_stage ON stage.lieu_stage_id_id = lieu_stage.id 
    WHERE stage.id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return $response->fetch(PDO::FETCH_ASSOC);
}

function editStage($stage_numero, $lieu_stage_id, $date_debut, $date_fin, $hpo, $id){
    global $db;
    $response = $db->prepare("UPDATE stage SET lieu_stage_id_id = :lieu_stage_id, stage_numero = :stage_numero, date = :date_debut, stage_hpo = :hpo, date_fin = :date_fin WHERE id = :id");
    $response->bindParam(':lieu_stage_id', $lieu_stage_id, PDO::PARAM_INT);
    $response->bindParam(':stage_numero', $stage_numero, PDO::PARAM_STR);
    $response->bindParam(':date_debut', $date_debut, PDO::PARAM_STR);
    $response->bindParam(':date_fin', $date_fin, PDO::PARAM_STR);
    $response->bindParam(':hpo', $hpo, PDO::PARAM_BOOL);
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}

//delete one stage
function delete($id){
    global $db;
    $response = $db->prepare("DELETE FROM stage
    WHERE id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}

// LEIU STAGE

// Function called with Ajax to find a lieu de stage from a keyword in the input
function listLieux($keyword){
    global $db;
    $response = $db->prepare("SELECT * FROM lieu_stage WHERE lieu_nom LIKE :keyword");
    $keyword = $keyword.'%';
    $response->bindParam(':keyword', $keyword, PDO::PARAM_STR);
    $response->execute();
    $response = $response->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($response);
}

// creer un lieu de stage
function createLieu($lieuNom, $etablissementNom, $adresse, $codePostal, $commune, $tel, $latitude, $longitude, $divers, $numero_agrement){
    global $db;
    $response = $db->prepare("INSERT INTO lieu_stage(lieu_nom, etablissement_nom, adresse, code_postal, commune, tel, latitude, longitude, divers, numero_agrement) VALUES(:lieuNom, :etablissementNom, :adresse, :codePostal, :commune, :tel, :latitude, :longitude, :divers, :numero_agrement)");
    $response->bindParam(':lieuNom', $lieuNom, PDO::PARAM_STR);
    $response->bindParam(':etablissementNom', $etablissementNom, PDO::PARAM_STR);
    $response->bindParam(':adresse', $adresse, PDO::PARAM_STR);
    $response->bindParam(':codePostal', $codePostal, PDO::PARAM_STR);
    $response->bindParam(':commune', $commune, PDO::PARAM_STR);
    $response->bindParam(':tel', $tel, PDO::PARAM_STR);
    $response->bindParam(':latitude', $latitude, PDO::PARAM_STR);
    $response->bindParam(':longitude', $longitude, PDO::PARAM_STR);
    $response->bindParam(':divers', $divers, PDO::PARAM_STR);
    $response->bindParam(':numero_agrement', $numero_agrement, PDO::PARAM_STR);
    $response->execute();
    return $db->lastInsertId();
}

// update a lieu 
function updateLieux($lieu_id, $lieu_stage, $etablissement_nom, $adresse, $code_postal, $commune, $tel, $latitude, $longitude, $divers, $numero_agrement){
    global $db;
        $response = $db->prepare("UPDATE lieu_stage SET lieu_nom = :lieu_nom, etablissement_nom = :etablissement_nom, adresse = :adresse, code_postal = :code_postal, commune = :commune, tel = :tel, latitude = :latitude, longitude = :longitude, divers = :divers, numero_agrement = :numero_agrement WHERE id = :id");
        $response->bindParam(':lieu_nom', $lieu_stage, PDO::PARAM_STR);
        $response->bindParam(':etablissement_nom', $etablissement_nom, PDO::PARAM_STR);
        $response->bindParam(':adresse', $adresse, PDO::PARAM_STR);
        $response->bindParam(':code_postal', $code_postal, PDO::PARAM_STR);
        $response->bindParam(':commune', $commune, PDO::PARAM_STR);
        $response->bindParam(':tel', $tel, PDO::PARAM_STR);
        $response->bindParam(':latitude', $latitude, PDO::PARAM_STR);
        $response->bindParam(':longitude', $longitude, PDO::PARAM_STR);
        $response->bindParam(':divers', $divers, PDO::PARAM_STR);
        $response->bindParam(':numero_agrement', $numero_agrement, PDO::PARAM_STR);
        $response->bindParam(':id', $lieu_id, PDO::PARAM_INT);
        $response->execute();
        return true; 
}

// ANIMATEURS

function listAnim($animateur){
    global $db;
    $response = $db->prepare("SELECT civilite.nom as civilite, civilite_id_id as civilite_id, animateur.nom, animateur.prenom, fonction_animateur.fonction_nom, fonction_animateur_id_id as fonction_id, statut_animateur.status_nom, statut_id_id as statut_id, animateur.gta, animateur.raison_sociale, animateur.adresse, animateur.code_postal, animateur.commune, animateur.region, animateur.tel_portable, animateur.tel_fixe, animateur.email, animateur.urssaf, animateur.siret, animateur.observations FROM animateur INNER JOIN fonction_animateur ON animateur.fonction_animateur_id_id = fonction_animateur.id INNER JOIN statut_animateur ON animateur.statut_id_id = statut_animateur.id INNER JOIN civilite ON animateur.civilite_id_id = civilite.id WHERE animateur.nom LIKE :animateur");
    $animateur= $animateur.'%';
    $response->bindParam(':animateur', $animateur, PDO::PARAM_STR);
    $response->execute();
    $response = $response->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($response);
}

function civilite(){
    global $db;
    $response = $db->prepare("SELECT id, nom FROM civilite");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}
function fonction(){
    global $db;
    $response = $db->prepare("SELECT id, fonction_nom FROM fonction_animateur");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}
function statut(){
    global $db;
    $response = $db->prepare("SELECT id, status_nom FROM statut_animateur");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}

// STAGIAIRES