<?php

require("utils/db.php");

function listAll($tables){
    global $db;
    $response = $db->prepare("SELECT * FROM $tables");
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC);
}

function listOne($tables, $id){
    global $db;
    $response = $db->prepare("SELECT * FROM $tables WHERE id = $id");
    $response->execute();
    return $response->fetch(PDO::FETCH_ASSOC);
}

function create($tables, $val){
    global $db;
    $response = $db->prepare("INSERT INTO $tables VALUES(:val)");
    $response->bindParam(':val', $val, PDO::PARAM_STR);
    $response->execute();
    return true; 
}