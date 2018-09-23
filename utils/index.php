<?php
// require_once("utils/db.php");

function listAll($tables){
    global $db;
    $response = $db->prepare("SELECT * FROM :tables");
    $response->bindParam(':tables', $tables);
    $response->execute();
    return $response->fetchAll(PDO::FETCH_ASSOC); 
}