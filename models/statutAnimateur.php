<?php 
require_once("utils/db.php");
// NEW
function create($status_nom){
    global $db;
    $response = $db->prepare("INSERT INTO statut_animateur(status_nom) VALUES(:status_nom)");
    $response->bindParam(':status_nom', $status_nom, PDO::PARAM_STR);
    $response->execute();
    return true; 
}
//LIST
function listAll(){
    global $db;
    $response = $db->prepare("SELECT id, status_nom FROM statut_animateur");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}
//EDIT
function getOne($id){
    global $db;
    $response = $db->prepare("SELECT id, status_nom FROM statut_animateur WHERE statut_animateur.id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return $response->fetch(PDO::FETCH_ASSOC);
}

function getStatutNom($status_nom){
    global $db;
    $response = $db->prepare("SELECT status_nom FROM statut_animateur WHERE status_nom = :status_nom");
    $response->bindParam(':status_nom', $status_nom, PDO::PARAM_STR);
    $response->execute();
    return $response->fetch(PDO::FETCH_ASSOC);
}

function lastRow(){
    global $db;
    $response = $db->prepare("SELECT id, status_nom FROM statut_animateur order by id desc");
    $response->execute();
    return $response->fetch(PDO::FETCH_ASSOC);
}


function edit($status_nom, $id){
    global $db;
    $response = $db->prepare("UPDATE statut_animateur
    SET status_nom = :status_nom 
    WHERE id = :id");
    $response->bindParam(':status_nom', $status_nom, PDO::PARAM_STR);
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}

//DELETE


function delete($id){
    global $db;
    $response = $db->prepare("DELETE FROM statut_animateur WHERE id = :id");
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    return true; 
}


function nombreRelationStatutAnimateur( $id ){
    global $db;
    $sql = "SELECT COUNT(id) AS nombre FROM animateur where statut_id_id = :id";
    $response = $db->prepare( $sql );
    $response->bindParam(':id', $id, PDO::PARAM_INT);
    $response->execute();
    $result = $response->fetch( PDO::FETCH_ASSOC);

    return $result['nombre']; 
}
