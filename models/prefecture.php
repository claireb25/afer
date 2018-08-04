<?php 
require_once("utils/db.php");
// NEW
function create($prefecture_nom,  $adresse, $code_postal, $commune, $autorite_prefecture, $service_prefecture){    
    global $db;
    $response = $db->prepare("INSERT INTO prefecture(autorite_prefecture_id_id, service_prefecture_id_id, prefecture_nom, adresse, code_postal, commune) VALUES(:autorite_prefecture, :service_prefecture, :prefecture_nom, :adresse, :code_postal, :commune)");
    
    
    
    if( $autorite_prefecture == null ){
        $response->bindValue(':autorite_prefecture', NULL , PDO::PARAM_INT);
    }else{
        $response->bindParam(':autorite_prefecture', $autorite_prefecture, PDO::PARAM_INT);
    }

    if( $service_prefecture == null ){
        $response->bindValue(':service_prefecture', NULL , PDO::PARAM_INT);
    }else{
        $response->bindParam(':service_prefecture', $service_prefecture, PDO::PARAM_INT);
    }
    
    $response->bindParam(':prefecture_nom', $prefecture_nom, PDO::PARAM_STR);
    $response->bindParam(':adresse', $adresse, PDO::PARAM_STR);
    $response->bindParam(':code_postal', $code_postal, PDO::PARAM_STR);
    $response->bindParam(':commune', $commune, PDO::PARAM_STR);
    $response->execute();

    
    return true; 
}


//LIST
function listAll(){
    global $db;
    $response = $db->prepare("SELECT prefecture.id, autorite_prefecture.autorite_nom, service_prefecture.service_nom, prefecture_nom, adresse, code_postal, commune FROM `prefecture` 
    left JOIN autorite_prefecture ON prefecture.autorite_prefecture_id_id = autorite_prefecture.id
    left JOIN service_prefecture ON prefecture.service_prefecture_id_id = service_prefecture.id");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}


function autorite(){
    global $db;
    $response = $db->prepare("SELECT id, autorite_nom FROM autorite_prefecture");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}
function service(){
    global $db;
    $response = $db->prepare("SELECT id, service_nom FROM service_prefecture");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}

//EDIT
function getOne($id){
    global $db;
    $response = $db->prepare("SELECT prefecture.id, autorite_prefecture.autorite_nom ,service_prefecture.service_nom, prefecture_nom, adresse, code_postal, commune FROM prefecture left JOIN autorite_prefecture ON prefecture.autorite_prefecture_id_id = autorite_prefecture.id left JOIN service_prefecture ON prefecture.service_prefecture_id_id = service_prefecture.id
    WHERE prefecture.id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return $response->fetch(PDO::FETCH_ASSOC);
}


function edit($nom, $autorite, $srv, $adr, $cp, $ville, $id){
    global $db;
    $response = $db->prepare("UPDATE prefecture SET autorite_prefecture_id_id = :autorite,   service_prefecture_id_id = :srv,   prefecture_nom = :nom,     adresse = :adr,    code_postal = :cp,     commune = :ville     WHERE prefecture.id = :id" );
    $response->bindParam(':nom', $nom, PDO::PARAM_STR);

    if( $autorite == null ){
        $response->bindValue(':autorite', NULL , PDO::PARAM_INT);
    }else{
        $response->bindParam(':autorite', $autorite, PDO::PARAM_INT);
    }

    if( $srv == null ){
        $response->bindValue(':srv', NULL , PDO::PARAM_INT);
    }else{
        $response->bindParam(':srv', $srv, PDO::PARAM_INT);
    }
    
    $response->bindParam(':adr', $adr, PDO::PARAM_STR);
    $response->bindParam(':cp', $cp, PDO::PARAM_STR);
    $response->bindParam(':ville', $ville, PDO::PARAM_STR);
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}



//DELETE
function delete($id){
    global $db;
    $response = $db->prepare("DELETE FROM prefecture
    WHERE id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}


function nombreRelationPrefecturePermis( $id ){
    global $db;
    $sql = "SELECT COUNT(id) AS nombre FROM permis where prefecture_id_id = :id";
    $response = $db->prepare( $sql );
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    $result = $response->fetch( PDO::FETCH_ASSOC);

    return $result['nombre']; 
}


function nombreRelationPrefectureStage( $id ){
    global $db;
    $sql = "SELECT COUNT(id) AS nombre FROM liaison_stagiaire_stage_dossier_cas_bordereau where prefecture_id = :id";
    $response = $db->prepare( $sql );
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    $result = $response->fetch( PDO::FETCH_ASSOC);

    return $result['nombre']; 
}

function getCountPrefecture( $prefecture_nom, $adresse, $code_postal, $commune,  $autorite_prefecture, $service_prefecture ){
    global $db;
    $sql = "SELECT COUNT(id) AS nombre FROM prefecture where prefecture_nom = :prefecture_nom and adresse = :adresse and code_postal = :code_postal and  commune = :commune and  autorite_prefecture_id_id = :autorite_prefecture and service_prefecture_id_id = :service_prefecture ";
    $response = $db->prepare( $sql );
    $response->bindParam(':prefecture_nom', $prefecture_nom, PDO::PARAM_STR);
    $response->bindParam(':adresse', $adresse, PDO::PARAM_STR);
    $response->bindParam(':code_postal', $code_postal, PDO::PARAM_STR);
    $response->bindParam(':commune', $commune, PDO::PARAM_STR);
    $response->bindParam(':service_prefecture', $service_prefecture, PDO::PARAM_INT);
    $response->bindParam(':autorite_prefecture', $autorite_prefecture, PDO::PARAM_INT);
    $response->execute();
    $result = $response->fetch( PDO::FETCH_ASSOC);
    return $result['nombre']; 
}


function getCountPrefectureEdit( $prefecture_nom, $adresse, $code_postal, $commune,  $autorite_prefecture, $service_prefecture, $id ){
    global $db;
    $sql = "SELECT COUNT(id) AS nombre FROM prefecture where prefecture_nom = :prefecture_nom and adresse = :adresse and code_postal = :code_postal and  commune = :commune and  autorite_prefecture_id_id = :autorite_prefecture and service_prefecture_id_id = :service_prefecture and id != :id";
    $response = $db->prepare( $sql );
    $response->bindParam(':prefecture_nom', $prefecture_nom, PDO::PARAM_STR);
    $response->bindParam(':adresse', $adresse, PDO::PARAM_STR);
    $response->bindParam(':code_postal', $code_postal, PDO::PARAM_STR);
    $response->bindParam(':commune', $commune, PDO::PARAM_STR);
    $response->bindParam(':service_prefecture', $service_prefecture, PDO::PARAM_INT);
    $response->bindParam(':autorite_prefecture', $autorite_prefecture, PDO::PARAM_INT);
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    $result = $response->fetch( PDO::FETCH_ASSOC);
    return $result['nombre']; 
}
