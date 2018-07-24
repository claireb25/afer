<?php 
require_once("utils/db.php");
// NEW
function create($nom, $nature, $autorite, $service, $adr, $cp, $ville){
    global $db;
    $response = $db->prepare("INSERT INTO tribunal(nature_tribunal_id_id, autorite_tribunal_id_id, service_tribunal_id_id, tribunal_nom, adresse, code_postal, commune) VALUES(:nature, :autorite, :service, :nom, :adr, :cp, :ville)");
    $response->bindParam(':nom', $nom, PDO::PARAM_STR);
    $response->bindParam(':nature', $nature, PDO::PARAM_INT);
    $response->bindParam(':autorite', $autorite, PDO::PARAM_INT);
    $response->bindParam(':service', $service, PDO::PARAM_INT);
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
    INNER JOIN nature_tribunal ON tribunal.nature_tribunal_id_id = nature_tribunal.id
    INNER JOIN autorite_tribunal ON tribunal.autorite_tribunal_id_id = autorite_tribunal.id
    INNER JOIN service_tribunal ON tribunal.service_tribunal_id_id = service_tribunal.id");
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
    $response = $db->prepare("SELECT tribunal.id, tribunal.nature_tribunal_id_id, tribunal.autorite_tribunal_id_id, tribunal.service_tribunal_id_id, tribunal_nom, adresse, code_postal, commune FROM tribunal 
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
    $response->bindParam(':nature', $nature, PDO::PARAM_INT);
    $response->bindParam(':autorite', $autorite, PDO::PARAM_INT);
    $response->bindParam(':srv', $srv, PDO::PARAM_INT);
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
