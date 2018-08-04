<?php 
require_once("utils/db.php");
// NEW
function create($nom, $nature, $autorite, $service, $adr, $cp, $ville){
    
    
    global $db;
    $response = $db->prepare("INSERT INTO tribunal(nature_tribunal_id_id, autorite_tribunal_id_id, service_tribunal_id_id, tribunal_nom, adresse, code_postal, commune) VALUES(:nature, :autorite, :service, :nom, :adr, :cp, :ville)");
    $response->bindParam(':nom', $nom, PDO::PARAM_STR);
    
    if( $nature == null ){
        $response->bindValue(':nature', NULL , PDO::PARAM_INT);
    }else{
        $response->bindParam(':nature', $nature, PDO::PARAM_INT);
    }

    if( $autorite == null ){
        $response->bindValue(':autorite', NULL , PDO::PARAM_INT);
    }else{
        $response->bindParam(':autorite', $autorite, PDO::PARAM_INT);
    }


    if( $service == null ){
        $response->bindValue(':service', NULL , PDO::PARAM_INT);
    }else{
        $response->bindParam(':service', $service, PDO::PARAM_INT);
    }
    
    
    
    
    $response->bindParam(':adr', $adr, PDO::PARAM_STR);
    $response->bindParam(':cp', $cp, PDO::PARAM_STR);
    $response->bindParam(':ville', $ville, PDO::PARAM_STR);
    $response->execute();
    return true; 
}
//LIST
function listAll(){
    global $db;
    $response = $db->prepare("SELECT tribunal.id, nature_tribunal.nature_nom, autorite_tribunal.autorite_nom, service_tribunal.service_nom, tribunal_nom, adresse, code_postal, commune FROM `tribunal` 
    left JOIN nature_tribunal ON tribunal.nature_tribunal_id_id = nature_tribunal.id
    left JOIN autorite_tribunal ON tribunal.autorite_tribunal_id_id = autorite_tribunal.id
    left JOIN service_tribunal ON tribunal.service_tribunal_id_id = service_tribunal.id");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}
function autorite(){
    global $db;
    $response = $db->prepare("SELECT id, autorite_nom FROM autorite_tribunal");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}
function service(){
    global $db;
    $response = $db->prepare("SELECT id, service_nom FROM service_tribunal");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}
function nature(){
    global $db;
    $response = $db->prepare("SELECT id, nature_nom FROM nature_tribunal");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}
//EDIT
function getOne($id){
    global $db;
    $response = $db->prepare("SELECT tribunal.id, nature_tribunal.nature_nom, autorite_tribunal.autorite_nom, service_tribunal.service_nom, tribunal_nom, adresse, code_postal, commune FROM tribunal 
    left JOIN nature_tribunal ON tribunal.nature_tribunal_id_id = nature_tribunal.id 
    left JOIN autorite_tribunal ON tribunal.autorite_tribunal_id_id = autorite_tribunal.id 
    left JOIN service_tribunal ON tribunal.service_tribunal_id_id = service_tribunal.id 
    WHERE tribunal.id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return $response->fetch(PDO::FETCH_ASSOC);
}




function edit($nom, $nature, $autorite, $srv, $adr, $cp, $ville, $id){
    global $db;
    $response = $db->prepare("UPDATE tribunal SET nature_tribunal_id_id = :nature,
    autorite_tribunal_id_id = :autorite,
    service_tribunal_id_id = :srv,
    tribunal_nom = :nom, 
    adresse = :adr,
    code_postal = :cp, 
    commune = :ville 
    WHERE tribunal.id = :id");
    $response->bindParam(':nom', $nom, PDO::PARAM_STR);
    
    if( $nature == null ){
        $response->bindValue(':nature', NULL , PDO::PARAM_INT);
    }else{
        $response->bindParam(':nature', $nature, PDO::PARAM_INT);
    }

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
    $response = $db->prepare("DELETE FROM tribunal
    WHERE id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}



function getCountTribunal( $tribunal_nom,  $adresse, $code_postal, $commune, $autorite_tribunal, $service_tribunal, $nature_tribunal ){
    global $db;
    $sql = "SELECT COUNT(id) AS nombre FROM tribunal where tribunal_nom = :tribunal_nom and adresse = :adresse and code_postal = :code_postal and  commune = :commune and  autorite_tribunal_id_id = :autorite_tribunal and service_tribunal_id_id = :service_tribunal and nature_tribunal_id_id = :nature_tribunal ";
    $response = $db->prepare( $sql );
    $response->bindParam(':tribunal_nom', $tribunal_nom, PDO::PARAM_STR);
    $response->bindParam(':adresse', $adresse, PDO::PARAM_STR);
    $response->bindParam(':code_postal', $code_postal, PDO::PARAM_STR);
    $response->bindParam(':commune', $commune, PDO::PARAM_STR);
    $response->bindParam(':service_tribunal', $service_tribunal, PDO::PARAM_INT);
    $response->bindParam(':autorite_tribunal', $autorite_tribunal, PDO::PARAM_INT);
    $response->bindParam(':nature_tribunal', $nature_tribunal, PDO::PARAM_INT);
    $response->execute();
    $result = $response->fetch( PDO::FETCH_ASSOC);
    return $result['nombre']; 
}


function getCountTribunalEdit( $tribunal_nom, $adresse, $code_postal, $commune,  $autorite_tribunal, $service_tribunal, $nature_tribunal, $id ){
    global $db;
    $sql = "SELECT COUNT(id) AS nombre FROM tribunal where tribunal_nom = :tribunal_nom and adresse = :adresse and code_postal = :code_postal and  commune = :commune and  autorite_tribunal_id_id = :autorite_tribunal and service_tribunal_id_id = :service_tribunal and nature_tribunal_id_id = :nature_tribunal and id != :id";
    $response = $db->prepare( $sql );
    $response->bindParam(':tribunal_nom', $tribunal_nom, PDO::PARAM_STR);
    $response->bindParam(':adresse', $adresse, PDO::PARAM_STR);
    $response->bindParam(':code_postal', $code_postal, PDO::PARAM_STR);
    $response->bindParam(':commune', $commune, PDO::PARAM_STR);
    $response->bindParam(':service_tribunal', $service_tribunal, PDO::PARAM_INT);
    $response->bindParam(':autorite_tribunal', $autorite_tribunal, PDO::PARAM_INT);
    $response->bindParam(':nature_tribunal', $nature_tribunal, PDO::PARAM_INT);
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    $result = $response->fetch( PDO::FETCH_ASSOC);
    return $result['nombre']; 
}


function nombreRelationTribunalInfraction( $id ){
    global $db;
    $sql = "SELECT COUNT(id) AS nombre FROM infraction where tribunal_id_id = :id";
    $response = $db->prepare( $sql );
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    $result = $response->fetch( PDO::FETCH_ASSOC);

    return $result['nombre']; 
}


function nombreRelationTribunalStage( $id ){
    global $db;
    $sql = "SELECT COUNT(id) AS nombre FROM liaison_stagiaire_stage_dossier_cas_bordereau where tribunal_id = :id";
    $response = $db->prepare( $sql );
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    $result = $response->fetch( PDO::FETCH_ASSOC);

    return $result['nombre']; 
}