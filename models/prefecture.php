<?php 
require_once("utils/db.php");
// NEW
function create($nom, $autorite, $service, $adr, $cp, $ville){
    global $db;
    $response = $db->prepare("INSERT INTO prefecture(autorite_prefecture_id_id, service_prefecture_id_id, prefecture_nom, adresse, code_postal, commune) VALUES(:autorite, :service, :nom, :adr, :cp, :ville)");
    $response->bindParam(':nom', $nom, PDO::PARAM_STR);
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
    $response = $db->prepare("SELECT prefecture.id, autorite_prefecture.autorite_nom, service_prefecture.service_nom, prefecture_nom, adresse, code_postal, commune FROM `prefecture` 
    INNER JOIN autorite_prefecture ON prefecture.autorite_prefecture_id_id = autorite_prefecture.id
    INNER JOIN service_prefecture ON prefecture.service_prefecture_id_id = service_prefecture.id");
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
    $response = $db->prepare("SELECT prefecture.id, autorite_prefecture.autorite_nom ,service_prefecture.service_nom, prefecture_nom, adresse, code_postal, commune FROM prefecture INNER JOIN autorite_prefecture ON prefecture.autorite_prefecture_id_id = autorite_prefecture.id INNER JOIN service_prefecture ON prefecture.service_prefecture_id_id = service_prefecture.id
    WHERE prefecture.id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return $response->fetch(PDO::FETCH_ASSOC);
}
function edit($nom, $autorite, $srv, $adr, $cp, $ville, $id){
    global $db;
    $response = $db->prepare("UPDATE prefecture SET 
    autorite_prefecture_id_id = :autorite,
    service_prefecture_id_id = :srv,
    prefecture_nom = :nom, 
    adresse = :adr,
    code_postal = :cp, 
    commune = :ville 
    WHERE prefecture.id = :id");
    $response->bindParam(':nom', $nom, PDO::PARAM_STR);
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
    $response = $db->prepare("DELETE FROM prefecture
    WHERE id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}