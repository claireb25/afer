<?php 
// require_once("utils/db.php");

function create($insertInto, $val){
    global $db;
    $response = $db->prepare("INSERT INTO :insertInto VALUES :val");
    $response->bindParam(':insertInto', $insertInto);
    $response->bindParam(':val', $val);
    $response->execute();
    return true; 
}