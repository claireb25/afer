<?php 
require_once("utils/db.php");
// NEW
function create($civilite, $nom, $prenom, $adresse, $code_postal, $commune, $region, $gta, $raison_sociale, $fonction_animateur, $statut_animateur, $urssaf, $siret, $tel_portable, $tel_fixe, $email, $observation){
    
    global $db;
    
    
    $response = $db->prepare("INSERT INTO animateur(civilite_id_id, fonction_animateur_id_id, statut_id_id, nom, prenom, gta, raison_sociale, adresse, code_postal, commune, region, tel_portable, tel_fixe, email, urssaf, siret, observations) VALUES(:civilite, :fonction_animateur, :statut_animateur, :nom, :prenom, :gta, :raison_sociale, :adresse, :code_postal, :commune, :region, :tel_portable, :tel_fixe, :email, :urssaf, :siret, :observation)");
    
    if( $civilite == null ){
        $response->bindValue(':civilite', NULL , PDO::PARAM_INT);
    }else{
        $response->bindParam(':civilite', $civilite, PDO::PARAM_INT);
    }

    if( $fonction_animateur == null ){
        $response->bindValue(':fonction_animateur', NULL , PDO::PARAM_INT);
    }else{
        $response->bindParam(':fonction_animateur', $fonction_animateur, PDO::PARAM_INT);
    }

    if( $statut_animateur == null ){
        $response->bindValue(':statut_animateur', NULL , PDO::PARAM_INT);
    }else{
        $response->bindParam(':statut_animateur', $statut_animateur, PDO::PARAM_INT);
    }
    
    $response->bindParam(':nom', $nom, PDO::PARAM_STR);
    $response->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $response->bindParam(':gta', $gta, PDO::PARAM_INT);
    $response->bindParam(':raison_sociale', $raison_sociale, PDO::PARAM_STR);
    $response->bindParam(':adresse', $adresse, PDO::PARAM_STR);
    $response->bindParam(':code_postal', $code_postal, PDO::PARAM_STR);
    $response->bindParam(':commune', $commune, PDO::PARAM_STR);
    $response->bindParam(':region', $region, PDO::PARAM_STR);
    $response->bindParam(':tel_portable', $tel_portable, PDO::PARAM_STR);
    $response->bindParam(':tel_fixe', $tel_fixe, PDO::PARAM_STR);
    $response->bindParam(':email', $email, PDO::PARAM_STR);
    $response->bindParam(':urssaf', $urssaf, PDO::PARAM_STR);
    $response->bindParam(':siret', $siret, PDO::PARAM_STR);
    $response->bindParam(':observation', $observation, PDO::PARAM_STR);
    $response->execute();
    return true; 
}
//LIST
function listAll(){
    global $db;
    $response = $db->prepare("SELECT id, nom, prenom FROM `animateur`");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
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


//EDIT
function getOne($id){
    global $db;
    $response = $db->prepare("SELECT animateur.id, animateur.civilite_id_id as civilite, civilite.nom as civilite_nom , animateur.fonction_animateur_id_id, fonction_animateur.fonction_nom, animateur.statut_id_id, statut_animateur.status_nom, animateur.nom, prenom, gta, raison_sociale, adresse, code_postal, commune, region, tel_portable, tel_fixe, email, urssaf, siret, observations FROM animateur INNER JOIN civilite ON animateur.civilite_id_id = civilite.id INNER JOIN fonction_animateur ON animateur.fonction_animateur_id_id = fonction_animateur.id INNER JOIN statut_animateur ON statut_id_id = statut_animateur.id 
    WHERE animateur.id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return $response->fetch(PDO::FETCH_ASSOC);
}


function edit($civilite, $nom, $prenom, $adresse, $code_postal, $commune, $region, $gta, $raison_sociale, $fonction_animateur, $statut_animateur, $urssaf, $siret, $tel_portable, $tel_fixe, $email, $observation, $id){
    global $db;
    $response = $db->prepare("UPDATE animateur SET civilite_id_id = :civilite, fonction_animateur_id_id = :fonction,statut_id_id = :statut, nom = :nom, prenom = :prenom, gta = :gta, raison_sociale = :raison_sociale, adresse = :adresse, code_postal = :code_postal, commune = :ville, region = :region, tel_portable = :tel_portable,tel_fixe = :tel_fixe, email = :email, urssaf = :urssaf, siret = :siret, observations = :observation WHERE animateur.id = :id");
    $response->bindParam(':civilite', $civilite, PDO::PARAM_INT);
    $response->bindParam(':nom', $nom, PDO::PARAM_STR);
    $response->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $response->bindParam(':fonction', $fonction_animateur, PDO::PARAM_INT);
    $response->bindParam(':statut', $statut_animateur, PDO::PARAM_INT);
    $response->bindParam(':gta', $gta, PDO::PARAM_BOOL);
    $response->bindParam(':raison_sociale', $raison_sociale, PDO::PARAM_STR);
    $response->bindParam(':adresse', $adresse, PDO::PARAM_STR);
    $response->bindParam(':code_postal', $code_postal, PDO::PARAM_STR);
    $response->bindParam(':ville', $commune, PDO::PARAM_STR);
    $response->bindParam(':region', $region, PDO::PARAM_STR);
    $response->bindParam(':tel_portable', $tel_portable, PDO::PARAM_STR);
    $response->bindParam(':tel_fixe', $tel_fixe, PDO::PARAM_STR);
    $response->bindParam(':email', $email, PDO::PARAM_STR);
    $response->bindParam(':urssaf', $urssaf, PDO::PARAM_STR);
    $response->bindParam(':siret', $siret, PDO::PARAM_STR);
    $response->bindParam(':observation', $observation, PDO::PARAM_STR);
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}



//DELETE
function delete($id){
    global $db;
    $response = $db->prepare("DELETE FROM animateur
    WHERE id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}

function nombreRelationAnimateurStage( $id ){
    global $db;
    $sql = "SELECT COUNT(id) AS nombre FROM animateur_stage where animateur_id = :id";
    $response = $db->prepare( $sql );
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    $result = $response->fetch( PDO::FETCH_ASSOC);

    return $result['nombre']; 
}


function getCountAnimateur( $nom,  $prenom, $adresse, $code_postal, $commune ){
    global $db;
    $sql = "SELECT COUNT(id) AS nombre FROM animateur where nom = :nom and prenom = :prenom and adresse = :adresse and code_postal = :code_postal and  commune = :commune  ";
    $response = $db->prepare( $sql );
    $response->bindParam(':nom', $nom, PDO::PARAM_STR);
    $response->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $response->bindParam(':adresse', $adresse, PDO::PARAM_STR);
    $response->bindParam(':code_postal', $code_postal, PDO::PARAM_STR);
    $response->bindParam(':commune', $commune, PDO::PARAM_STR);
    $response->execute();
    $result = $response->fetch( PDO::FETCH_ASSOC);
    return $result['nombre']; 
}


function getCountAnimateurEdit( $nom,  $prenom, $adresse, $code_postal, $commune, $id ){
    global $db;
    
    $sql = "SELECT COUNT(id) AS nombre FROM animateur where nom = :nom and prenom = :prenom and adresse = :adresse and code_postal = :code_postal and  commune = :commune and id != :id ";
    $response = $db->prepare( $sql );
    $response->bindParam(':nom', $nom, PDO::PARAM_STR);
    $response->bindParam(':prenom', $prenom, PDO::PARAM_STR);
    $response->bindParam(':adresse', $adresse, PDO::PARAM_STR);
    $response->bindParam(':code_postal', $code_postal, PDO::PARAM_STR);
    $response->bindParam(':commune', $commune, PDO::PARAM_STR);
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    $result = $response->fetch( PDO::FETCH_ASSOC);
    return $result['nombre']; 
}
